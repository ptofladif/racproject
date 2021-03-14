<?php

namespace App\Repository;

use App\Car;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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
                'cars.plate',
                'brands.title as brand',
                'cars.daily_price',
            ])
        ;

        return DataTables::of($Cars)
//            ->addColumn('details_url', function(Car $car) {
////                return route('api.master_caroptions_details', $car->idv);
//                return [];
//            })
//            ->addColumn('action', function (Car $car) {
//                return '<a href="#" id="car-id-'.$car->id.'" ><i class="fa fa-send-o" style="color:green;" title="Alugar"></i></a>';
//            })
            ->make();
    }

    /**
     * Handles filters from filter form.
     *
     * @param Builder $query
     * @param Request $request
     */
    protected function handleFilters(Builder $query, Request $request) {
        $query
            ->when($brandId = $request->brandId, function ($q) use ($brandId) {
                $q->whereHas('brand', function ($q2) use($brandId) {
                    return $q2->where('id',$brandId);
                });
            })
            ->when($plate = $request->plate, function ($q) use ($plate) {
                $q->where('plate','like','%'.$plate.'%');
            })
            ->when($minvalue = $request->minvalue, function ($q) use ($minvalue) {
                $q->where('daily_price','>',$minvalue);
            })
            ->when($maxvalue = $request->maxvalue, function ($q) use ($maxvalue) {
                $q->where('daily_price','<like>',$maxvalue);
            })
            ;
    }
}
