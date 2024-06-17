@extends('layouts.app')

@section('styles')
<style>
    .table-responsive {
        min-height: 80vh;
    }
    #datatable-comite .check-column {
        width: 0px !important;
    }
    #datatable-comite .action-column {
        width: 100px !important;
    }
</style>
@endsection

@section('content')
    <div class="position-relative">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
            <div class="card-body px-4 py-3" bis_skin_checked="1">
              <div class="row align-items-center" bis_skin_checked="1">
                <div class="col-9" bis_skin_checked="1">
                  <h4 class="fw-semibold mb-8">Comite local</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('committe-local.index') }}">Comite</a>
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
            </div>
        </div>

        <div class="table-responsive">
            <table id="datatable-comite" class="table border table-striped table-bordered text-nowrap align-middle dataTableCurrent">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th class="check-column"></th>
                        <th>Nombre</th>
                        <th class="members-column">Miembros</th>
                        <th class="action-column">Acciones</th>
                    </tr>
                    <!-- end row -->
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <!-- start row -->
                    <tr>
                        <th class="check-column"></th>
                        <th>Nombre</th>
                        <th class="members-column">Miembros</th>
                        <th class="action-column">Acciones</th>
                    </tr>
                    <!-- end row -->
                </tfoot>
            </table>
        </div>

        <div class="position-fixed bottom-0 end-0 translate-middle d-none" id="deleteMasive">
            <a data-path="{{ route('notices.modalDeleteMasive') }}" class="btn btn-danger h4 mb-0 d-flex align-items-center text-capitalize modal-pers">Eliminar comite <i class="ti ti-alert-circle h4 ms-1 text-white mb-0"></i></a>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        let table = $('#datatable-comite').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            lengthMenu: [10, 25, 50, 100],
            ajax: '{{ route("committe-local.list") }}',
            columns: [
                {
                    data: "id",
                    render: function (data, type, row) {
                        console.log(row, data)
                        return '<input type="checkbox" class="select-notice form-check-input" value="' + data + '">';
                    }
                },
                { data: 'nombre_comite', name: 'nombre_comite' },
                { data: "members", name: 'members' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            columnDefs: [
                {
                    targets: 2,
                    width: '10px',
                    className: 'dt-center',
                }
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
                $('#datatable-comite_length, #datatable-comite_filter').wrapAll('<div class="d-flex align-items-center justify-content-between"></div>');
            },
        });

        $('#datatable-comite').on('change', '.select-notice', function() {
            if ($('.select-notice:checked').length > 0) {
                $('#deleteMasive').removeClass('d-none');
            } else {
                $('#deleteMasive').addClass('d-none');
            }
        })

        $('#datatable-comite').on('order.dt search.dt', function () {
            $('.select-notice').prop('checked', false);
            $('.select-notice').change();
        });

        $(document).on('click', '#delete-masive-confirm', function() {
            let selectedIds = $('.select-notice:checked').map(function() {
                return $(this).val();
            }).get();

            $.ajax({
                url: '{{ route("notices.deleteMasive") }}',
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
