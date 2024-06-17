@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
        <div class="card-body px-4 py-3" bis_skin_checked="1">
        <div class="row align-items-center" bis_skin_checked="1">
            <div class="col-9" bis_skin_checked="1">
            <h4 class="fw-semibold mb-8">Carga masiva de Miembros</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('members.index') }}">Miembros</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Carga masiva</li>
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
            {{-- <h5 class="card-title fw-semibold mb-4">Carga masiva de miembros</h5> --}}
            <form class="row" method="POST" action="{{ route('members.save-members') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <p class="mb-0">El archivo debe cumplir con la siguiente estructura para el correcto guardado de los miembros. <br> <span class="text-info">Cedula, Nombre, Apellido, Telefono, Correo, Fecha de nacimiento, Profesion, Red Social, Usuario Red Social, Genero, Alcance, Seccional, Municipio, Parroquia, Tipo de cargo, Cargo, Buro</span></p>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="" class="form-label">Solo se admiten archivos con extensiones <span class="text-danger">.xls, .xlsx &nbsp;y .txt.</span></label>
                    <input type="file" name="file" class="form-control" id="" required>
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 align-self-end">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
            <div class="position-absolute top-50 start-50 translate-middle glassContainer">
                <img src="{{ asset('assets/images/logos/logo.png') }}" class="glassLogo" />
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/libs/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/forms/select2.init.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/forms/datepicker-init.js') }}"></script>
@endsection
