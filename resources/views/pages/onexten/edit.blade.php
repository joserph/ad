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
            <h4 class="fw-semibold mb-8">Editar 1 x 10</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('onexten.index') }}">1 x 10</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Editar</li>
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
            <form class="row" method="POST" action="{{ route('onexten.update', $onexten->id) }}">
                @csrf
                @method('PUT')
                <!-- responsable -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="responsable" class="form-label">Responsable</label>
                    <input type="text" class="form-control @error('responsable') is-invalid @enderror" id="responsable" name="responsable" value="{{ $onexten->responsable }}">
                    @error('responsable')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Teléfono -->
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ $onexten->telefono }}">
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
                            <option value="{{ $seccional->nombre }}" @selected(old('tipo_cargo', $onexten->seccional) == $seccional->nombre)>{{ $nombre }}</option>
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
                        <option value="">Seleccionar Municipio</option>
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
                    <input type="text" class="form-control @error('sector') is-invalid @enderror" id="sector" name="sector" value="{{ $onexten->sector }}">
                    @error('sector')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @foreach ($onextenItem as $item)

                {{-- PRIMER MIEMBRO --}}
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">{{ $item->item }}. Miembro</h5>
                        <input type="hidden" name="id[]" value="{{ $item->id }}">
                        <input type="hidden" name="onexten_id[]" value="{{ $item->onexten_id }}">
                    </div>
                </div>

                <div class="row p-3 bg-light-subtle m-0 member1">
                    <!-- Cedula -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-control cedula @error('cedula.{{ $item->id }}') is-invalid @enderror" data-count="1" name="cedula[]" value="{{ $item->cedula }}">
                        @error('cedula.{{ $item->id }}')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control nombre @error('nombre.{{ $item->id }}') is-invalid @enderror" name="nombre[]" value="{{ $item->nombre }}">
                        @error('nombre.{{ $item->id }}')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control apellido @error('apellido.{{ $item->id }}') is-invalid @enderror" name="apellido[]" value="{{ $item->apellido }}">
                        @error('apellido.{{ $item->id }}')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row p-3 bg-light-subtle m-0 member1">
                    <!-- Teléfono -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="num_telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('num_telefono.{{ $item->id }}') is-invalid @enderror" name="num_telefono[]" value="{{ $item->num_telefono }}">
                        @error('num_telefono.{{ $item->id }}')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Direccion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control @error('direccion.{{ $item->id }}') is-invalid @enderror" name="direccion[]" value="{{ $item->direccion }}">
                        @error('direccion.{{ $item->id }}')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Centro de Votacion -->
                    <div class="mb-3 col-md-6 col-lg-4">
                        <label for="centro_votacion" class="form-label">Centro de Votacion</label>
                        <input type="text" class="form-control @error('centro_votacion.{{ $item->id }}') is-invalid @enderror" name="centro_votacion[]" value="{{ $item->centro_votacion }}">
                        @error('centro_votacion.{{ $item->id }}')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @endforeach
                
                
                
                
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
        window.responseData = @json($onexten);
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
