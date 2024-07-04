<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionsRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:mostrar-permisos', ['only' => ['index']]);
        $this->middleware('permission:crear-permiso', ['only' => ['create', 'store']]);
        $this->middleware('permission:ver-permiso', ['only' => ['show']]);
        $this->middleware('permission:editar-permiso', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-permiso', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.permissions.index');
    }

    public function list()
    {
        $model = Permission::orderBy('created_at', 'desc')->get();
        // dd($model);
        $data = DataTables::of($model)
            ->addColumn('action', 'pages.permissions.partials.btns')
            ->rawColumns(['action'])
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
        return view('pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionsRequest $request)
    {
        Permission::create($request->all());

        session()->flash('success', 'Permiso creado con éxito.');

        return redirect()->route('permissions.index');
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
        $permission = Permission::find($id);

        return view('pages.permissions.edit', compact('permission'));
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
        $permission = Permission::find($id);
        $permission->update($request->all());

        session()->flash('success', 'Permiso editado con éxito.');

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        session()->flash('success', 'Permiso eliminado con éxito.');

        return redirect()->route('permissions.index');
    }
}
