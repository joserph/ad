$(document).ready(function () {
    let table = $('#table-members').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        ajax: urlMemberSeccional,
        columns: [
            
            { data: 'nombre_completo'},
            { data: 'alcance'},
            { data: 'telefono'},
            { data: 'cargo'},
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
            $('#table-users_length, #table-users_filter').wrapAll('<div class="d-flex align-items-center justify-content-between"></div>');
        },
    });

});
