<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Rent;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Car;
use Illuminate\Support\Facades\Response;

class RentsApiController extends Controller
{
    public function index()
    {
        $rents = Rent::all();
        return $rents;
    }

    public function merents(){

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
                    Car::where('id',$request->car_id)->update(['rented'=>1]);
                }
                return $newrent;
            }

            return Response::json(array('message' => 'Carro já está alugado', 422));

        } catch (Exception $err) {
            return Response::json(array('message' => $err, 422));
        }

    }
}
