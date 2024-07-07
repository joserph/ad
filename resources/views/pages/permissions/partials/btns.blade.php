<div class="d-flex">
    @can('editar-permiso')
    <a href="{{ route('permissions.edit', $id) }}" class="btn btn-icon btn-info btn-sm me-1">
        <i class="ti ti-pencil"></i>
    </a>
    @endcan
    @can('eliminar-permiso')
    <form method="POST" action="{{ route("permissions.destroy", $id) }}" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE">
        @csrf
        <button type="submit" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="return confirm('¿Seguro de eliminar el permiso?')" class="btn btn-sm btn-danger eliminar"><i class="ti ti-trash"></i> </button>
    </form>
    @endcan
    
</div>