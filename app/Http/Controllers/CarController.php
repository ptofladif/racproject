<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Repository\CarsRepository;
use App\Models\Brand;

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

        return view('admin.cars.create');
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

        $car = Car::create($request->all());

        return redirect()->route('admin.cars.index');
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
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        abort_unless(\Gate::allows('car_delete'), 403);

        $car->delete();

        return back();
    }
}
