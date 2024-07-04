@extends('layouts.app')

@section('styles')
<style>
    .table-responsive {
        min-height: 80vh;
    }
</style>
@endsection

@section('content')
    <div class="position-relative">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
            <div class="card-body px-4 py-3" bis_skin_checked="1">
              <div class="row align-items-center" bis_skin_checked="1">
                <div class="col-9" bis_skin_checked="1">
                  <h4 class="fw-semibold mb-8">Comite Ejecutivo Nacionales</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                        </li>
                        {{-- <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('members.index') }}">Comite Ejecutivo Nacionales</a>
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
              <a class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar" href="{{ route('members.create') }}">
                <i class="ti ti-circle-plus"></i> Agregar
            </a>
            </div>
        </div>

        <div class="table-responsive">
            <table id="datatable-members" class="table border table-striped table-bordered text-nowrap align-middle dataTableCurrent">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th>Nombre</th>
                        <th>Alcance</th>
                        {{-- <th>Dirección</th> --}}
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
                        {{-- <th>Dirección</th> --}}
                        <th>Telefono</th>
                        <th>Cargo</th>
                        <th>Buró</th>
                        <th>Acciones</th>
                    </tr>
                    <!-- end row -->
                </tfoot>
            </table>
        </div>

        <div class="position-fixed bottom-0 end-0 translate-middle d-none" id="deleteMasive">
            <a data-path="{{ route('members.modalDeleteMasive') }}" class="btn btn-danger h4 mb-0 d-flex align-items-center text-capitalize modal-pers">Eliminar Miembros <i class="ti ti-alert-circle h4 ms-1 text-white mb-0"></i></a>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        let table = $('#datatable-members').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            ajax: '{{ route("members.list") }}',
            columns: [
                // {
                //     data: "id",
                //     render: function (data, type, row) {
                //         return '<input type="checkbox" class="select-member form-check-input" value="' + data + '">';
                //     }
                // },
                { data: 'nombre_completo'},
                // { data: 'apellido', name: 'apellido' },
                // { data: 'cedula', name: 'cedula' },
                { data: 'alcance'},
                // { data: 'direccion'},
                { data: 'telefono'},
                // { data: 'correo'},
                // { data: 'fecha_nacimiento'},
                { data: 'cargo'},
                // { data: 'tipo_cargo', name: 'tipo_cargo' },
                { data: 'buro'},
                { data: 'action', orderable: false, searchable: false },
            ],
            language: {
                processing:     "Procesando...",
                search:         "Buscar:",
                lengthMenu:    "Mostrar _MENU_ registros",
                info:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                infoEmpty:      "Mostrando registros del 0 al 0 de un total de 0 registros",
                infoFiltered:   "(filtrado de un total de _MAX_ registros)",
                infoPostFix:    "",
                loadingRecords: "Cargando...",
                zeroRecords:    "No se encontraron resultados",
                emptyTable:     "Ningún dato disponible en esta tabla",
                paginate: {
                    first:      '<i class="fa fa-step-backward" style="color: #5D87FF;"></i>',
                    previous:   '<i class="ti ti-arrow-left" style="color: #5D87FF;"></i>',
                    next:       '<i class="ti ti-arrow-right" style="color: #5D87FF;"></i>',
                    last:       '<i class="fa fa-step-forward" style="color: #5D87FF;"></i>'
                },
                aria: {
                    sortAscending:  ": Activar para ordenar la columna de manera ascendente",
                    sortDescending: ": Activar para ordenar la columna de manera descendente"
                }
            },
            initComplete: function() {
                $('#datatable-members_length, #datatable-members_filter').wrapAll('<div class="d-flex align-items-center justify-content-between"></div>');
            },
        });

        $('#datatable-members').on('change', '.select-member', function() {
            if ($('.select-member:checked').length > 0) {
                $('#deleteMasive').removeClass('d-none');
            } else {
                $('#deleteMasive').addClass('d-none');
            }
        })

        $('#datatable-members').on('order.dt search.dt', function () {
            $('.select-member').prop('checked', false);
            $('.select-member').change();
        });

        $(document).on('click', '#delete-masive-confirm', function() {
            let selectedIds = $('.select-member:checked').map(function() {
                return $(this).val();
            }).get();

            $.ajax({
                url: '{{ route("members.deleteMasive") }}',
                type: 'POST',
                data: { ids: selectedIds },
                success: function(response) {
                    console.log(response)
                    toastr.success(response.message, "¡Éxito!", {
                        progressBar: true,
                    });
                    $('.dataTableCurrent').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    toastr.error(xhr.responseText, "Error", {
                        progressBar: true,
                    });
                }
            });
        });

    </script>
@endsection
