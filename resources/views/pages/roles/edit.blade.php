@extends('layouts.app')

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
        <div class="card-body px-4 py-3" bis_skin_checked="1">
            <div class="row align-items-center" bis_skin_checked="1">
            <div class="col-9" bis_skin_checked="1">
                <h4 class="fw-semibold mb-8">Editar Role</h4>
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('roles.index') }}">Roles</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Editar</li>
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
            <form class="row" method="POST" action="{{ route('roles.update', $role) }}">
                @csrf
                @method('PUT')
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="name" id="" value="{{ $role->name }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12">
                    <div class="mb-3">
                        {{-- {!! Form::label('roles', 'Permissions', ['class' => 'form-label']) !!} --}}
                        <label for="roles" class="form-label">Roles</label>
                        <div class="row">
            
                        @foreach ($permission as $key => $item)
            
                            <div class="col-2">
                                <label for="permission" class="form-check-label">
                                    @isset($role)
                                        {{-- {{ form::checkbox('permission[]', $item->id, in_array($item->id, $rolePermissions) ? true : false, ['class' => 'form-check-input', 'id' => 'permission']) }}
                                        {{ $item->name }} --}}
                                        <input class="form-check-input" name="permission[]" type="checkbox" @if (in_array($item->id, $rolePermissions))
                                        checked="checked"
                                        @endif value="{{$item->id}}" id="flexCheckDefault_{{$item->id}}">
                                        <label class="form-check-label" for="flexCheckDefault_{{$item->id}}">
                                            {{ $item->name }}
                                        </label>
                                    @else
                                        <input class="form-check-input" name="permission[]" type="checkbox" value="{{$item->id}}" id="flexCheckDefault_{{$item->id}}">
                                        <label class="form-check-label" for="flexCheckDefault_{{$item->id}}">
                                            {{ $item->name }}
                                        </label>
                                        
                                        {{-- {!! form::checkbox('permission[]', $item->id, false, ['class' => 'form-check-input', 'id' => 'permission']) !!}
                                        {{ $item->name }} --}}
                                    @endisset
            
                                </label>
                            </div>
                        @endforeach
                        @error('permission')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
            
                    </div>
                    </div>
                </div><!-- Col -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Registrar</button>
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
