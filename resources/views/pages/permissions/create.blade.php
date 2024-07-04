@extends('layouts.app')

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
        <div class="card-body px-4 py-3" bis_skin_checked="1">
            <div class="row align-items-center" bis_skin_checked="1">
            <div class="col-9" bis_skin_checked="1">
                <h4 class="fw-semibold mb-8">Crear Permiso</h4>
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('permissions.index') }}">Permisos</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Crear</li>
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

    <div class="card">
        <div class="card-body">
            <form class="row" method="POST" action="{{ route('permissions.store') }}">
                @csrf
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="name" id="" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('page-scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    {{-- <script>
        window.urlUsers = '{{ route("users.list") }}';
    </script>
    <script src="{{ asset('assets/js/pages/users/users.js') }}"></script> --}}
    
@endsection
