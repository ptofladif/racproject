<?php

namespace App\Repository;

use App\Models\Rent;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

/**
 * Class RacTrasactionsRepository
 * @package App\Repository
 */
class RentsRepository
{
    /**
     * Returns the search query results.
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function search(Request $request) {


        $RentsQuery = Rent::query();

        $this->handleFilters($RentsQuery, $request);

        $Rents = $RentsQuery->with('user','car')
            ->leftJoin('users', 'rents.user_id', '=', 'users.id')
            ->select([
                'rents.id',
                'rents.user_id',
                'rents.car_id',
                'rents.date_from',
                'rents.date_to',
                'rents.total_cost',
            ])
        ;
        if($request->api){
            return Response::json($Rents->get());
        }
        return DataTables::of($Rents)
            ->editColumn('actions', function (Rent $rent) {
                return View::make('rents.partials.table-row-actions')
                    ->with('rent', $rent)
                    ;
            })
            ->editColumn('plate', function(Rent $rent) {
                return $rent->car->plate;
            })
            ->editColumn('client', function(Rent $rent) {
                return $rent->user->name;
            })
            ->editColumn('date_from', function (Rent $rent) {
                return $rent->date_from;
            })
            ->editColumn('date_to', function (Rent $rent) {
                return $rent->date_to;
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
            ->when($plate = $request->plate, function ($q) use ($plate) {
                $q->whereHas('car', function ($q2) use($plate) {
                    return $q2->where('plate','like','%'.$plate.'%');
                });
            })
            ->when($user = $request->client, function ($q) use ($user) {
                $q->whereHas('user', function ($q2) use($user) {
                    return $q2->where('name','like','%'.$user.'%');
                });
            })
            ;
    }
}
