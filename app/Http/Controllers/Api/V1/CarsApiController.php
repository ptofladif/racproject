<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class CarsApiController extends Controller
{
    public function index(Request $request)
    {
        if( isset($request->status) ){
            $cars = Car::where('rented',$request->status)->get();
        }
        else{
            $cars = Car::all();
        }

        if(empty($cars->count())){
            return Response::json(array('message' => 'No cars available','status'=> 422));
        }else{
            return $cars;
        }
    }
}
