<div class="d-flex">
    @can('editar-comite')
    <a href="{{ route('committe-local.edit', $id) }}" class="btn btn-icon btn-info btn-sm me-1">
        <i class="ti ti-pencil"></i>
    </a>
    @endcan
    @can('eliminar-comite')
    <button class="btn btn-icon btn-danger btn-sm modal-pers" data-path="{{ route('committe-local.modalDelete', $id) }}">
        <i class="ti ti-trash"></i>
    </button>
    @endcan
    
</div>