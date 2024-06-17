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
                  <h4 class="fw-semibold mb-8">Administrador</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('notices.index') }}">Noticias</a>
                      </li>
                      <li class="breadcrumb-item" aria-current="page">Administrador</li>
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
            <table id="datatable-notices" class="table border table-striped table-bordered text-nowrap align-middle dataTableCurrent">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th></th>
                        <th>Archivo</th>
                        <th>Titulo</th>
                        <th>Link</th>
                        <th>Contenido</th>
                        <th>Acciones</th>
                    </tr>
                    <!-- end row -->
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <!-- start row -->
                    <tr>
                        <th></th>
                        <th>Archivo</th>
                        <th>Titulo</th>
                        <th>Link</th>
                        <th>Contenido</th>
                        <th>Acciones</th>
                    </tr>
                    <!-- end row -->
                </tfoot>
            </table>
        </div>

        <div class="position-fixed bottom-0 end-0 translate-middle d-none" id="deleteMasive">
            <a data-path="{{ route('notices.modalDeleteMasive') }}" class="btn btn-danger h4 mb-0 d-flex align-items-center text-capitalize modal-pers">Eliminar noticias <i class="ti ti-alert-circle h4 ms-1 text-white mb-0"></i></a>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        let table = $('#datatable-notices').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            lengthMenu: [10, 25, 50, 100],
            ajax: '{{ route("notices.list") }}',
            columns: [
                {
                    data: "id",
                    render: function (data, type, row) {
                        return '<input type="checkbox" class="select-notice form-check-input" value="' + data + '">';
                    }
                },
                {
                    data: 'media_path',
                    name: 'media_path',
                    render: function(data, type, row) {
                        let images = '';
                        if (row.notice_files.length > 0) {
                            images += '<img src="' + row.notice_files[0].file_path + '" class="img-fluid rounded border-1 me-1 img-list" alt="Image">';

                            if (row.notice_files.length > 1) {
                                let moreImagesCount = row.notice_files.length - 1;
                                images += '<span class="fw-bolder">+' + moreImagesCount + '</span>';
                            }
                        }
                        return '<div class="d-flex align-items-center">' + images + '</div>';
                    }
                },
                { data: 'title', name: 'title' },
                { data: 'link', name: 'link' },
                { data: 'content', name: 'content' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
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
                $('#datatable-notices_length, #datatable-notices_filter').wrapAll('<div class="d-flex align-items-center justify-content-between"></div>');
            },
        });

        $('#datatable-notices').on('change', '.select-notice', function() {
            if ($('.select-notice:checked').length > 0) {
                $('#deleteMasive').removeClass('d-none');
            } else {
                $('#deleteMasive').addClass('d-none');
            }
        })

        $('#datatable-notices').on('order.dt search.dt', function () {
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
