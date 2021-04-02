<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use App\Repository\RentsRepository;
use App\Models\Car;
use Illuminate\Support\Facades\Response;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('rent_access'), 403);

        $rents = Rent::all();

        return view('rents.index', compact('rents'));
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
        return $repository->search($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        abort_unless(\Gate::allows('rent_create'), 403);

        $model = Car::with('brand')
            ->where('id',$request->id)
            ->first();

        return view('rents.create',['model'=>$model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        abort_unless(\Gate::allows('rent_create'), 403);

        $car = Car::where('plate',$request->plate)->first();

        if(empty($car->rented)){

            $this->calculateCost($request, $car);

            $rent = Rent::create($request->except(['_token','brand','driver']));

            if($rent){
                $car->update(['rented'=>1]);
                return Response::json(array('message' => 'Rental schedule saved!','status'=> 200));
            }

            return Response::json(array('message' => 'It was not possible to save the rental schedule... Please try again!','status'=> 422));

        }

        return Response::json(array('message' => 'This car is rented... Please choose another!','status'=> 422));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        abort_unless(\Gate::allows('rent_show'), 403);

        return view('rents.show', compact('rent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function edit(Rent $rent)
    {
        abort_unless(\Gate::allows('rent_edit'), 403);

        $model = Rent::with('car.brand','user')
            ->where('id',$rent->id)
            ->first();

        return view('rents.edit', ['model'=>$model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Rent $rent)
    {
        abort_unless(\Gate::allows('rent_edit'), 403);

        $car = Car::where('id',$request->idCar)->first();

        if($car->rented==1){
            try{
                $this->calculateCost($request, $car);
                $rent->where('id',$request->idRent)->update($request->except(['_token','idRent','idCar','plate','brand']));

                return Response::json(array('message' => 'Rental schedule updated!','status'=> 200));
            }
            catch (\Exception $e){
                return Response::json(array('message' => 'It was not possible to save the rental schedule... Please try again!','status'=> 422));
            }
        }
        return Response::json(array('message' => 'It was not possible to save the rental schedule...','status'=> 422));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        abort_unless(\Gate::allows('rent_delete'), 403);

        $rent->delete();

        return back();
    }

    public function calculateCost(Request $request, Car $car){

        $datediff = strtotime($request->date_to) - strtotime($request->date_from);

        $countdays = abs($datediff / (60 * 60 * 24));

        $request->merge([
            'total_cost'=>$countdays*$car->daily_price,
        ]);
    }
}
