<div class="modal-dialog modal-dialog-scrollable modal-sm">
    <div class="modal-content">
        <div class="modal-body p-4">
            <form class="text-center" action="{{ route('users.delete', $users) }}">
                <i class="ti ti-alert-circle text-danger display-3"></i>
                <h4 class="mt-2 fw-bold text-danger">Confirmación de Eliminación</h4>
                <p class="mt-3">
                    ¿Está seguro de que desea eliminar este usuario? Esta acción es irreversible y los datos no podrán ser recuperados una vez que se proceda.
                </p>
                <button type="button" class="btn btn-outline-info btnClose" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger delete-action">Eliminar</button>
            </form>
        </div>
    </div>
</div>
