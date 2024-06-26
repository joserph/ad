<?php

namespace App\Http\Controllers;

use App\Models\Geograficos;
use App\Models\Seccional;
use Illuminate\Http\Request;
use App\Http\Requests\OnextenRequest;
use App\Models\Onexten;
use App\Models\OnextenItem;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class OnextenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $onextens = Onexten::paginate(10);
        $onextenItems = OnextenItem::all();
        return view('pages.onexten.index', compact(
            'onextens',
            'onextenItems'
        ));
    }

    public function list()
    {
        $model = Onexten::query()->orderBy('created_at', 'desc');

        $data = DataTables::of($model)
            ->toJson();

        return $data;
    }

    public function searchDoc(Request $request)
    {
        
        $ci = $request->ci;
        
        $path = public_path('assets/data/re20240131_pp.txt');
        //dd($path);
        if (File::exists($path)) {
            $file = fopen($path, 'r');

            $columna_deseada = null;

            while (($linea = fgets($file)) !== false) {
                $linea = utf8_encode($linea);

                $columnas = explode(',', $linea);

                if ($columnas[1] === $ci) {
                    $columna_deseada = $columnas;
                    break;
                }
            }

            fclose($file);

            if ($columna_deseada !== null) {
                return response()->json(['success' => true, 'info' => $columna_deseada], 200);
            } else {
                return response()->json(['error' => "No se encontró la CI $ci en el archivo."], 200);
            }
        } else {
            return response()->json(['error' => true, 'info' => []], 200);
        }
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
        // dd($request['cedula'][0]);
        $onexten = Onexten::create([
            'responsable' => $request['responsable'],
            'telefono' => $request['telefono'],
            'seccional' => $request['seccional'],
            'municipio' => $request['municipio'],
            'parroquia' => $request['parroquia'],
            'sector' => $request['sector'],
        ]);

        for($i = 0; $i <= 9; $i++){
            //dd($request['cedula'][$i]);
            $j = $i + 1;
            OnextenItem::create([
                'item' => $j,
                'onexten_id' => $onexten->id,
                'cedula' => $request['cedula'][$i],
                'nombre' => $request['nombre'][$i],
                'apellido' => $request['apellido'][$i],
                'num_telefono' => $request['num_telefono'][$i],
                'direccion' => $request['direccion'][$i],
                'centro_votacion' => $request['centro_votacion'][$i],
            ]);
        }

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
        $onexten = Onexten::find($id);
        $seccionales = Seccional::all();
        $geograficos = Geograficos::all();
        $onextenItem = OnextenItem::where('onexten_id', $onexten->id)->get();
        //dd($onextenItem);
        return view('pages.onexten.edit', compact(
            'onexten',
            'seccionales',
            'geograficos',
            'onextenItem'
        ));
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
        // dd($request);
        $onexten = Onexten::find($id);
        $onexten->update([
            'responsable' => $request['responsable'],
            'telefono' => $request['telefono'],
            'seccional' => $request['seccional'],
            'municipio' => $request['municipio'],
            'parroquia' => $request['parroquia'],
            'sector' => $request['sector'],
        ]);

        for($i = 0; $i <= 9; $i++){
            // dd($request['id'][$i]);
            $j = $i + 1;
            $onextenItem = OnextenItem::find($request['id'][$i]);
            $onextenItem->update([
                'item' => $j,
                'onexten_id' => $onexten->id,
                'cedula' => $request['cedula'][$i],
                'nombre' => $request['nombre'][$i],
                'apellido' => $request['apellido'][$i],
                'num_telefono' => $request['num_telefono'][$i],
                'direccion' => $request['direccion'][$i],
                'centro_votacion' => $request['centro_votacion'][$i],
            ]);
        }

        session()->flash('success', '1 x 10 actualizado con éxito.');

        return redirect()->route('onexten.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $onexten = Onexten::find($id);
        $onextenItems = OnextenItem::where('onexten_id', $onexten->id)->get();
        
        foreach($onextenItems as $item){
            $itemOne = OnextenItem::find($item->id);
            $itemOne->delete();
        }
        $onexten->delete();

        session()->flash('success', '1 x 10 eliminado con éxito.');

        return redirect()->route('onexten.index');
    }
}
