<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Comite;
use App\Models\Scope;
use App\Models\Geograficos;
use App\Models\Seccional;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Gender;
use App\Models\Positions;
use App\Models\SocialNetwork;
use App\Http\Requests\MembersStoreRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class ComiteLocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.comite.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        return view('pages.comite.create', compact('optionsScope', 'optionsGender', 'optionsSocialN', 'optionsTypesPositions', 'optionsPositions', 'optionsBuro', 'optionsBuroSecFemenina', 'optionsBuroSecCultura', 'geograficos'));
    }

    public function members(Comite $comite)
    {
        return view('pages.comite.modal.members', compact('comite'));
    }

    public function list()
    {
        $model = Comite::query()->orderBy('created_at', 'desc');

        $data = DataTables::of($model)
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('members', function ($row) {
                return '<button data-path="'. route('committe-local.members', $row) .'" class="btn btn-info btn-sm modal-pers">'.count($row->members).'</button>';
            })
            ->addColumn('action', function($row){
                return '<div class="d-flex">
                    <a href="'. route('committe-local.edit', $row) .'" class="btn btn-icon btn-info btn-sm me-1">
                        <i class="ti ti-pencil"></i>
                    </a>
                    <button class="btn btn-icon btn-danger btn-sm modal-pers" data-path="'. route('committe-local.modalDelete', $row) .'">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['members', 'action'])
            ->toJson();

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    public function edit(Comite $comite)
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

        return view('pages.comite.edit', compact('optionsScope', 'optionsGender', 'optionsSocialN', 'optionsTypesPositions', 'optionsPositions', 'optionsBuro', 'optionsBuroSecFemenina', 'optionsBuroSecCultura', 'comite', 'geograficos'));
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

    public function modal_delete(Comite $comite)
    {
        return view('pages.comite.modal.deleteComite', compact('comite'));
    }

    public function destroy(Comite $comite)
    {
        try {
            $comite->delete();
            return response()->json(['success' => 'Comite eliminado correctamente'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Lo sentimos, hubo un error al completar la acción'], 200);
        }
    }
}
