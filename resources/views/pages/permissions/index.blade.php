@can('mostrar-permisos')
@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
            <div class="card-body px-4 py-3" bis_skin_checked="1">
              <div class="row align-items-center" bis_skin_checked="1">
                <div class="col-9" bis_skin_checked="1">
                  <h4 class="fw-semibold mb-8">Permisos</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('permissions.index') }}">Permisos</a>
                        </li>
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
              @can('crear-permiso')
                <a class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Crear" href="{{ route('permissions.create') }}">
                    <i class="ti ti-circle-plus"></i> Crear Permiso
                </a>
              @endcan
                
            </div>
        </div>

        <table id="table-permissions" class="table border table-striped table-bordered text-nowrap align-middle dataTableCurrent">
            <thead>
                <!-- start row -->
                <tr>
                    <th>Nombre</th>
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
        window.urlPermission = '{{ route("permissions.list") }}';
    </script>
    <script src="{{ asset('assets/js/pages/roles_permissions/permissions.js') }}"></script>
    
@endsection
@endcan