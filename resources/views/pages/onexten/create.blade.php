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
