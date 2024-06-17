<div class="modal-dialog modal-dialog-scrollable modal-md">
    <div class="modal-content">
        <div class="modal-header modal-colored-header bg-primary text-white" bis_skin_checked="1">
            <h4 class="modal-title text-white">
              Comite: {{ $comite->nombre_comite }}
            </h4>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
            @if (count($comite->members) > 0)
                <h4>Miembros</h4>
            @else
                <h4>No existen miembros registrados</h4>
            @endif
            <ul class="list-group border-0">
                @foreach ($comite->members as $member)
                    <li class="list-group-item py-4 border-0">
                        <div class="d-flex mb-2">
                            <div class="bg-primary p-2 rounded d-inline-block me-2">
                                <i class="ti ti-user fs-7 text-white"></i>
                            </div>
                            <div class="card-info">
                                <span class="fw-bolder">Cédula: {{ $member->cedula }} </span>
                                <p class="mb-0"><span class="fw-bolder">Nombres:</span> {{ $member->nombre }} {{ $member->apellido }}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <p class="mb-1"><span class="fw-bolder">Correo:</span> {{ $member->correo }}</p>
                            <span class="fw-bolder mb-1">Tipo de cargo: {{ \App\Models\Positions::getTypesPositions()[$member->tipo_cargo] ?? 'No definido' }}</span>
                            <span class="fw-bolder">Cargo: {{ \App\Models\Positions::getPositions()[$member->cargo] ?? 'No definido' }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
