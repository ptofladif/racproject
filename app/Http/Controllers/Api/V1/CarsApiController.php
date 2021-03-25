<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Support\Facades\Response;


class CarsApiController extends Controller
{
    public function index()
    {
        $cars = Car::where('rented',0)->get();

        if(empty($cars->count())){
            return Response::json(array('message' => 'No cars available','status'=> 422));
        }else{
            return $cars;
        }
    }
}
