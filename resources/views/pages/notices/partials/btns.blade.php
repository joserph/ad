
<div class="d-flex">
    @can('ver-noticia')
    <a href="{{ route('notices.detail', $id) }}" class="btn btn-icon btn-info btn-sm me-1">
        <i class="ti ti-eye"></i>
    </a>
    @endcan
    @can('editar-noticia')
        <a href="{{ route('notices.create', $id) }}" class="btn btn-icon btn-warning btn-sm me-1">
            <i class="ti ti-pencil"></i>
        </a>
    @endcan
    
    @can('eliminar-noticia')
        <button class="btn btn-icon btn-danger btn-sm modal-pers" data-path=" {{ route('notices.modalDelete', $id) }} ">
            <i class="ti ti-trash"></i>
        </button>
    @endcan
    
</div>
