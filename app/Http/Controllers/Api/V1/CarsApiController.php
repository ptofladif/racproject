<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Car;


class CarsApiController extends Controller
{
    public function index()
    {
        $cars = Car::where('rented',0)->get();

        return $cars;
    }
}
