@can('mostrar-comite-ejecutivo-parroquial')
@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('content')
    <div class="table-responsive">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
            <div class="card-body px-4 py-3" bis_skin_checked="1">
              <div class="row align-items-center" bis_skin_checked="1">
                <div class="col-9" bis_skin_checked="1">
                  <h4 class="fw-semibold mb-8">Comite Ejecutivo Parroquiales</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                        </li>
                        {{-- <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('members-municipal.index') }}">Comite Ejecutivo Municiles</a>
                        </li> --}}
                        <li class="breadcrumb-item" aria-current="page">Listado</li>
                    </ol>
                  </nav>
                </div>
                <div class="col-3" bis_skin_checked="1">
                  <div class="text-center mb-n5" bis_skin_checked="1">
                    <img src="{{ asset('assets/images/notices/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
                  </div>
                </div>
              </div>
              @can('crear-comite-ejecutivo-parroquial')
              <a class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar" href="{{ route('members-parroquial.create') }}">
                <i class="ti ti-circle-plus"></i> Agregar
            </a>
              @endcan
                @can('descargar-comite-ejecutivo-parroquial')
                <a class="btn btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Exportar" href="{{ route('member-parroquial.export') }}">
                    <i class="ti ti-arrow-down"></i> Exportar todo
                </a>
                @endcan
                <div class="row">
                    <form action="{{ route('member-parroquial.export-parroquial') }}" method="POST" class="row g-3">
                        @csrf
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
                        <div class="mb-3 col-md-6 col-lg-4">
                        <button type="submit" class="btn btn-warning"><i class="ti ti-arrow-down"></i> Exportar Parroquia</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table id="table-members" class="table border table-striped table-bordered text-nowrap align-middle dataTableCurrent">
            <thead>
                <!-- start row -->
                <tr>
                    <th>Nombre</th>
                    <th>Alcance</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Cargo</th>
                    <th>Buró</th>
                    <th>Acciones</th>
                </tr>
                <!-- end row -->
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <!-- start row -->
                <tr>
                    <th>Nombre</th>
                    <th>Alcance</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Cargo</th>
                    <th>Buró</th>
                    <th>Acciones</th>
                </tr>
                <!-- end row -->
            </tfoot>
        </table>
    </div>
@endsection


@section('page-scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script>
        window.urlMemberSeccional = '{{ route("member-parroquial.list") }}';
    </script>
    <script src="{{ asset('assets/js/pages/members/members-list.js') }}"></script>
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
        window.responseData = null;
        //console.log(window.geograficos);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/forms/select2.init.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/forms/datepicker-init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/members/members-register-seccional.js') }}"></script>
@endsection
@endcan