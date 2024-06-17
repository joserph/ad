<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Comite;
use App\Models\Members;
use App\Models\Scope;
use App\Models\Geograficos;
use App\Models\Seccional;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Gender;
use App\Models\Positions;
use App\Models\SocialNetwork;
use App\Http\Requests\MembersStoreRequest;
use App\Http\Requests\MembersComiteStoreRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Members $members)
    {
        $geograficos = Geograficos::all();
        $optionsScope = Scope::getOptions();
        $optionsGender = Gender::getGenders();
        $optionsSocialN = SocialNetwork::getSocialNet();
        $optionsPositions = Positions::getPositions();
        $optionsTypesPositions = Positions::getTypesPositions();
        $optionsBuro = Positions::getBuro();
        $optionsBuroSecFemenina = Positions::getBuroSecFemenina();
        $optionsBuroSecCultura = Positions::getBuroSecCultura();
        // $seccionales = Seccional::all();

        $optionsBuro = collect($optionsBuro)->map(function ($value, $key) {
            return ['key' => $key, 'value' => $value];
        })->values()->toJson();

        $optionsBuroSecFemenina = collect($optionsBuroSecFemenina)->map(function ($value, $key) {
            return ['key' => $key, 'value' => $value];
        })->values()->toJson();

        $optionsBuroSecCultura = collect($optionsBuroSecCultura)->map(function ($value, $key) {
            return ['key' => $key, 'value' => $value];
        })->values()->toJson();

        return view('pages.members.create', compact('optionsScope', 'optionsGender', 'optionsSocialN', 'optionsTypesPositions', 'optionsPositions', 'optionsBuro', 'optionsBuroSecFemenina', 'optionsBuroSecCultura', 'members', 'geograficos'));
    }

    public function getScopeInfo()
    {
        $municipios = Municipio::all();
        $parroquias = Parroquia::all();

        return response()->json([
            'municipios' => $municipios,
            'parroquias' => $parroquias,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MembersStoreRequest $request)
    {
        // return $request;
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $member = Members::create($validated);

            DB::commit();

            session()->flash('success', 'Usuario creado con éxito.');

            return redirect()->route('members.index');

            // return response()->json([
            //     'status' => 'success',
            //     'message' => 'Usuario creado con éxito.',
            //     'data' => $member,
            // ]);

        } catch (\Exception $e) {
            DB::rollBack();

            // Suponiendo que $e es una instancia de Exception capturada en un bloque catch
            session()->flash('error', 'Hubo un error al crear el usuario. Por favor, inténtalo de nuevo. Error: ' . $e->getMessage());

            return redirect()->back();

            // return response()->json([
            //     'status' => 'error',
            //     'message' => 'Hubo un error al crear el usuario. Por favor, inténtalo de nuevo.',
            //     'error' => $e->getMessage(),
            // ]);
        }
    }

    public function comiteStore(MembersComiteStoreRequest $request)
    {
        $validatedData = $request->validated();

        $comiteData = $request->only('nombre_comite');
        // return $comiteData;

        DB::beginTransaction();
        try {
            $comiteData = $request->only('nombre_comite');
            $comite = Comite::create($comiteData);

            foreach ($validatedData['cedula'] as $key => $cedula) {
                // dd($validatedData);
                $member = [
                    'cedula' => $cedula,
                    'nombre' => $validatedData['nombre'][$key],
                    'apellido' => $validatedData['apellido'][$key],
                    'telefono' => $validatedData['telefono'][$key],
                    'correo' => $validatedData['correo'][$key],
                    'fecha_nacimiento' => $validatedData['fecha_nacimiento'][$key],
                    'profesion' => $validatedData['profesion'][$key],
                    'red_social' => $validatedData['red_social'][$key],
                    'usuario_red' => $validatedData['usuario_red'][$key],
                    'genero' => $validatedData['genero'][$key],
                    'seccional' => $validatedData['seccional'],
                    'municipio' => $validatedData['municipio'],
                    'parroquia' => $validatedData['parroquia'],
                    'tipo_cargo' => $validatedData['tipo_cargo'][$key],
                    'cargo' => $validatedData['cargo'][$key],
                    'buro' => $validatedData['buro'][$key] ?? null,
                    'cargo_pub' => $validatedData['cargo_pub'][$key] ?? null,
                    'comite_id' => $comite->id,
                ];

                Members::create($member);
            }

            DB::commit();

            session()->flash('success', 'Comite creado con éxito.');

            return redirect()->route('committe-local.index');

            // return response()->json([
            //     'status' => 'success',
            //     'message' => 'Usuario creado con éxito.',
            //     'data' => $member,
            // ]);

        } catch (\Exception $e) {
            DB::rollBack();

            // Suponiendo que $e es una instancia de Exception capturada en un bloque catch
            session()->flash('error', 'Hubo un error al crear el comite. Por favor, inténtalo de nuevo. Error: ' . $e->getMessage());

            return redirect()->back();

            // return response()->json([
            //     'status' => 'error',
            //     'message' => 'Hubo un error al crear el usuario. Por favor, inténtalo de nuevo.',
            //     'error' => $e->getMessage(),
            // ]);
        }
    }

    public function uploads()
    {
        return view('pages.members.uploads');
    }

    public function saveMembers(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();

        if ($extension === 'xlsx' || $extension === 'xls') {
            $data = Excel::toArray([], $file)[0];
        } elseif ($extension === 'txt') {
            $data = file($file);
            $data = array_map('trim', $data);
            $data = array_map('str_getcsv', $data);
        } else {
            return back()->with('error', 'Formato de archivo no compatible');
        }

        foreach ($data as $row) {
            $member = new Members();
            $member->cedula = $row[0];
            $member->nombre = $row[1];
            $member->apellido = $row[2];
            $member->telefono = $row[3];
            $member->correo = $row[4];
            $member->fecha_nacimiento = $row[5];
            $member->profesion = $row[6];
            $member->red_social = $row[7] ?? null;
            $member->usuario_red = $row[8] ?? null;
            $member->genero = $row[9];
            $member->alcance = $row[10] ?? null;
            $member->seccional = $row[11] ?? null;
            $member->municipio = $row[12] ?? null;
            $member->parroquia = $row[13] ?? null;
            $member->tipo_cargo = $row[14] ?? null;
            $member->cargo = $row[15] ?? null;
            $member->buro = $row[16] ?? null;
            $member->save();
        }

        session()->flash('success', 'Usuarios guardados correctamente.');

        return redirect()->route('members.index');
    }

    public function modal_delete(Members $members)
    {
        return view('pages.members.modal.deleteMembers', compact('members'));
    }

    public function modal_delete_masive()
    {
        return view('pages.members.modal.deleteMasiveMembers');
    }

    public function list()
    {
        $model = Members::query()->orderBy('created_at', 'desc');

        $data = DataTables::of($model)
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('nombre_completo', function($row) {
                $nombreC = $row->nombre . " " . $row->apellido;
                $html = '<div class="d-flex flex-column">' .
                    '<h6 class="mb-0">' . $nombreC . '</h6>' .
                    '<h6 class="fw-bolder mb-0">' . $row->cedula . '</h6>' .
                '</div>';
                return $html;
            })
            ->editColumn('cargo', function($row) {
                $tipoCargoDescripcion = Positions::getTypesPositions()[$row->tipo_cargo] ?? '';

                $cargoDescripcion = $row->cargo !== null ? (Positions::getPositions()[$row->cargo] ?? 'No definido') : '';

                $html = '<div class="d-flex flex-column">' .
                    '<small class="fw-bolder">' . $tipoCargoDescripcion . '</small>' .
                    '<small class="fw-bolder">' . $cargoDescripcion . '</small>' .
                '</div>';
                return $html;
            })
            ->editColumn('buro', function($row) {
                $html = '';
                if ($row->buro != '') {
                    $html = $row->buro;
                } else {
                    $html = '<small class="fw-bolder">No asignado</small>';
                }
                return $html;
            })
            ->addColumn('action', function($row){
                return '<div class="d-flex">
                    <a href='. route('members.edit', $row) .' class="btn btn-icon btn-info btn-sm me-1">
                        <i class="ti ti-pencil"></i>
                    </a>
                    <button class="btn btn-icon btn-danger btn-sm modal-pers" data-path="'. route('members.modalDelete', $row) .'">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['nombre_completo', 'cargo', 'buro', 'action'])
            ->toJson();

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */

    public function searchDoc(Request $request)
    {
        $ci = $request->ci;
        $path = public_path('assets/data/re20240131_pp.txt');

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

    public function show(Members $members)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function edit(Members $members)
    {
        $geograficos = Geograficos::all();
        $optionsScope = Scope::getOptions();
        $optionsGender = Gender::getGenders();
        $optionsSocialN = SocialNetwork::getSocialNet();
        $optionsPositions = Positions::getPositions();
        $optionsTypesPositions = Positions::getTypesPositions();
        $optionsBuro = Positions::getBuro();
        $optionsBuroSecFemenina = Positions::getBuroSecFemenina();
        $optionsBuroSecCultura = Positions::getBuroSecCultura();
        // $seccionales = Seccional::all();

        $optionsBuro = collect($optionsBuro)->map(function ($value, $key) {
            return ['key' => $key, 'value' => $value];
        })->values()->toJson();

        $optionsBuroSecFemenina = collect($optionsBuroSecFemenina)->map(function ($value, $key) {
            return ['key' => $key, 'value' => $value];
        })->values()->toJson();

        $optionsBuroSecCultura = collect($optionsBuroSecCultura)->map(function ($value, $key) {
            return ['key' => $key, 'value' => $value];
        })->values()->toJson();

        return view('pages.members.edit', compact('optionsScope', 'optionsGender', 'optionsSocialN', 'optionsTypesPositions', 'optionsPositions', 'optionsBuro', 'optionsBuroSecFemenina', 'optionsBuroSecCultura', 'geograficos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Members $members)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function destroy(Members $members)
    {
        try {
            $members->delete();
            return response()->json(['success' => 'Usuario eliminado correctamente'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Lo sentimos, hubo un error al completar la acción'], 200);
        }
    }

    public function deleteMasive(Request $request)
    {
        $ids = $request->input('ids');

        try {
            Members::whereIn('id', $ids)->delete();
            return response()->json(['message' => 'Los miembros seleccionados se han eliminado correctamente.']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Lo sentimos sucedió algo al realizar la acción.']);
        }
    }

}
