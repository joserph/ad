@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
            <div class="card-body px-4 py-3" bis_skin_checked="1">
              <div class="row align-items-center" bis_skin_checked="1">
                <div class="col-9" bis_skin_checked="1">
                  <h4 class="fw-semibold mb-8">Comite Ejecutivo Municipales</h4>
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
              
                <a class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar" href="{{ route('members-municipal.create') }}">
                    <i class="ti ti-circle-plus"></i> Agregar
                </a>
              
            </div>
        </div>

        <table id="table-members" class="table border table-striped table-bordered text-nowrap align-middle dataTableCurrent">
            <thead>
                <!-- start row -->
                <tr>
                    <th>Nombre</th>
                    <th>Alcance</th>
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
        window.urlMemberSeccional = '{{ route("member-municipal.list") }}';
    </script>
    <script src="{{ asset('assets/js/pages/members/members-list.js') }}"></script>
    
@endsection
