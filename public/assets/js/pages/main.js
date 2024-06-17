$(document).ready(function () {
    const preAjax = $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const setModal = (url) => {
        $.get(url, function(response) {
            $('#staticBackdrop').html(response);
            $('#staticBackdrop').modal('show');
        });
    }

    const initializeModalClickEvent = () => {
        $(document).on("click", ".modal-pers", function(e) {
            e.preventDefault();
            console.log('modal');
            let url = $(this).data("path"), id = $(this).data("id");
            setModal(url)
        });
    }

    $(document).on("click", ".modal-pers", function(e) {
        e.preventDefault();
        console.log('modal');
        let url = $(this).data("path"), id = $(this).data("id");
        setModal(url)
    });

    $(document).on("click", ".delete-action", function(e) {
        e.preventDefault();
        let formAction = $('#staticBackdrop form').attr('action'), modalElement = document.getElementById('staticBackdrop'), modalInstance = bootstrap.Modal.getInstance(modalElement);

        $('#staticBackdrop button').each(function (index, element) {
            $(this).prop('disabled', true);
        });

        preAjax
        $.ajax({
        type: 'POST',
        data: {
            _method: 'DELETE'
        },
        url: formAction,
        success: function (e) {
            console.log(e)
            modalInstance.hide();
            $('.dataTableCurrent').DataTable().ajax.reload();
            if (e.success) {
                toastr.success(e.success, "Completado", {
                    progressBar: true,
                });
            } else {
                toastr.success(e.error, "Error", {
                    progressBar: true,
                });
            }
            // if (e.status == langEs.erased){
            //     $(function () {
            //         Swal.fire({
            //             icon: 'success',
            //             title: e.status,
            //             text: e.message,
            //             customClass: {
            //                 confirmButton: 'btn btn-success'
            //             }
            //         }).then (function(){
            //             if(datatableName){
            //                 datatableName.forEach(element => {
            //                 $(element).DataTable().ajax.reload();
            //                 });
            //             }
            //         });
            //     });
            // }
            // if (e.status == 'error'){
            //     $(function () {
            //         'use strict';
            //         NotifyAlert('error', e.message)
            //         datatableName.forEach(element => {
            //         $(element).DataTable().ajax.reload()
            //         });
            //     });
            // }
        },
        error: function (error) {
            modalInstance.hide();
            $('.dataTableCurrent').DataTable().ajax.reload();
            console.log(error);
            toastr.success(error, "Error", {
                progressBar: true,
            });
        }
        });
    });

    if ($('.select2').length > 0) {
        $('.select2').select2();
    }

    initializeModalClickEvent();
});
