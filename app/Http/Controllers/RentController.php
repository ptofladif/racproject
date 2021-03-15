<?php

namespace App\Http\Controllers;

use App\Rent;
use Illuminate\Http\Request;
use App\Repository\RentsRepository;
use App\Car;
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

        $viewModel=[
            'model'=>$model,
        ];

        return view('rents.create',$viewModel);
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

        $rent = Rent::create($request->all());

        return redirect()->route('admin.rents.index');
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

        return view('rents.edit', compact('rent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rent $rent)
    {
        abort_unless(\Gate::allows('rent_edit'), 403);

        $rent->update($request->all());

        return redirect()->route('admin.rents.index');
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
}
