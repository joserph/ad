<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembersStoreRequest;
use App\Http\Requests\MembersUpdateRequest;
use App\Models\Gender;
use App\Models\Geograficos;
use App\Models\Members;
use App\Models\Positions;
use App\Models\Scope;
use App\Models\Seccional;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class MemberMunicipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.membersMunicipal.index');
    }

    public function list()
    {
        $model = Members::where('alcance', 'Municipal')->orderBy('created_at', 'desc')->get();
        // dd($model);
        $data = DataTables::of($model)
            ->editColumn('nombre_completo', function($row){
                $nombreC = $row->nombre . " " . $row->apellido;
                $nombre_completo = '<div class="d-flex flex-column">' .
                    '<h6 class="mb-0">' . $nombreC . '</h6>' .
                    '<h6 class="fw-bolder mb-0">' . $row->cedula . '</h6>' .
                '</div>';
                return $nombre_completo;
            })
            ->editColumn('alcance', function($row){
                $alcance = '<h5><span class="badge text-bg-success">'. $row->alcance .'</span></h5>';
                return $alcance;
            })
            ->editColumn('direccion', function($row){
                $direccion = '<small class="fw-bolder">' . $row->seccional . '</small></br>' .
                    '<small class="fw-bolder">' . $row->municipio . '</small></br>' .
                    '<small class="fw-bolder">' . $row->parroquia . '</small>'
                ;
                return $direccion;
            })
            ->editColumn('cargo', function($row) {
                $tipoCargoDescripcion = Positions::getTypesPositions()[$row->tipo_cargo] ?? '';
                //var_dump($tipoCargoDescripcion);
                $cargoDescripcion = $row->cargo !== null ? (Positions::getPositions()[$row->cargo] ?? 'No definido') : '';

                $cargo = '<div class="d-flex flex-column">' .
                    '<small class="fw-bolder">' . $tipoCargoDescripcion . '</small>' .
                    '<small class="fw-bolder">' . $cargoDescripcion . '</small>' .
                '</div>';
                return $cargo;
            })
            ->editColumn('buro', function($row) {
                //var_dump($buro);
                if($row->tipo_cargo == 5){
                    if ($row->cargo == 0) {
                        $buro = Positions::getBuroSecAgraria()[$row->buro];
                    }elseif($row->cargo == 1){
                        $buro = Positions::getBuroSecAsuntosMunicipales()[$row->buro];
                    }elseif($row->cargo == 2){
                        $buro = Positions::getBuroSecCultura()[$row->buro];
                    }elseif($row->cargo == 3){
                        $buro = Positions::getBuroSecEducacion()[$row->buro];
                    }elseif($row->cargo == 4){
                        $buro = Positions::getBuroSecFemenina()[$row->buro];
                    }elseif($row->cargo == 5){
                        $buro = Positions::getBuroSecJuvenil()[$row->buro];
                    }elseif($row->cargo == 6){
                        $buro = Positions::getBuroSecSindical()[$row->buro];
                    }elseif($row->cargo == 7){
                        $buro = Positions::getBuroSecProfesionalesYTecnicos()[$row->buro];
                    }else{
                        $buro = '<small class="fw-bolder">No asignado</small>';
                    }
                }else{
                    $buro = '<small class="fw-bolder">No asignado</small>';
                }
                
                return $buro;
            })
            ->addColumn('action', 'pages.membersMunicipal.partials.btns')
            ->rawColumns(['nombre_completo', 'alcance', 'direccion', 'cargo', 'buro', 'action'])
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
        $optionsGender = Gender::getGenders();
        $optionsSocialN = SocialNetwork::getSocialNet();
        $optionsScope = Scope::getOptions();
        $seccionales = Seccional::all();
        $optionsTypesPositions = Positions::getTypesPositions();
        $optionsPositions = Positions::getPositions();
        $optionsBuroSecAgraria = Positions::getBuroSecAgraria();
        $optionsBuroSecAsuntosMunicipales = Positions::getBuroSecAsuntosMunicipales();
        $optionsBuroSecCultura = Positions::getBuroSecCultura();
        $optionsBuroSecEducacion = Positions::getBuroSecEducacion();
        $optionsBuroSecFemenina = Positions::getBuroSecFemenina();
        $optionsBuroSecJuvenil = Positions::getBuroSecJuvenil();
        $optionsBuroSecSindical = Positions::getBuroSecSindical();
        $optionsBuroSecProfesionalesYTecnicos = Positions::getBuroSecProfesionalesYTecnicos();
        $geograficos = Geograficos::all();
        // dd($optionsScope['seccional']);
        return view('pages.membersMunicipal.create', compact(
            'optionsGender',
            'optionsSocialN',
            'optionsScope',
            'seccionales',
            'optionsTypesPositions',
            'optionsPositions',
            'optionsBuroSecAgraria',
            'optionsBuroSecAsuntosMunicipales',
            'optionsBuroSecCultura',
            'optionsBuroSecEducacion',
            'optionsBuroSecFemenina',
            'optionsBuroSecJuvenil',
            'optionsBuroSecSindical',
            'optionsBuroSecProfesionalesYTecnicos',
            'geograficos'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MembersStoreRequest $request)
    {
        // dd('Guardar');
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $member = Members::create($validated);

            $buro = '';
            if($request->buro_sec_agraria >= 0 && $request->buro_sec_agraria < 3 && $request->cargo == 0){
                $buro = $request->buro_sec_agraria;
            }elseif($request->buro_sec_asuntos_municipales > 2 && $request->buro_sec_asuntos_municipales < 6 && $request->cargo == 1){
                $buro = $request->buro_sec_asuntos_municipales;
            }elseif($request->buro_sec_cultura > 5 && $request->buro_sec_cultura < 9 && $request->cargo == 2){
                $buro = $request->buro_sec_cultura;
            }elseif($request->buro_sec_educacion > 8 && $request->buro_sec_educacion < 12 && $request->cargo == 3){
                $buro = $request->buro_sec_educacion;
            }elseif($request->buro_sec_femenina > 11 && $request->buro_sec_femenina < 15 && $request->cargo == 4){
                $buro = $request->buro_sec_femenina;
            }elseif($request->buro_sec_juvenil > 14 && $request->buro_sec_juvenil < 30 && $request->cargo == 5){
                $buro = $request->buro_sec_juvenil;
            }elseif($request->buro_sec_sindical > 29 && $request->buro_sec_sindical < 33 && $request->cargo == 6){
                $buro = $request->buro_sec_sindical;
            }elseif($request->buro_sec_profesionales_y_tecnico > 32 && $request->buro_sec_profesionales_y_tecnico < 36 && $request->cargo == 7){
                $buro = $request->buro_sec_profesionales_y_tecnico;
            }
            
            $member['buro'] = $buro;
            $member->save();

            DB::commit();

            session()->flash('success', 'Miembro creado con éxito!');

            return redirect()->route('members-municipal.index');

        } catch (\Exception $e) {
            DB::rollBack();
            // Suponiendo que $e es una instancia de Exception capturada en un bloque catch
            session()->flash('error', 'Hubo un error al crear el usuario. Por favor, inténtalo de nuevo. Error: ' . $e->getMessage());

            return redirect()->back();
        }
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
        $member = Members::find($id);
        $optionsGender = Gender::getGenders();
        $optionsSocialN = SocialNetwork::getSocialNet();
        $optionsPositions = Positions::getPositions();
        $optionsTypesPositions = Positions::getTypesPositions();
        $optionsScope = Scope::getOptions();
        $seccionales = Seccional::all();
        $optionsBuroSecFemenina = Positions::getBuroSecFemenina();
        $optionsBuroSecCultura = Positions::getBuroSecCultura();
        $optionsBuroSecAgraria = Positions::getBuroSecAgraria();
        $optionsBuroSecAsuntosMunicipales = Positions::getBuroSecAsuntosMunicipales();
        $optionsBuroSecEducacion = Positions::getBuroSecEducacion();
        $optionsBuroSecJuvenil = Positions::getBuroSecJuvenil();
        $optionsBuroSecSindical = Positions::getBuroSecSindical();
        $optionsBuroSecProfesionalesYTecnicos = Positions::getBuroSecProfesionalesYTecnicos();
        $geograficos = Geograficos::all();
        // dd($member);
        return view('pages.membersMunicipal.edit', compact(
            'member',
            'optionsGender',
            'optionsSocialN',
            'optionsPositions',
            'optionsTypesPositions',
            'optionsScope',
            'seccionales',
            'optionsBuroSecFemenina', 
            'optionsBuroSecCultura', 
            'optionsBuroSecAgraria',
            'optionsBuroSecAsuntosMunicipales',
            'optionsBuroSecEducacion',
            'optionsBuroSecJuvenil',
            'optionsBuroSecSindical',
            'optionsBuroSecProfesionalesYTecnicos',
            'geograficos'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MembersUpdateRequest $request, $id)
    {
        // dd($request);
        $member = Members::find($id);

        $member->update($request->all());
        $buro = '';
        if($request->buro_sec_agraria >= 0 && $request->buro_sec_agraria < 3 && $request->cargo == 0){
            $buro = $request->buro_sec_agraria;
        }elseif($request->buro_sec_asuntos_municipales > 2 && $request->buro_sec_asuntos_municipales < 6 && $request->cargo == 1){
            $buro = $request->buro_sec_asuntos_municipales;
        }elseif($request->buro_sec_cultura > 5 && $request->buro_sec_cultura < 9 && $request->cargo == 2){
            $buro = $request->buro_sec_cultura;
        }elseif($request->buro_sec_educacion > 8 && $request->buro_sec_educacion < 12 && $request->cargo == 3){
            $buro = $request->buro_sec_educacion;
        }elseif($request->buro_sec_femenina > 11 && $request->buro_sec_femenina < 15 && $request->cargo == 4){
            $buro = $request->buro_sec_femenina;
        }elseif($request->buro_sec_juvenil > 14 && $request->buro_sec_juvenil < 30 && $request->cargo == 5){
            $buro = $request->buro_sec_juvenil;
        }elseif($request->buro_sec_sindical > 29 && $request->buro_sec_sindical < 33 && $request->cargo == 6){
            $buro = $request->buro_sec_sindical;
        }elseif($request->buro_sec_profesionales_y_tecnico > 32 && $request->buro_sec_profesionales_y_tecnico < 36 && $request->cargo == 7){
            $buro = $request->buro_sec_profesionales_y_tecnico;
        }
        
        $member['buro'] = $buro;
        $member->save();
        //dd($member);
        session()->flash('success', 'Miembro actualizado con éxito!');

        return redirect()->route('members-municipal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Members::findOrFail($id);
        // dd($member);
        $member->delete();

        session()->flash('success', 'Miembro eliminado con éxito!');

        return redirect()->route('members-municipal.index');
    }
}
