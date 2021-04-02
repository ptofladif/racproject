<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rent;
use Illuminate\Http\Request;
use App\Repository\CarsRepository;
use App\Models\Brand;
use Illuminate\Support\Facades\Response;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       abort_unless(\Gate::allows('car_access'), 403);

        $brands = Brand::orderBy('title')->pluck('title','id')->toArray();

        $viewModel=[
            'brands'=>$brands,
        ];

        $this->updateRented();

        return view('cars.index', $viewModel);
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
        return $repository->search($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('car_create'), 403);

        $brands = Brand::orderBy('title')->pluck('title','id')->toArray();

        $viewModel=[
            'brands'=>$brands,
        ];

        return view('cars.create',$viewModel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(\Gate::allows('car_create'), 403);

        $car = Car::where('plate',$request->plate)->first();

        if(!empty($car)){
            return Response::json(array('message' => 'Car already exist...','status'=> 422));
        }else{
            $result = Car::create( $request->except(['_token']));

            if($result){
                return Response::json(array('message' => 'Car added!','status'=> 200));
            }
            return Response::json(array('message' => 'No cars available','status'=> 422));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        abort_unless(\Gate::allows('car_show'), 403);

        return view('admin.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        abort_unless(\Gate::allows('car_edit'), 403);

        return view('admin.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        abort_unless(\Gate::allows('car_edit'), 403);

        $car->update($request->all());

        return redirect()->route('admin.cars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        abort_unless(\Gate::allows('car_delete'), 403);

        $car->delete();

        return back();
    }

    public function updateRented(){

        $rents = Rent::with('car')
            ->where('date_to','<=',now())
            ->whereHas('car', function ($q) {
                $q->where('rented', 1);
            })
            ->pluck('car_id','car_id')
            ->toArray()
            ;

        Car::whereIn('id',$rents)->update(
            [
                'rented'=>0
            ]
        );
    }
}
