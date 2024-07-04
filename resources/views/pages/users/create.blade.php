@extends('layouts.app')

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
        <div class="card-body px-4 py-3" bis_skin_checked="1">
        <div class="row align-items-center" bis_skin_checked="1">
            <div class="col-9" bis_skin_checked="1">
            <h4 class="fw-semibold mb-8">Registrar Usuario</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('users.index') }}">Usuarios</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Registrar</li>
                </ol>
            </nav>
            </div>
            <div class="col-3" bis_skin_checked="1">
            <div class="text-center mb-n5" bis_skin_checked="1">
                <img src="{{ asset('assets/images/notices/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- <h5 class="card-title fw-semibold mb-4">Registrar Usuario</h5> --}}
            <form class="row" method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="name" id="" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="" value="{{ old('password') }}" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" name="password_confirmation" id="" value="{{ old('password_confirmation') }}" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    {!! Form::label('roles', 'Role', ['class' => 'form-label']) !!}
                    {{ Form::select('roles', $roles, [], ['class' => 'form-select', 'placeholder' => 'Seleccione role']) }}
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
