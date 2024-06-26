@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<style>

</style>
@endsection

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
        <div class="card-body px-4 py-3" bis_skin_checked="1">
        <div class="row align-items-center" bis_skin_checked="1">
            <div class="col-9" bis_skin_checked="1">
            <h4 class="fw-semibold mb-8">Comite local</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('committe-local.index') }}">Comite</a>
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
        <div class="card-body position-relative py-3 px-0">
            {{-- <div class="row p-3 m-0">
                <div class="col-12">
                    <h5 class="card-title fw-semibold">Registrar Comite Local</h5>
                </div>
            </div> --}}
            <form class="row m-0" method="POST" action="{{ route('members.comiteStore') }}">
                @csrf

                <div class="row p-3 m-0">
                    <!-- Nombre del comite -->
                    <div class="mb-3 col-lg-6">
                        <label for="nombre_comite" class="form-label">Nombre del comite</label>
                        <input type="text" class="form-control @error('nombre_comite') is-invalid @enderror" id="nombre_comite" name="nombre_comite" value="{{ old('nombre_comite') }}">
                        @error('nombre_comite')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row bg-light-subtle p-3 m-0">
                    <!-- Seccional -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="seccional" class="form-label">Seccional</label>
                        <select class="form-control select2 @error('seccional') is-invalid @enderror" id="seccional" name="seccional">
                            <option value="">Seleccionar</option>
                            {{-- @foreach ($seccionales as $seccional)
                                @php
                                    $nombre = str_replace('EDO. ', '', $seccional->nombre);
                                @endphp
                                <option value="{{ $seccional->id }}" {{ old('seccional') == $seccional ? 'selected' : '' }}>{{ $nombre }}</option>
                            @endforeach --}}
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
                        <select class="form-control select2 @error('parroquia') is-invalid @enderror" id="parroquia" name="parroquia">
                            <option value="">Seleccionar</option>
                        </select>
                        @error('parroquia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                {{-- PRIMER MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">1. Miembro</h5>
                    </div>
                </div>

                <div class="row p-3 m-0 member1">
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
                    <!-- Fecha de nacimiento  -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <div class="input-group">
                            <input type="text" class="form-control mydatepicker fecha @error('fecha_nacimiento.0') is-invalid @enderror" name="fecha_nacimiento[]" value="{{ old('fecha_nacimiento.0') }}" placeholder="Seleccione una fecha" autocomplete="off">
                            <span class="input-group-text">
                            <i class="ti ti-calendar fs-5"></i>
                            </span>
                        </div>
                        @error('fecha_nacimiento.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Genero -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="genero" class="form-label">Genero</label>
                        <select name="genero[]" class="form-control select2 genero @error('genero.0') is-invalid @enderror">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsGender as $value => $label)
                                <option value="{{ $value }}" {{ old('genero.0') == $value ? 'selected' : '' }}>{{ $label }}</option>";
                            @endforeach
                        </select>
                        @error('genero.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('telefono.0') is-invalid @enderror" name="telefono[]" value="{{ old('telefono.0') }}">
                        @error('telefono.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 m-0">
                    <!-- Correo -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control @error('correo.0') is-invalid @enderror" name="correo[]" value="{{ old('correo.0') }}">
                        @error('correo.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Profesion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="profesion" class="form-label">Profesion</label>
                        <input type="text" class="form-control @error('profesion.0') is-invalid @enderror" name="profesion[]" value="{{ old('profesion.0') }}">
                        @error('profesion.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Red Social -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="red_social" class="form-label">Red Social</label>
                        <select type="text" class="form-control select2 @error('red_social.0') is-invalid @enderror" name="red_social[]">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsSocialN as $value => $label)
                                <option value="{{ $value }}" {{ old('red_social.0') == $value ? 'selected' : '' }}>{{ $label }}</option>";
                            @endforeach
                        </select>
                        @error('red_social.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 bg-light-subtle m-0">
                    <!-- Usuario Red -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="usuario_red" class="form-label">Usuario Red Social</label>
                        <input type="text" class="form-control @error('usuario_red.0') is-invalid @enderror" name="usuario_red[]" value="{{ old('usuario_red.0') }}">
                        @error('usuario_red.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tipo de Cargo -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="" class="form-label">Tipo de Cargo</label>
                        <select class="form-control select2 tipo_cargo @error('tipo_cargo.0') is-invalid @enderror" data-col="cargo1" name="tipo_cargo[]">
                            <option value="" selected>Seleccionar</option>
                            @foreach ($optionsTypesPositions as $value => $label)
                                <option value="{{ $value }}" {{ old('tipo_cargo.0') == $value ? 'selected' : '' }}>{{ $label }}</option>";
                            @endforeach
                        </select>
                        @error('tipo_cargo.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Cargo -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none">
                        <label for="cargo" class="form-label">Cargos Administrativos</label>
                        <select class="form-control select2 @error('cargo.0') is-invalid @enderror"
                            name="cargo[]" id="cargo1">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsPositions as $value => $label)
                                <option value="{{ $value }}" {{ old('cargo.0') == $value ? 'selected' : '' }}>{{ $label }}</option>";
                            @endforeach
                        </select>
                        @error('cargo.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 m-0">
                    <!-- Buro -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none">
                        <label for="" class="form-label">Buró</label>
                        <select class="form-control select2 @error('buro.0') is-invalid @enderror" name="buro[]" id="cargo1buro">
                            <option value="">Seleccionar</option>
                        </select>
                        @error('buro.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Posees cargos de administración público -->
                    <div class="mb-3 col-md-6 col-lg-4 align-self-end">
                        <label class="form-label me-3">Posees cargos de administración pública</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input cargoPublicoCheck" data-col="cargo_pub1" type="radio" name="cargosAdm[0]" id="inlineRadio1"
                            value="si" {{ old('cargosAdm.0') == 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input cargoPublicoCheck" data-col="cargo_pub1" type="radio" name="cargosAdm[0]" id="inlineRadio2"
                            value="no" {{ old('cargosAdm.0') == 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio2">No</label>
                        </div>
                        @error('cargosAdm.0')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Cargo publico -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none" id="cargo_pub1">
                        <label for="cargo_pub" class="form-label">Cargo público</label>
                        <input type="text" class="form-control @error('cargo_pub.0') is-invalid @enderror" id="" name="cargo_pub[]" value="{{ old('cargo_pub.0') }}">
                        @error('cargo_pub.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- SEGUNDO MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">2. Miembro</h5>
                    </div>
                </div>

                <div class="row p-3 m-0 member2">
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

                    <!-- Fecha de nacimiento  -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <div class="input-group">
                            <input type="text" class="form-control mydatepicker fecha @error('fecha_nacimiento.1') is-invalid @enderror" name="fecha_nacimiento[]" value="{{ old('fecha_nacimiento.1') }}" placeholder="Seleccione una fecha" autocomplete="off">
                            <span class="input-group-text">
                                <i class="ti ti-calendar fs-5"></i>
                            </span>
                        </div>
                        @error('fecha_nacimiento.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Genero -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="genero" class="form-label">Genero</label>
                        <select name="genero[]" class="form-control select2 genero @error('genero.1') is-invalid @enderror">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsGender as $value => $label)
                                <option value="{{ $value }}" {{ old('genero.1') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('genero.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('telefono.1') is-invalid @enderror" name="telefono[]" value="{{ old('telefono.1') }}">
                        @error('telefono.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 m-0">
                    <!-- Correo -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control @error('correo.1') is-invalid @enderror" name="correo[]" value="{{ old('correo.1') }}">
                        @error('correo.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Profesion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="profesion" class="form-label">Profesion</label>
                        <input type="text" class="form-control @error('profesion.1') is-invalid @enderror" name="profesion[]" value="{{ old('profesion.1') }}">
                        @error('profesion.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Red Social -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="red_social" class="form-label">Red Social</label>
                        <select type="text" class="form-control select2 @error('red_social.1') is-invalid @enderror" name="red_social[]">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsSocialN as $value => $label)
                                <option value="{{ $value }}" {{ old('red_social.1') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('red_social.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 bg-light-subtle m-0">
                    <!-- Usuario Red -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="usuario_red" class="form-label">Usuario Red Social</label>
                        <input type="text" class="form-control @error('usuario_red.1') is-invalid @enderror" name="usuario_red[]" value="{{ old('usuario_red.1') }}">
                        @error('usuario_red.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tipo de Cargo -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="" class="form-label">Tipo de Cargo</label>
                        <select class="form-control select2 tipo_cargo @error('tipo_cargo.1') is-invalid @enderror" data-col="cargo2"
                            name="tipo_cargo[]">
                            <option value="" selected>Seleccionar</option>
                            @foreach ($optionsTypesPositions as $value => $label)
                                <option value="{{ $value }}" {{ old('tipo_cargo.1') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('tipo_cargo.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Cargo -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none">
                        <label for="" class="form-label">Cargos Administrativos</label>
                        <select class="form-control select2 @error('cargo.1') is-invalid @enderror"
                            name="cargo[]" id="cargo2">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsPositions as $value => $label)
                                <option value="{{ $value }}" {{ old('cargo.1') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('cargo.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 m-0">
                    <!-- Buro -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none">
                        <label for="" class="form-label">Buró</label>
                        <select class="form-control select2 @error('buro.1') is-invalid @enderror" name="buro[]" id="cargo2buro">
                            <option value="">Seleccionar</option>
                        </select>
                        @error('buro.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Posees cargos de administración público -->
                    <div class="mb-3 col-md-6 col-lg-4 align-self-end">
                        <label class="form-label me-3">Posees cargos de administración pública</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input cargoPublicoCheck" data-col="cargo_pub2" type="radio" name="cargosAdm[1]" id="inlineRadio3"
                            value="si" {{ old('cargosAdm.1') == 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio3">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input cargoPublicoCheck" data-col="cargo_pub2" type="radio" name="cargosAdm[1]" id="inlineRadio4"
                            value="no" {{ old('cargosAdm.1') == 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio4">No</label>
                        </div>
                        @error('cargosAdm.1')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Cargo publico -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none" id="cargo_pub2">
                        <label for="cargo_pub" class="form-label">Cargo público</label>
                        <input type="text" class="form-control @error('cargo_pub.1') is-invalid @enderror" id="" name="cargo_pub[]" value="{{ old('cargo_pub.1') }}">
                        @error('cargo_pub.1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- TERCER MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">3. Miembro</h5>
                    </div>
                </div>

                <div class="row p-3 m-0 member3">
                    <!-- Cedula -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="" class="form-label">Cedula</label>
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
                        <input type="text" class="form-control apellido @error('apellido.2') is-invalid @enderror"  name="apellido[]" value="{{ old('apellido.2') }}">
                        @error('apellido.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 bg-light-subtle m-0 member3">

                    <!-- Fecha de nacimiento  -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <div class="input-group">
                            <input type="text" class="form-control mydatepicker fecha @error('fecha_nacimiento.2') is-invalid @enderror" name="fecha_nacimiento[]" value="{{ old('fecha_nacimiento.2') }}" placeholder="Seleccione una fecha" autocomplete="off">
                            <span class="input-group-text">
                                <i class="ti ti-calendar fs-5"></i>
                            </span>
                        </div>
                        @error('fecha_nacimiento.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Genero -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="genero" class="form-label">Genero</label>
                        <select name="genero[]" class="form-control select2 genero @error('genero.2') is-invalid @enderror">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsGender as $value => $label)
                                <option value="{{ $value }}" {{ old('genero.2') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('genero.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('telefono.2') is-invalid @enderror" name="telefono[]" value="{{ old('telefono.2') }}">
                        @error('telefono.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 m-0">
                    <!-- Correo -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control @error('correo.2') is-invalid @enderror" name="correo[]" value="{{ old('correo.2') }}">
                        @error('correo.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Profesion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="profesion" class="form-label">Profesion</label>
                        <input type="text" class="form-control @error('profesion.2') is-invalid @enderror" name="profesion[]" value="{{ old('profesion.2') }}">
                        @error('profesion.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Red Social -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="red_social" class="form-label">Red Social</label>
                        <select type="text" class="form-control select2 @error('red_social.2') is-invalid @enderror" name="red_social[]">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsSocialN as $value => $label)
                                <option value="{{ $value }}" {{ old('red_social.2') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('red_social.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 bg-light-subtle m-0">
                    <!-- Usuario Red -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="usuario_red" class="form-label">Usuario Red Social</label>
                        <input type="text" class="form-control @error('usuario_red.2') is-invalid @enderror" name="usuario_red[]" value="{{ old('usuario_red.2') }}">
                        @error('usuario_red.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tipo de Cargo -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="" class="form-label">Tipo de Cargo</label>
                        <select class="form-control select2 tipo_cargo @error('tipo_cargo.2') is-invalid @enderror" data-col="cargo3"
                            name="tipo_cargo[]">
                            <option value="" selected>Seleccionar</option>
                            @foreach ($optionsTypesPositions as $value => $label)
                                <option value="{{ $value }}" {{ old('tipo_cargo.2') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('tipo_cargo.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Cargo -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none">
                        <label for="cargo" class="form-label">Cargos Administrativos</label>
                        <select class="form-control select2 @error('cargo.2') is-invalid @enderror"
                            name="cargo[]" id="cargo3">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsPositions as $value => $label)
                                <option value="{{ $value }}" {{ old('cargo.2') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('cargo.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 m-0">
                    <!-- Buro -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none">
                        <label for="" class="form-label">Buró</label>
                        <select class="form-control select2 @error('buro.2') is-invalid @enderror" name="buro[]" id="cargo3buro">
                            <option value="">Seleccionar</option>
                        </select>
                        @error('buro.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Posees cargos de administración público -->
                    <div class="mb-3 col-md-6 col-lg-4 align-self-end">
                        <label class="form-label me-3">Posees cargos de administración pública</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input cargoPublicoCheck" data-col="cargo_pub3" type="radio" name="cargosAdm[2]" id="inlineRadio5"
                            value="si" {{ old('cargosAdm.2') == 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio5">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input cargoPublicoCheck" data-col="cargo_pub3" type="radio" name="cargosAdm[2]" id="inlineRadio6"
                            value="no" {{ old('cargosAdm.2') == 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio6">No</label>
                        </div>
                        @error('cargosAdm.2')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Cargo publico -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none" id="cargo_pub3">
                        <label for="cargo_pub" class="form-label">Cargo público</label>
                        <input type="text" class="form-control @error('cargo_pub.2') is-invalid @enderror" id="" name="cargo_pub[]" value="{{ old('cargo_pub.2') }}">
                        @error('cargo_pub.2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- CUARTO MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">4. Miembro</h5>
                    </div>
                </div>

                <div class="row p-3 m-0 member4">
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
                        <input type="text" class="form-control apellido @error('apellido.3') is-invalid @enderror"  name="apellido[]" value="{{ old('apellido.3') }}">
                        @error('apellido.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 bg-light-subtle m-0 member4">

                    <!-- Fecha de nacimiento  -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <div class="input-group">
                            <input type="text" class="form-control mydatepicker fecha @error('fecha_nacimiento.3') is-invalid @enderror" name="fecha_nacimiento[]" value="{{ old('fecha_nacimiento.3') }}" placeholder="Seleccione una fecha" autocomplete="off">
                            <span class="input-group-text">
                                <i class="ti ti-calendar fs-5"></i>
                            </span>
                        </div>
                        @error('fecha_nacimiento.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Genero -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="genero" class="form-label">Genero</label>
                        <select name="genero[]" class="form-control select2 genero @error('genero.3') is-invalid @enderror">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsGender as $value => $label)
                                <option value="{{ $value }}" {{ old('genero.3') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('genero.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('telefono.3') is-invalid @enderror" name="telefono[]" value="{{ old('telefono.3') }}">
                        @error('telefono.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 m-0">
                    <!-- Correo -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control @error('correo.3') is-invalid @enderror" name="correo[]" value="{{ old('correo.3') }}">
                        @error('correo.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Profesion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="profesion" class="form-label">Profesion</label>
                        <input type="text" class="form-control @error('profesion.3') is-invalid @enderror" name="profesion[]" value="{{ old('profesion.3') }}">
                        @error('profesion.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Red Social -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="red_social" class="form-label">Red Social</label>
                        <select type="text" class="form-control select2 @error('red_social.3') is-invalid @enderror" name="red_social[]">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsSocialN as $value => $label)
                                <option value="{{ $value }}" {{ old('red_social.3') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('red_social.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 bg-light-subtle m-0">
                    <!-- Usuario Red -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="usuario_red" class="form-label">Usuario Red Social</label>
                        <input type="text" class="form-control @error('usuario_red.3') is-invalid @enderror" name="usuario_red[]" value="{{ old('usuario_red.3') }}">
                        @error('usuario_red.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tipo de Cargo -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="" class="form-label">Tipo de Cargo</label>
                        <select class="form-control select2 tipo_cargo @error('tipo_cargo.3') is-invalid @enderror" data-col="cargo4"
                            name="tipo_cargo[]">
                            <option value="" selected>Seleccionar</option>
                            @foreach ($optionsTypesPositions as $value => $label)
                                <option value="{{ $value }}" {{ old('tipo_cargo.3') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('tipo_cargo.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Cargo -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none">
                        <label for="cargo" class="form-label">Cargos Administrativos</label>
                        <select class="form-control select2 @error('cargo.3') is-invalid @enderror"
                            name="cargo[]" id="cargo4">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsPositions as $value => $label)
                                <option value="{{ $value }}" {{ old('cargo.3') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('cargo.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 m-0">
                    <!-- Buro -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none">
                        <label for="" class="form-label">Buró</label>
                        <select class="form-control select2 @error('buro.3') is-invalid @enderror" name="buro[]" id="cargo4buro">
                            <option value="">Seleccionar</option>
                        </select>
                        @error('buro.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Posees cargos de administración público -->
                    <div class="mb-3 col-md-6 col-lg-4 align-self-end">
                        <label class="form-label me-3">Posees cargos de administración pública</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input cargoPublicoCheck" data-col="cargo_pub4" type="radio" name="cargosAdm[3]" id="inlineRadio7"
                            value="si" {{ old('cargosAdm.3') == 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio7">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input cargoPublicoCheck" data-col="cargo_pub4" type="radio" name="cargosAdm[3]" id="inlineRadio8"
                            value="no" {{ old('cargosAdm.3') == 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio8">No</label>
                        </div>
                        @error('cargosAdm.3')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Cargo publico -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none" id="cargo_pub4">
                        <label for="cargo_pub" class="form-label">Cargo público</label>
                        <input type="text" class="form-control @error('cargo_pub.3') is-invalid @enderror" id="" name="cargo_pub[]" value="{{ old('cargo_pub.3') }}">
                        @error('cargo_pub.3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- QUINTO MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">5. Miembro</h5>
                    </div>
                </div>

                <div class="row p-3 m-0 member5">
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
                        <input type="text" class="form-control apellido @error('apellido.4') is-invalid @enderror"  name="apellido[]" value="{{ old('apellido.4') }}">
                        @error('apellido.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 bg-light-subtle m-0 member5">

                    <!-- Fecha de nacimiento  -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <div class="input-group">
                            <input type="text" class="form-control mydatepicker fecha @error('fecha_nacimiento.4') is-invalid @enderror" name="fecha_nacimiento[]" value="{{ old('fecha_nacimiento.4') }}" placeholder="Seleccione una fecha" autocomplete="off">
                            <span class="input-group-text">
                            <i class="ti ti-calendar fs-5"></i>
                            </span>
                        </div>
                        @error('fecha_nacimiento.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Genero -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="genero" class="form-label">Genero</label>
                        <select name="genero[]" class="form-control select2 genero @error('genero.4') is-invalid @enderror">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsGender as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>";
                            @endforeach
                        </select>
                        @error('genero.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('telefono.4') is-invalid @enderror" name="telefono[]" value="{{ old('telefono.4') }}">
                        @error('telefono.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 m-0">
                    <!-- Correo -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control @error('correo.4') is-invalid @enderror" name="correo[]" value="{{ old('correo.4') }}">
                        @error('correo.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Profesion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="profesion" class="form-label">Profesion</label>
                        <input type="text" class="form-control @error('profesion.4') is-invalid @enderror" name="profesion[]" value="{{ old('profesion.4') }}">
                        @error('profesion.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Red Social -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="red_social" class="form-label">Red Social</label>
                        <select type="text" class="form-control select2 @error('red_social.4') is-invalid @enderror" name="red_social[]">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsSocialN as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>";
                            @endforeach
                        </select>
                        @error('red_social.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 bg-light-subtle m-0">
                    <!-- Usuario Red -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="usuario_red" class="form-label">Usuario Red Social</label>
                        <input type="text" class="form-control @error('usuario_red.4') is-invalid @enderror" name="usuario_red[]" value="{{ old('usuario_red.4') }}">
                        @error('usuario_red.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tipo de Cargo -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="tipo_cargo" class="form-label">Tipo de Cargo</label>
                        <select class="form-control select2 tipo_cargo @error('tipo_cargo.4') is-invalid @enderror" data-col="cargo5"
                            name="tipo_cargo[]">
                            <option value="" selected>Seleccionar</option>
                            @foreach ($optionsTypesPositions as $value => $label)
                                <option value="{{ $value }}" {{ old('tipo_cargo.4') == $value ? 'selected' : '' }}>{{ $label }}</option>";
                            @endforeach
                        </select>
                        @error('tipo_cargo.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Cargo -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none">
                        <label for="cargo" class="form-label">Cargos Administrativos</label>
                        <select class="form-control select2 @error('cargo.4') is-invalid @enderror"
                            name="cargo[]" id="cargo5">
                            <option value="">Seleccionar</option>
                            @foreach ($optionsPositions as $value => $label)
                                <option value="{{ $value }}" {{ old('cargo.4') == $value ? 'selected' : '' }}>{{ $label }}</option>";
                            @endforeach
                        </select>
                        @error('cargo.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 m-0">
                    <!-- Buro -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none">
                        <label for="" class="form-label">Buró</label>
                        <select class="form-control select2 @error('buro.4') is-invalid @enderror" name="buro[]" id="cargo5buro">
                            <option value="">Seleccionar</option>
                        </select>
                        @error('buro.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Posees cargos de administración público -->
                    <div class="mb-3 col-md-6 col-lg-4 align-self-end">
                        <label class="form-label me-3">Posees cargos de administración pública</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input cargoPublicoCheck" data-col="cargo_pub5" type="radio" name="cargosAdm[4]" id="inlineRadio9"
                            value="si" {{ old('cargosAdm.4') == 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio9">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input cargoPublicoCheck" data-col="cargo_pub5" type="radio" name="cargosAdm[4]" id="inlineRadio10"
                            value="no" {{ old('cargosAdm.4') == 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio10">No</label>
                        </div>
                        @error('cargosAdm.4')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Cargo publico -->
                    <div class="mb-3 col-md-6 col-lg-4 d-none" id="cargo_pub5">
                        <label for="cargo_pub" class="form-label">Cargo público</label>
                        <input type="text" class="form-control @error('cargo_pub.4') is-invalid @enderror" id="" name="cargo_pub[]" value="{{ old('cargo_pub.4') }}">
                        @error('cargo_pub.4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 align-self-end">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>
            </form>

            <div class="position-absolute top-50 start-50 translate-middle glassContainer w-100">
                <img src="{{ asset('assets/images/logos/logo-b.png') }}" class="glassLogo" />
            </div>
        </div>

        <div id="loading-message">
            <div class="spinner-border"></div>
            <span>Cargando...</span>
        </div>
    </div>
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
        window.opcionesBuro = @json($optionsBuro);
        window.opcionesBuroSecFemenina = @json($optionsBuroSecFemenina);
        window.opcionesBuroSecCultura = @json($optionsBuroSecCultura);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/forms/select2.init.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/forms/datepicker-init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/members/comite-register.js') }}"></script>
@endsection
