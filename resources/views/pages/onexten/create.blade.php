@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
        <div class="card-body px-4 py-3" bis_skin_checked="1">
        <div class="row align-items-center" bis_skin_checked="1">
            <div class="col-9" bis_skin_checked="1">
            <h4 class="fw-semibold mb-8">Registrar 1 x 10</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('members.index') }}">Miembros</a>
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-body position-relative">
            {{-- <h5 class="card-title fw-semibold mb-4">Registrar Miembro</h5> --}}
            <form class="row" method="POST" action="{{ route('onexten.store') }}">
                @csrf
                <!-- responsable -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="responsable" class="form-label">Responsable</label>
                    <input type="text" class="form-control @error('responsable') is-invalid @enderror" id="responsable" name="responsable" value="{{ old('responsable') }}">
                    @error('responsable')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Teléfono -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}">
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Seccional -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="seccional" class="form-label">Seccional</label>
                    <select class="form-control select2 @error('seccional') is-invalid @enderror" id="seccional" name="seccional">
                        <option value="">Seleccionar</option>
                        @foreach ($seccionales as $seccional)
                            @php
                                $nombre = str_replace('EDO. ', '', $seccional->nombre);
                            @endphp
                            <option value="{{ $seccional->nombre }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
                    @error('seccional')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Municipio -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="municipio" class="form-label">Municipio</label>
                    <select class="form-control select2 @error('municipio') is-invalid @enderror" id="municipio" name="municipio">
                        <option value="">Seleccionar</option>
                    </select>
                    @error('municipio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Parroquia -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="parroquia" class="form-label">Parroquia</label>
                    <select class="form-control select2 @error('parroquia') is-invalid @enderror" id="parroquia" name="parroquia" value="{{ old('parroquia') }}">
                        <option value="">Seleccionar</option>
                    </select>
                    @error('parroquia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- sector -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="sector" class="form-label">Sector</label>
                    <input type="text" class="form-control @error('sector') is-invalid @enderror" id="sector" name="sector" value="{{ old('sector') }}">
                    @error('sector')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PRIMER MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">1. Miembro</h5>
                        <input type="hidden" name="onexten_id[]">
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member1">
                    <!-- Cedula -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-control cedula @error('cedula.0') is-invalid @enderror" data-count="1" name="cedula[]" value="{{ old('cedula.0') }}">
                        @error('cedula.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control nombre @error('nombre.0') is-invalid @enderror" name="nombre[]" value="{{ old('nombre.0') }}">
                        @error('nombre.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control apellido @error('apellido.0') is-invalid @enderror" name="apellido[]" value="{{ old('apellido.0') }}">
                        @error('apellido.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member1">
                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="num_telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('num_telefono.0') is-invalid @enderror" name="num_telefono[]" value="{{ old('num_telefono.0') }}">
                        @error('num_telefono.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Direccion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control @error('direccion.0') is-invalid @enderror" name="direccion[]" value="{{ old('direccion.0') }}">
                        @error('direccion.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Centro de Votacion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="centro_votacion" class="form-label">Centro de Votacion</label>
                        <input type="text" class="form-control centro_votacion @error('centro_votacion.0') is-invalid @enderror" name="centro_votacion[]" value="{{ old('centro_votacion.0') }}">
                        @error('centro_votacion.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- SEGUNDO MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">2. Miembro</h5>
                        <input type="hidden" name="onexten_id[]">
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member2">
                    <!-- Cedula -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-control cedula @error('cedula.1') is-invalid @enderror" data-count="2" name="cedula[]" value="{{ old('cedula.1') }}">
                        @error('cedula.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control nombre @error('nombre.1') is-invalid @enderror" name="nombre[]" value="{{ old('nombre.1') }}">
                        @error('nombre.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control apellido @error('apellido.1') is-invalid @enderror" name="apellido[]" value="{{ old('apellido.1') }}">
                        @error('apellido.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member2">
                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="num_telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('num_telefono.1') is-invalid @enderror" name="num_telefono[]" value="{{ old('num_telefono.1') }}">
                        @error('num_telefono.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Direccion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control @error('direccion.1') is-invalid @enderror" name="direccion[]" value="{{ old('direccion.1') }}">
                        @error('direccion.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Centro de Votacion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="centro_votacion" class="form-label">Centro de Votacion</label>
                        <input type="text" class="form-control centro_votacion @error('centro_votacion.1') is-invalid @enderror" name="centro_votacion[]" value="{{ old('centro_votacion.1') }}">
                        @error('centro_votacion.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- TERCERO MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">3. Miembro</h5>
                        <input type="hidden" name="onexten_id[]">
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member3">
                    <!-- Cedula -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-control cedula @error('cedula.2') is-invalid @enderror" data-count="3" name="cedula[]" value="{{ old('cedula.2') }}">
                        @error('cedula.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control nombre @error('nombre.2') is-invalid @enderror" name="nombre[]" value="{{ old('nombre.2') }}">
                        @error('nombre.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control apellido @error('apellido.2') is-invalid @enderror" name="apellido[]" value="{{ old('apellido.2') }}">
                        @error('apellido.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member3">
                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="num_telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('num_telefono.2') is-invalid @enderror" name="num_telefono[]" value="{{ old('num_telefono.2') }}">
                        @error('num_telefono.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Direccion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control @error('direccion.2') is-invalid @enderror" name="direccion[]" value="{{ old('direccion.2') }}">
                        @error('direccion.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Centro de Votacion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="centro_votacion" class="form-label">Centro de Votacion</label>
                        <input type="text" class="form-control centro_votacion @error('centro_votacion.2') is-invalid @enderror" name="centro_votacion[]" value="{{ old('centro_votacion.2') }}">
                        @error('centro_votacion.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- CUARTO MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">4. Miembro</h5>
                        <input type="hidden" name="onexten_id[]">
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member4">
                    <!-- Cedula -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-control cedula @error('cedula.3') is-invalid @enderror" data-count="4" name="cedula[]" value="{{ old('cedula.3') }}">
                        @error('cedula.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control nombre @error('nombre.3') is-invalid @enderror" name="nombre[]" value="{{ old('nombre.3') }}">
                        @error('nombre.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control apellido @error('apellido.3') is-invalid @enderror" name="apellido[]" value="{{ old('apellido.3') }}">
                        @error('apellido.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member4">
                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="num_telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('num_telefono.3') is-invalid @enderror" name="num_telefono[]" value="{{ old('num_telefono.3') }}">
                        @error('num_telefono.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Direccion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control @error('direccion.3') is-invalid @enderror" name="direccion[]" value="{{ old('direccion.3') }}">
                        @error('direccion.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Centro de Votacion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="centro_votacion" class="form-label">Centro de Votacion</label>
                        <input type="text" class="form-control centro_votacion @error('centro_votacion.3') is-invalid @enderror" name="centro_votacion[]" value="{{ old('centro_votacion.3') }}">
                        @error('centro_votacion.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- QUINTO MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">5. Miembro</h5>
                        <input type="hidden" name="onexten_id[]">
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member5">
                    <!-- Cedula -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-control cedula @error('cedula.4') is-invalid @enderror" data-count="5" name="cedula[]" value="{{ old('cedula.4') }}">
                        @error('cedula.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control nombre @error('nombre.4') is-invalid @enderror" name="nombre[]" value="{{ old('nombre.4') }}">
                        @error('nombre.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control apellido @error('apellido.4') is-invalid @enderror" name="apellido[]" value="{{ old('apellido.4') }}">
                        @error('apellido.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member5">
                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="num_telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('num_telefono.4') is-invalid @enderror" name="num_telefono[]" value="{{ old('num_telefono.4') }}">
                        @error('num_telefono.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Direccion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control @error('direccion.4') is-invalid @enderror" name="direccion[]" value="{{ old('direccion.4') }}">
                        @error('direccion.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Centro de Votacion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="centro_votacion" class="form-label">Centro de Votacion</label>
                        <input type="text" class="form-control centro_votacion @error('centro_votacion.4') is-invalid @enderror" name="centro_votacion[]" value="{{ old('centro_votacion.4') }}">
                        @error('centro_votacion.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- SEXTO MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">6. Miembro</h5>
                        <input type="hidden" name="onexten_id[]">
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member6">
                    <!-- Cedula -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-control cedula @error('cedula.5') is-invalid @enderror" data-count="6" name="cedula[]" value="{{ old('cedula.5') }}">
                        @error('cedula.5')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control nombre @error('nombre.5') is-invalid @enderror" name="nombre[]" value="{{ old('nombre.5') }}">
                        @error('nombre.5')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control apellido @error('apellido.5') is-invalid @enderror" name="apellido[]" value="{{ old('apellido.5') }}">
                        @error('apellido.5')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member6">
                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="num_telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('num_telefono.5') is-invalid @enderror" name="num_telefono[]" value="{{ old('num_telefono.5') }}">
                        @error('num_telefono.5')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Direccion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control @error('direccion.5') is-invalid @enderror" name="direccion[]" value="{{ old('direccion.5') }}">
                        @error('direccion.5')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Centro de Votacion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="centro_votacion" class="form-label">Centro de Votacion</label>
                        <input type="text" class="form-control centro_votacion @error('centro_votacion.5') is-invalid @enderror" name="centro_votacion[]" value="{{ old('centro_votacion.5') }}">
                        @error('centro_votacion.5')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- SEPTIMO MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">7. Miembro</h5>
                        <input type="hidden" name="onexten_id[]">
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member7">
                    <!-- Cedula -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-control cedula @error('cedula.6') is-invalid @enderror" data-count="7" name="cedula[]" value="{{ old('cedula.6') }}">
                        @error('cedula.6')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control nombre @error('nombre.6') is-invalid @enderror" name="nombre[]" value="{{ old('nombre.6') }}">
                        @error('nombre.6')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control apellido @error('apellido.6') is-invalid @enderror" name="apellido[]" value="{{ old('apellido.6') }}">
                        @error('apellido.6')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member7">
                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="num_telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('num_telefono.6') is-invalid @enderror" name="num_telefono[]" value="{{ old('num_telefono.6') }}">
                        @error('num_telefono.6')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Direccion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control @error('direccion.6') is-invalid @enderror" name="direccion[]" value="{{ old('direccion.6') }}">
                        @error('direccion.6')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Centro de Votacion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="centro_votacion" class="form-label">Centro de Votacion</label>
                        <input type="text" class="form-control centro_votacion @error('centro_votacion.6') is-invalid @enderror" name="centro_votacion[]" value="{{ old('centro_votacion.6') }}">
                        @error('centro_votacion.6')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- OCTAVO MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">8. Miembro</h5>
                        <input type="hidden" name="onexten_id[]">
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member8">
                    <!-- Cedula -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-control cedula @error('cedula.7') is-invalid @enderror" data-count="8" name="cedula[]" value="{{ old('cedula.7') }}">
                        @error('cedula.7')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control nombre @error('nombre.7') is-invalid @enderror" name="nombre[]" value="{{ old('nombre.7') }}">
                        @error('nombre.7')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control apellido @error('apellido.7') is-invalid @enderror" name="apellido[]" value="{{ old('apellido.7') }}">
                        @error('apellido.7')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member8">
                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="num_telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('num_telefono.7') is-invalid @enderror" name="num_telefono[]" value="{{ old('num_telefono.7') }}">
                        @error('num_telefono.7')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Direccion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control @error('direccion.7') is-invalid @enderror" name="direccion[]" value="{{ old('direccion.7') }}">
                        @error('direccion.7')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Centro de Votacion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="centro_votacion" class="form-label">Centro de Votacion</label>
                        <input type="text" class="form-control centro_votacion @error('centro_votacion.7') is-invalid @enderror" name="centro_votacion[]" value="{{ old('centro_votacion.7') }}">
                        @error('centro_votacion.7')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- NOVENO MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">9. Miembro</h5>
                        <input type="hidden" name="onexten_id[]">
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member9">
                    <!-- Cedula -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-control cedula @error('cedula.8') is-invalid @enderror" data-count="9" name="cedula[]" value="{{ old('cedula.8') }}">
                        @error('cedula.8')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control nombre @error('nombre.8') is-invalid @enderror" name="nombre[]" value="{{ old('nombre.8') }}">
                        @error('nombre.8')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control apellido @error('apellido.8') is-invalid @enderror" name="apellido[]" value="{{ old('apellido.8') }}">
                        @error('apellido.8')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member9">
                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="num_telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('num_telefono.8') is-invalid @enderror" name="num_telefono[]" value="{{ old('num_telefono.8') }}">
                        @error('num_telefono.8')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Direccion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control @error('direccion.8') is-invalid @enderror" name="direccion[]" value="{{ old('direccion.8') }}">
                        @error('direccion.8')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Centro de Votacion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="centro_votacion" class="form-label">Centro de Votacion</label>
                        <input type="text" class="form-control centro_votacion @error('centro_votacion.8') is-invalid @enderror" name="centro_votacion[]" value="{{ old('centro_votacion.8') }}">
                        @error('centro_votacion.8')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- DECIMO MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">10. Miembro</h5>
                        <input type="hidden" name="onexten_id[]">
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member10">
                    <!-- Cedula -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-control cedula @error('cedula.9') is-invalid @enderror" data-count="10" name="cedula[]" value="{{ old('cedula.9') }}">
                        @error('cedula.9')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control nombre @error('nombre.9') is-invalid @enderror" name="nombre[]" value="{{ old('nombre.9') }}">
                        @error('nombre.9')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control apellido @error('apellido.9') is-invalid @enderror" name="apellido[]" value="{{ old('apellido.9') }}">
                        @error('apellido.9')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row p-3 bg-light-subtle m-0 member10">
                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="num_telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('num_telefono.9') is-invalid @enderror" name="num_telefono[]" value="{{ old('num_telefono.9') }}">
                        @error('num_telefono.9')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Direccion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control @error('direccion.9') is-invalid @enderror" name="direccion[]" value="{{ old('direccion.9') }}">
                        @error('direccion.9')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Centro de Votacion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="centro_votacion" class="form-label">Centro de Votacion</label>
                        <input type="text" class="form-control centro_votacion @error('centro_votacion.9') is-invalid @enderror" name="centro_votacion[]" value="{{ old('centro_votacion.9') }}">
                        @error('centro_votacion.9')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
   
                <div class="col-12 align-self-end">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
            <div class="position-absolute top-50 start-50 translate-middle glassContainer w-100">
                <img src="{{ asset('assets/images/logos/logo-b.png') }}" class="glassLogo" />
            </div>
        </div>
    </div>

    <div id="loading-message">
        <div class="spinner-border"></div>
        <span>Cargando...</span>
    </div>

    @if ($errors->any())
        <div id="old-errors" data-old-errors="{{ json_encode($errors->all()) }}" style="display: none;"></div>
    @endif

@endsection

@section('page-scripts')
    @if ($errors->any())
        <script>
            console.log('Errores de validación:');
            @foreach ($errors->all() as $error)
                console.log("{{ $error }}");
            @endforeach
        </script>
    @endif
    <script>
        window.urlFetchCiData = "{{ route('members.searchDoc')}}";
        window.urlFetchScopeData = "{{ route('members.getScopeInfo')}}";
        window.geograficos = @json($geograficos);
        window.responseData = null;
        // window.centrosVotaciones @json($centros_votaciones);
        // console.log(window.centrosVotaciones);

        
        
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/forms/select2.init.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/forms/datepicker-init.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/pages/members/members-register.js') }}"></script> --}}
    <script src="{{ asset('assets/js/pages/members/onexten-register.js') }}"></script>
    
@endsection
