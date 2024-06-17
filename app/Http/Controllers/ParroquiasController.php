<?php

namespace App\Http\Controllers;

use App\Models\Parroquia;
use Illuminate\Http\Request;

class ParroquiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $path = public_path('assets/data/parroquias_final.csv');
        $file = fopen($path, 'r');

        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            if ($data[0] != 'id') {
                Parroquia::create([
                    'nombre' => $data[1],
                    'municipio_id' => $data[2], // Asegúrate de que esto coincida con tu estructura de CSV
                ]);
            }
        }

        fclose($file);

        return back()->with('success', 'Parroquias importadas correctamente.');
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
     * @param  \App\Models\Parroquia  $parroquia
     * @return \Illuminate\Http\Response
     */
    public function show(Parroquia $parroquia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parroquia  $parroquia
     * @return \Illuminate\Http\Response
     */
    public function edit(Parroquia $parroquia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parroquia  $Parroquia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parroquia $Parroquia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parroquia  $Parroquia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parroquia $Parroquia)
    {
        //
    }
}
