@can('mostrar-usuarios')
@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
            <div class="card-body px-4 py-3" bis_skin_checked="1">
              <div class="row align-items-center" bis_skin_checked="1">
                <div class="col-9" bis_skin_checked="1">
                  <h4 class="fw-semibold mb-8">Mi Perfil</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('profile.index') }}">Mi Perfil</a>
                        </li>
                        {{-- <li class="breadcrumb-item" aria-current="page">Listado</li> --}}
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
        {{-- seccion profile --}}
        <section style="background-color: #eee;">
            <div class="container py-5">
              {{-- <div class="row">
                <div class="col">
                  <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item"><a href="#">User</a></li>
                      <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                  </nav>
                </div>
              </div> --}}
          
              <div class="row">
                <div class="col-lg-4">
                  <div class="card mb-4">
                    <div class="card-body text-center">
                        @if ($user->picture)
                        <img src="{{ asset($user->picture) }}" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                        @else
                        <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                        @endif
                      
                        <form method="POST" action="{{ url('picture') }}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="form-group">
                              {{-- <label for=""></label> --}}
                              
                                    <div class="col-lg-12 mb-3">
                                        {!! Form::hidden('id', $user->id) !!}
                                        <label for="" class="form-label">Cambiar foto de perfil</label>
                                        <input type="file" name="picture" class="form-control" id="" required>
                                        @error('picture')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                            </div>
                            <button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-upload"></i> Subir Foto</button>
                          </form>
                      <h5 class="my-3">{{ $user->nombre }} {{ $user->apellido }}</h5>
                      <p class="text-muted mb-1">{{ $user->name }}</p>
                      {{-- <p class="text-muted mb-4">Bay Area, San Francisco, CA</p> --}}
                      {{-- <div class="d-flex justify-content-center mb-2">
                        <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Follow</button>
                        <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Message</button>
                      </div> --}}
                    </div>
                  </div>
                  {{-- <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                      <ul class="list-group list-group-flush rounded-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                          <i class="fas fa-globe fa-lg text-warning"></i>
                          <p class="mb-0">https://mdbootstrap.com</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                          <i class="fab fa-github fa-lg text-body"></i>
                          <p class="mb-0">mdbootstrap</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                          <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                          <p class="mb-0">@mdbootstrap</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                          <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                          <p class="mb-0">mdbootstrap</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                          <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                          <p class="mb-0">mdbootstrap</p>
                        </li>
                      </ul>
                    </div>
                  </div> --}}
                </div>
                <div class="col-lg-8">
                  <div class="card mb-4">
                    {!! Form::model($user, ['route' => ['profile.update', $user->id], 'class' => 'form-horizontal', 'method' => 'PUT']) !!}
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                {!! Form::hidden('id', null, ) !!}
                                {!! Form::label('name', 'Username', ['class' => 'form-label']) !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                {!! Form::label('nombre', 'Nombre', ['class' => 'form-label']) !!}
                                {!! Form::text('nombre', null, ['class' => 'form-control', 'required']) !!}
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                {!! Form::label('apellido', 'Apellido', ['class' => 'form-label']) !!}
                                {!! Form::text('apellido', null, ['class' => 'form-control', 'required']) !!}
                                @error('apellido')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                {!! Form::label('telefono', 'Telefono', ['class' => 'form-label']) !!}
                                {!! Form::text('telefono', null, ['class' => 'form-control', 'maxlength' => '13']) !!}
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                      </div>
                      <hr>
                      <div class="form-group row">
                        <div class="col-sm-10">
                           <button type="submit" class="btn btn-sm btn-warning"><i class="ti ti-save-alt"></i> Actualizar</button>
                        </div>
                     </div>
                    </div>
                    {{ Form::close() }}
                  </div>
                  {{-- <div class="row">
                    <div class="col-md-6">
                      <div class="card mb-4 mb-md-0">
                        <div class="card-body">
                          <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                          </p>
                          <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                          <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                              aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                          <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                              aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                          <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                              aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                          <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                              aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                          <div class="progress rounded mb-2" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                              aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card mb-4 mb-md-0">
                        <div class="card-body">
                          <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                          </p>
                          <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                          <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                              aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                          <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                              aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                          <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                              aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                          <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                              aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                          <div class="progress rounded mb-2" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                              aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                </div>
              </div>
            </div>
          </section>
        {{-- end seccion profile --}}
    </div>
@endsection


@section('page-scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script>
        window.urlUsers = '{{ route("users.list") }}';
    </script>
    <script src="{{ asset('assets/js/pages/users/users.js') }}"></script>
    
@endsection
@endcan