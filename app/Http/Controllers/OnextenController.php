<?php

namespace App\Http\Controllers;

use App\Models\Geograficos;
use App\Models\Seccional;
use App\Rules\DuplicateCI;
use Illuminate\Http\Request;
use App\Http\Requests\OnextenRequest;
use App\Models\CentrosVotacion;
use App\Models\Onexten;
use App\Models\OnextenItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class OnextenController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:mostrar-unoxdiez', ['only' => ['index']]);
        $this->middleware('permission:crear-unoxdiez', ['only' => ['create', 'store']]);
        $this->middleware('permission:ver-unoxdiez', ['only' => ['show']]);
        $this->middleware('permission:editar-unoxdiez', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-unoxdiez', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $onextens = Onexten::paginate(10);
        $onextenItems = OnextenItem::all();
        return view('pages.onexten.index');
    }

    public function list()
    {
        $model = Onexten::where('id_user', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        // $countMembers = OnextenItem::where('onexten_id', $model->id)->where('cedula', '!=', null)->count();
        // dd($model);
        $data = DataTables::of($model)
            ->editColumn('miembros', function($row){
                $countMembers = OnextenItem::where('onexten_id', $row->id)->where('cedula', '!=', null)->count();
                $miembros = '<span class="badge text-bg-success text-center">' . $countMembers . '</span>';
                return $miembros;
            })
            ->addColumn('action', 'pages.onexten.partials.btns')
            ->rawColumns(['miembros', 'action'])
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

    public function centro_votacion($id)
    {
        // return 'Hola centros';
        $centro = CentrosVotacion::where('centro_nuevo', $id)->first();
        // dd($centro);
        return response(json_encode($centro), 200)->header('Content-type', 'text/plain');
        // return response()->json(['success' => true, 'info' => $centro], 200);
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
        $centros_votaciones = CentrosVotacion::select('id', 'cod_centro', 'nombre_centro')->get();
        //dd($centros_votaciones);
        return view('pages.onexten.create', compact(
            'seccionales',
            'geograficos',
            'centros_votaciones'
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
        // dd($request);
        $request->validate([
            'cedula' => ['unique:onexten_items,cedula', new DuplicateCI()],
        ]);
        // if(count($request['cedula']) > count(array_unique($request['cedula']))){
        //     dd("¡Hay repetidos!");
        //   }else{
        //     dd("No hay repetidos");
        //   }
        
        // dd($request['cedula'][0]);
        $onexten = Onexten::create([
            'responsable' => $request['responsable'],
            'telefono' => $request['telefono'],
            'seccional' => $request['seccional'],
            'municipio' => $request['municipio'],
            'parroquia' => $request['parroquia'],
            'sector' => $request['sector'],
            'id_user' => $request['id_user'],
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
            'id_user' => $request['id_user'],
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
