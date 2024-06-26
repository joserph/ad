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
            <h4 class="fw-semibold mb-8">@if($members->id) Editar Miembro @else Registrar Miembros @endif</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('members.index') }}">Miembros</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">@if($members->id) Editar @else Registrar @endif</li>
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
        <div class="card-body position-relative">
            {{-- <h5 class="card-title fw-semibold mb-4">Registrar Miembro</h5> --}}
            <form class="row" method="POST" action="{{ route('members.store') }}">
                @csrf
                <!-- Cedula -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="cedula" class="form-label">Cedula</label>
                    <input type="text" class="form-control @error('cedula') is-invalid @enderror" id="cedula" name="cedula" value="{{ old('cedula') }}">
                    @error('cedula')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Nombre -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="nombre" class="form-label">Nombres</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Apellidos -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="apellido" class="form-label">Apellidos</label>
                    <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" value="{{ old('apellido') }}">
                    @error('apellido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Fecha de nacimiento  -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="" class="form-label">Fecha de nacimiento</label>
                    <div class="input-group">
                        <input type="text" class="form-control mydatepicker @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" placeholder="Seleccione una fecha" autocomplete="off">
                        <span class="input-group-text">
                        <i class="ti ti-calendar fs-5"></i>
                        </span>
                    </div>
                    @error('fecha_nacimiento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Genero -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="genero" class="form-label">Genero</label>
                    <select name="genero" class="form-control select2 @error('genero') is-invalid @enderror" id="genero">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsGender as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('genero')
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
                <!-- Correo -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" value="{{ old('correo') }}">
                    @error('correo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Profesion -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="profesion" class="form-label">Profesion</label>
                    <input type="text" class="form-control @error('profesion') is-invalid @enderror" id="profesion" name="profesion" value="{{ old('profesion') }}">
                    @error('profesion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Red Social -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="red_social" class="form-label">Red Social</label>
                    <select type="text" class="form-control select2 @error('red_social') is-invalid @enderror" id="red_social" name="red_social">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsSocialN as $value => $label)
                            <option value="{{ $value }}" {{ old('red_social') == $value ? 'selected' : '' }}>{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('red_social')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Usuario Red -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="usuario_red" class="form-label">Usuario Red Social</label>
                    <input type="text" class="form-control @error('usuario_red') is-invalid @enderror" id="usuario_red" name="usuario_red" value="{{ old('usuario_red') }}">
                    @error('usuario_red')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Alcance -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="alcance" class="form-label">Alcance</label>
                    <select class="form-control select2 @error('alcance') is-invalid @enderror" id="alcance" name="alcance">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsScope as $value => $label)
                            <option value="{{ $value }}" {{ old('alcance') == $value ? 'selected' : '' }}>{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('alcance')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Seccional -->
                <div class="mb-3 col-md-6 col-lg-4 d-none">
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
                <div class="mb-3 col-md-6 col-lg-4 d-none">
                    <label for="municipio" class="form-label">Municipio</label>
                    <select class="form-control select2 @error('municipio') is-invalid @enderror" id="municipio" name="municipio">
                        <option value="">Seleccionar</option>
                    </select>
                    @error('municipio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Parroquia -->
                <div class="mb-3 col-md-6 col-lg-4 d-none">
                    <label for="parroquia" class="form-label">Parroquia</label>
                    <select class="form-control select2 @error('parroquia') is-invalid @enderror" id="parroquia" name="parroquia" value="{{ old('parroquia') }}">
                        <option value="">Seleccionar</option>
                    </select>
                    @error('parroquia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Tipo de Cargo -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="tipo_cargo" class="form-label">Tipo de Cargo</label>
                    <select class="form-control select2 @error('tipo_cargo') is-invalid @enderror"
                        id="tipo_cargo" name="tipo_cargo">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsTypesPositions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('tipo_cargo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Cargo -->
                <div class="mb-3 col-md-6 col-lg-4 d-none">
                    <label for="cargo" class="form-label">Cargos Administrativos</label>
                    <select class="form-control select2 @error('cargo') is-invalid @enderror"
                        id="cargo" name="cargo">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsPositions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('cargo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                

                <!-- Buro_sec_agraria -->
                <div class="mb-3 col-md-6 col-lg-4 d-none">
                    <label for="buro_sec_agraria" class="form-label">Buró</label>
                    <select class="form-control select2 @error('buro_sec_agraria') is-invalid @enderror" id="buro_sec_agraria" name="buro_sec_agraria">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsBuroSecAgraria as $value => $label)
                            <option value="{{ $value }}" @selected(old('buro', $members->buro) == $value)>{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('buro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buro_sec_asuntos_municipales -->
                <div class="mb-3 col-md-6 col-lg-4 d-none">
                    <label for="buro_sec_asuntos_municipales" class="form-label">Buró</label>
                    <select class="form-control select2 @error('buro_sec_asuntos_municipales') is-invalid @enderror" id="buro_sec_asuntos_municipales" name="buro_sec_asuntos_municipales">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsBuroSecAsuntosMunicipales as $value => $label)
                            <option value="{{ $value }}" @selected(old('buro', $members->buro) == $value)>{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('buro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buro_sec_cultura -->
                <div class="mb-3 col-md-6 col-lg-4 d-none">
                    <label for="buro_sec_cultura" class="form-label">Buró</label>
                    <select class="form-control select2 @error('buro_sec_cultura') is-invalid @enderror" id="buro_sec_cultura" name="buro_sec_cultura">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsBuroSecCultura as $value => $label)
                            <option value="{{ $value }}" @selected(old('buro', $members->buro) == $value)>{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('buro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buro_sec_educacion -->
                <div class="mb-3 col-md-6 col-lg-4 d-none">
                    <label for="buro_sec_educacion" class="form-label">Buró</label>
                    <select class="form-control select2 @error('buro_sec_educacion') is-invalid @enderror" id="buro_sec_educacion" name="buro_sec_educacion">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsBuroSecEducacion as $value => $label)
                            <option value="{{ $value }}" @selected(old('buro', $members->buro) == $value)>{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('buro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buro_sec_femenina -->
                <div class="mb-3 col-md-6 col-lg-4 d-none">
                    <label for="buro_sec_femenina" class="form-label">Buró</label>
                    <select class="form-control select2 @error('buro_sec_femenina') is-invalid @enderror" id="buro_sec_femenina" name="buro_sec_femenina">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsBuroSecFemenina as $value => $label)
                            <option value="{{ $value }}" @selected(old('buro', $members->buro) == $value)>{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('buro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buro_sec_juvenil -->
                <div class="mb-3 col-md-6 col-lg-4 d-none">
                    <label for="buro_sec_juvenil" class="form-label">Buró</label>
                    <select class="form-control select2 @error('buro_sec_juvenil') is-invalid @enderror" id="buro_sec_juvenil" name="buro_sec_juvenil">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsBuroSecJuvenil as $value => $label)
                            <option value="{{ $value }}" @selected(old('buro', $members->buro) == $value)>{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('buro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buro_sec_sindical -->
                <div class="mb-3 col-md-6 col-lg-4 d-none">
                    <label for="buro_sec_sindical" class="form-label">Buró</label>
                    <select class="form-control select2 @error('buro_sec_sindical') is-invalid @enderror" id="buro_sec_sindical" name="buro_sec_sindical">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsBuroSecSindical as $value => $label)
                            <option value="{{ $value }}" @selected(old('buro', $members->buro) == $value)>{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('buro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buro_sec_profesionales_y_tecnico -->
                <div class="mb-3 col-md-6 col-lg-4 d-none">
                    <label for="buro_sec_profesionales_y_tecnico" class="form-label">Buró</label>
                    <select class="form-control select2 @error('buro_sec_profesionales_y_tecnico') is-invalid @enderror" id="buro_sec_profesionales_y_tecnico" name="buro_sec_profesionales_y_tecnico">
                        <option value="">Seleccionar</option>
                        @foreach ($optionsBuroSecProfesionalesYTecnicos as $value => $label)
                            <option value="{{ $value }}" @selected(old('buro', $members->buro) == $value)>{{ $label }}</option>";
                        @endforeach
                    </select>
                    @error('buro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Posees cargos de administración público -->
                <div class="mb-3 col-md-6 align-self-end">
                    <label class="form-label me-3">Posees cargos de administración pública</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input cargoPublicoCheck" type="radio" name="cargosAdm" id="inlineRadio1"
                        value="si" {{ old('cargosAdm') == 'si' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input cargoPublicoCheck" type="radio" name="cargosAdm" id="inlineRadio2"
                        value="no" {{ old('cargosAdm') == 'no' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio2">No</label>
                    </div>
                    @error('cargosAdm')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12"></div>
                <!-- Cargo publico -->
                <div class="mb-3 col-md-6 col-lg-4 d-none" id="cargo_pub">
                    <label for="cargo_pub" class="form-label">Cargo público</label>
                    <input type="text" class="form-control @error('cargo_pub') is-invalid @enderror" id="" name="cargo_pub" value="{{ old('cargo_pub') }}">
                    @error('cargo_pub')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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

    <script>
        $(document).ready(function() {
            var oldErrors = $('#old-errors').data('old-errors');
            if (oldErrors && oldErrors.length > 0) {
                console.log('Errores anteriores:');
                oldErrors.forEach(function(error) {
                    console.log(error);
                });
            }
        });

        window.urlFetchCiData = "{{ route('members.searchDoc')}}";
        window.urlFetchScopeData = "{{ route('members.getScopeInfo')}}";
        window.geograficos = @json($geograficos);
        window.opcionesBuro = @json($optionsBuro);
        window.opcionesBuroSecFemenina = @json($optionsBuroSecFemenina);
        window.opcionesBuroSecCultura = @json($optionsBuroSecCultura);
        window.opcionesBuroSecAgraria = @json($optionsBuroSecAgraria);
        window.opcionesBuroSecAsusntosMunicipales = @json($optionsBuroSecAsuntosMunicipales);
        window.opcionesBuroSecEducacion = @json($optionsBuroSecEducacion);
        window.opcionesBuroSecJuvenil = @json($optionsBuroSecJuvenil);
        window.opcionesBuroSecSindical = @json($optionsBuroSecSindical);
        window.opcionesBuroSecProfesionalesYTecnicos = @json($optionsBuroSecProfesionalesYTecnicos);
        window.responseData = null;
        //console.log(window.geograficos);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/forms/select2.init.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/forms/datepicker-init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/members/members-register.js') }}"></script>
@endsection
