<?php

namespace App\Http\Controllers;

use App\Models\Seccional;
use Illuminate\Http\Request;

class SeccionalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $path = public_path('assets/data/estados_final.csv');
        $file = fopen($path, 'r');

        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            if ($data[0] != 'id') { // Evitar la cabecera si tiene una
                Seccional::create([
                    'nombre' => $data[1], // Ajusta según la estructura de tu CSV
                ]);
            }
        }

        fclose($file);

        return back()->with('success', 'Seccionales importados correctamente.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seccionales  $seccionales
     * @return \Illuminate\Http\Response
     */
    public function show(Seccional $seccional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seccionales  $seccionales
     * @return \Illuminate\Http\Response
     */
    public function edit(Seccional $seccional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seccionales  $seccionales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seccional $seccional)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seccionales  $seccionales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seccional $seccional)
    {
        //
    }
}
