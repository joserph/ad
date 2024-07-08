@can('mostrar-comite-ejecutivo-seccional')
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
                  <h4 class="fw-semibold mb-8">Comite Ejecutivo Seccionales</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                        </li>
                        {{-- <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('members-seccional.index') }}">Comite Ejecutivo Seccionales</a>
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
                @can('crear-comite-ejecutivo-seccional')
                <a class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar" href="{{ route('members-seccional.create') }}">
                    <i class="ti ti-circle-plus"></i> Agregar
                </a>
                @endcan
                @can('descargar-comite-ejecutivo-seccional')
                
                <a class="btn btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Exportar" href="{{ route('member-seccional.export') }}">
                    <i class="ti ti-arrow-down"></i> Exportar todo
                </a>
                <form action="{{ route('member-seccional.export-seccional') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-auto">
                    {!! Form::label('seccional', 'Seccional', ['class' => 'form-label']) !!}
                    {!! Form::select('seccional', $seccionales, null, ['class' => 'form-select select2', 'placeholder' => 'Seleccionar']) !!}
                    <button type="submit" class="btn btn-sm btn-warning"><i class="ti ti-arrow-down"></i> Exportar Seccional</button>
                    </div>
                </form>
                @endcan
                
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
        window.urlMemberSeccional = '{{ route("member-seccional.list") }}';
    </script>
    <script src="{{ asset('assets/js/pages/members/members-list.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/forms/select2.init.js') }}"></script>
@endsection
@endcan
