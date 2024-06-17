@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<style>

</style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body position-relative py-3 px-0">
                <div class="row p-3 m-0">
                    <div class="col-12">
                        <h5 class="card-title fw-semibold">Editar Comite Local</h5>
                    </div>
                </div>
                <form class="row m-0" method="POST" action="{{ route('members.comiteStore') }}">
                    @csrf

                    <div class="row p-3 m-0">
                        <!-- Nombre del comite -->
                        <div class="mb-3 col-lg-6">
                            <label for="nombre_comite" class="form-label">Nombre del comite</label>
                            <input type="text" class="form-control @error('nombre_comite') is-invalid @enderror" id="nombre_comite" name="nombre_comite" value="{{ $comite->nombre_comite }}">
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

                    <div class="row p-3 m-0">
                        <div class="col-12 align-self-end">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </div>
                </form>

                <div class="position-absolute top-50 start-50 translate-middle glassContainer">
                    <img src="{{ asset('assets/images/logos/logo.png') }}" class="glassLogo" />
                </div>
            </div>
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
        window.urlFetchScopeData = "{{ route('members.getScopeInfo')}}";.
        window.geograficos = @json($geograficos);
        window.opcionesBuro = @json($optionsBuro);
        window.opcionesBuroSecFemenina = @json($optionsBuroSecFemenina);
        window.opcionesBuroSecCultura = @json($optionsBuroSecCultura);
    </script>
    <script src="{{ asset('assets/libs/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/forms/select2.init.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/forms/datepicker-init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/members/comite-register.js') }}"></script>
@endsection
