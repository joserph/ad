<?php

namespace App\Http\Controllers;

use App\Models\Geograficos;
use App\Models\Seccional;
use Illuminate\Http\Request;
use App\Http\Requests\OnextenRequest;
use App\Models\Onexten;
use Yajra\DataTables\DataTables;

class OnextenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$onextens = Onexten::get();
        return view('pages.onexten.index');
    }

    public function dataTable()
    {
        $model = Onexten::query()->orderBy('created_at', 'desc');

        $data = DataTables::of($model)
            ->toJson();

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seccionales = Seccional::all();
        $geograficos = Geograficos::all();

        return view('pages.onexten.create', compact(
            'seccionales',
            'geograficos'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OnextenRequest $request)
    {
        Onexten::create($request->all());

        session()->flash('success', '1 x 10 creado con éxito.');

        return redirect()->route('onexten.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
