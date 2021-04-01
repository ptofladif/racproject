<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use App\Repository\RentsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class RentsApiController extends Controller
{
    public function index()
    {
        $rents = Rent::all();
        return $rents;
    }

    /**
     * Searches for the requested resource.
     *
     * @param Request $request
     * @param RentsRepository $repository
     * @return mixed
     * @throws \Exception
     */
    public function search(Request $request, RentsRepository $repository)
    {
        $request->merge([
            'api'=>1,
            'user_id'=>Auth::user()->id
        ]);

        return $repository->search($request);
    }

    public function store(Request $request)
    {
        try{
            $car = Car::where('id',$request->car_id)->first();

            Log::debug(pathinfo(__FILE__, PATHINFO_FILENAME) . ' linha ' .__LINE__. ' ' . print_r($request->all(), 1));
            Log::debug(pathinfo(__FILE__, PATHINFO_FILENAME) . ' linha ' .__LINE__. ' ' . print_r($car, 1));

            if(empty($car->rented)){

                $datediff = strtotime($request->date_to) - strtotime($request->date_from);

                $countdays = abs($datediff / (60 * 60 * 24));

                $request->merge(
                    [
                        'user_id'    => Auth::user()->id,
                        'total_cost' => $countdays*$car->daily_price,
                    ]
                );

                $newrent = Rent::create($request->all());

                if($newrent){
                    $car->update(['rented'=>1]);
                }

                return Response::json($newrent);
            }

            return Response::json(array('message' => 'This car is already rented', 'status' => 422));

        } catch (Exception $err) {
            return Response::json(array('message' => $err, 'status' => 422));
        }

    }
}
