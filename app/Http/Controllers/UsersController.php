<?php

namespace App\Http\Controllers;

use App\Mail\UserCredentialsMail;
use DataTables;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create');
    }

    public function useremail()
    {
        return view('pages.emails.user_credentials');
    }

    public function modal_delete(Users $users)
    {
        return view('pages.users.modal.deleteUsers', compact('users'));
    }

    public function list()
    {
        $model = Users::query()->orderBy('created_at', 'desc');

        $data = DataTables::of($model)
            ->addColumn('action', function($row){
                if ($row->id != 1) {
                    return '<div class="d-flex">
                        <a href="'. route('users.edit', $row) .'" class="btn btn-icon btn-info btn-sm me-1">
                            <i class="ti ti-pencil"></i>
                        </a>
                        <button class="btn btn-icon btn-danger btn-sm modal-pers" data-path="'. route('users.modalDelete', $row) .'">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>';
                } else {
                    return '-';
                }
            })
            ->rawColumns(['action'])
            ->toJson();

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        dd($request);
    }

    public function storeU(UserStoreRequest $request)
    {
        // return $request['correo'];
        try {
            $email = $request['correo'];
            $password = Str::random(10);
            $newUser = new Users;
            $newUser->name = 'User';
            $newUser->email = $email;
            $newUser->password = Hash::make($password);
            $newUser->save();
            Mail::to($newUser->email)->send(new UserCredentialsMail($newUser->email, $password));

            session()->flash('success', 'Usuario registrado correctamente.');
            return redirect()->route('users.index');

        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', 'Hubo un error al registrar el usuario. Por favor, inténtalo de nuevo. Error: ' . $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $users)
    {
        // return $users;
        return view('pages.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(UserStoreRequest $request, Users $users)
    {
        try {
            $data = $request->validated();
            $users->update(['email' => $data['correo']]);
            session()->flash('success', 'Usuario actualizado correctamente.');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Hubo un error al actualizar el usuario. Por favor, inténtalo de nuevo. Error: ' . $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $users)
    {
        if ($users->id == 1) {
            return response()->json(['error' => 'No se puede eliminar el usuario con ID 1'], 403);
        } else {
            try {
                $users->delete();
                return response()->json(['success' => 'Usuario eliminado correctamente'], 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => 'Lo sentimos, hubo un error al completar la acción'], 200);
            }
        }
    }
}
