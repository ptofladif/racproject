<?php

namespace App\Repository;

use App\Models\Car;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

/**
 * Class RacTrasactionsRepository
 * @package App\Repository
 */
class CarsRepository
{
    /**
     * Returns the search query results.
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function search(Request $request) {

        $CarsQuery = Car::query();

        $this->handleFilters($CarsQuery, $request);

        $Cars = $CarsQuery
            ->leftJoin('brands', 'cars.brand_id', '=', 'brands.id')
            ->select([
                'cars.id',
                'cars.plate',
                'cars.daily_price',
                'cars.brand_id',
                'cars.rented'
            ])
        ;

        if($request->api){
            return Response::json($Cars->get());
        }

        return DataTables::of($Cars)
            ->editColumn('details_url', function(Car $car) {
                return route('api.master_rent_details', $car->id);
            })
            ->editColumn('action', function (Car $car) {
                return '<a href="#" id="car-id-'.$car->id.'"> <i class="fas fa-car" style="color:green;" title="Alugar"></i></a>';
            })
            ->editColumn('brand', function (Car $car) {
                return asset('img/brands/'.$car->brand->icon);
            })
            ->make()
            ;
    }

    /**
     * Handles filters from filter form.
     *
     * @param Builder $query
     * @param Request $request
     */
    protected function handleFilters(Builder $query, Request $request) {

        $query
            ->when($id = $request->id, function ($q) use ($id) {
                $q->where('cars.id',$id);
            })
            ->when( is_numeric($request->rented) , function ($q) use ($request) {
                $q->where('rented',$request->rented);
            })
            ->when($plate = $request->plate, function ($q) use ($plate) {
                $q->where('plate','like','%'.$plate.'%');
            })
            ->when($minvalue = $request->minvalue, function ($q) use ($minvalue) {
                $q->where('daily_price','>=',$minvalue);
            })
            ->when($maxvalue = $request->maxvalue, function ($q) use ($maxvalue) {
                $q->where('daily_price','<=',$maxvalue);
            })
            ->when($brandId = $request->brandId, function ($q) use ($brandId) {
                $q->whereHas('brand', function ($q2) use($brandId) {
                    return $q2->where('brands.id',$brandId);
                });
            })
            ;
    }
}
