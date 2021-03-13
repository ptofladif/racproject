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
        $CarsQuery = Car::model();

        $this->handleFilters($CarsQuery, $request);

        $Cars = $CarsQuery
            ;
        dd($Cars);
        return DataTables::of($Cars)
            ->addColumn('details_url', function(Car $car) {
                return route('api.master_caroptions_details', $car->idv);
            })
            ->addColumn('action', function (Car $car) {
                return '<a href="#" id="car-div-'.$car->id.'" ><i class="fa fa-send-o" style="color:green;" title="Alugar"></i></a>';
            })
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
            ->when($plate = $request->plate, function ($q) use ($plate) {
                $q->where('plate','like','%'.$plate.'%');
            })
            ;
    }
}
