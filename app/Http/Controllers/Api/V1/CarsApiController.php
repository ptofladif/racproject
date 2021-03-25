<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Repository\CarsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class CarsApiController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::all();

        if(empty($cars->count())){
            return Response::json(array('message' => 'No cars available','status'=> 422));
        }else{
            return $cars;
        }
    }

    /**
     * Searches for the requested resource.
     *
     * @param Request $request
     * @param CarsRepository $repository
     * @return mixed
     * @throws \Exception
     */
    public function search(Request $request, CarsRepository $repository)
    {
        $request->merge(['api'=>1]);
        return $repository->search($request);
    }
}
