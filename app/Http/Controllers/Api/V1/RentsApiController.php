<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use Illuminate\Support\Facades\Response;

class RentsApiController extends Controller
{
    public function index()
    {
        $rents = Rent::all();
        return $rents;
    }

    public function myrents(){

        $rents = Rent::where('user_id',Auth::user()->id)->get();

        return $rents;
    }

    public function store(Request $request)
    {
        try{
            $car = Car::where('id',$request->car_id)->first();

            if(empty($car->rented)){
                $request->merge(
                    ['user_id'=>Auth::user()->id]
                );

                $newrent = Rent::create($request->all());

                if($newrent){
                    Car::where('id',$request->car_id)->update(['rented' => 1]);
                }
                return $newrent;
            }

            return Response::json(array('message' => 'This car is already rented', 'status' => 422));

        } catch (Exception $err) {
            return Response::json(array('message' => $err, 'status' => 422));
        }

    }
}
