<?php

namespace App\Http\Controllers;

use App\Http\Requests\PictureRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('pages.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->update($request->all());

        session()->flash('success', 'Perfil actualizado con éxito.');

        return redirect()->route('profile.index');
    }

    public function picture(PictureRequest $request)
    {
        
        $user = User::find($request->id);
        
        // dd($old_picture);
        $file = $request->file('picture');
        //$name = Str::random(30) . '-' . $request->file('image')->getClientOriginalName();
        
        // $file->storeAs('public/uploads', $nameImage);
        $fullPath = 'storage/uploads/profile';
        $nameImage = $fullPath . '/profile_' . time() . '.' . $file->getClientOriginalExtension();
        // $path = public_path() . '/profiles/';
        if($file->move($fullPath, $nameImage))
        {
            if($user->picture)
            {
                $old_picture = str_replace('storage', '', $user->picture);
                unlink(storage_path() . '/app/public' . $old_picture);
            }
            
        }
        $user->where('id', $request->id)
            ->update(['picture' => $nameImage]);

        session()->flash('success', 'Imagen de Perfil actualizado con éxito.');

        return redirect()->route('profile.index');
        
    }
}
