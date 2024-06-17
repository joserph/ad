@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>

</style>
@endsection

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
        <div class="card-body px-4 py-3" bis_skin_checked="1">
          <div class="row align-items-center" bis_skin_checked="1">
            <div class="col-9" bis_skin_checked="1">
              <h4 class="fw-semibold mb-8">@if($notices->id) Editar Noticia @else Crear Noticia @endif</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('notices.index') }}">Noticias</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">@if($notices->id) Editar @else Crear @endif</li>
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
        <div class="card-body position-relative">
            {{-- <h5 class="card-title fw-semibold mb-4"> @if($notices->id) Editar noticia @else Crear noticia @endif</h5> --}}
            <form class="row" method="POST" @if($notices->id) action="{{ route('notices.update', $notices) }}" @else action="{{ route('notices.store') }}" @endif enctype="multipart/form-data" accept="image/*" id="formNotices">
                @csrf
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $notices->title ?? old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="title" class="form-label">Categoría</label>
                    <select class="form-control select2 @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                        <option value="">Seleccione una opción</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $notices->category_id == $category->id ?? '' ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="link" class="form-label">Link</label>
                    <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ $notices->link ?? old('link') }}">
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5 col-12">
                    <label for="content" class="form-label">Contenido</label>
                    <div id="editor-container" class="editor-container"></div>
                    <input type="hidden" id="content" name="content" value="{!! $notices->content ?? old('content') !!}">
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mb-5"></div>
                {{-- <div class="mb-3 col-md-6">
                    <label for="content" class="form-label">Contenido</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{ $notices->content ?? old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                @if ($notices)
                <div class="col-12 mb-3 mt-4 mt-sm-0">
                    <label for="content" class="form-label">Archivos adjuntos</label>
                    <div class="row">
                        @foreach ($notices->noticeFiles as $file)
                        <div class="col-sm6 col-md-4 col-lg-3 box-img position-relative mb-3">
                            <a href="{{ route('notices.deleteAttachment', $file) }}" class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill delete-attach">
                                <i class="ti ti-trash text-white fs-4"></i>
                            </a>

                            <img src="{{ asset($file->file_path) }}" alt="" class="img-fluid rounded">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="col-12 mb-3">
                    <div id="myDropzone" class="dropzone">
                        {{-- <div class="fallback">
                            <input type="file" class="form-control" id="media_path" name="media_path[]" multiple>
                        </div>
                        <label for="media_path" class="form-label">Arrastra y suelta archivos aquí o haz clic para seleccionar</label> --}}
                    </div>
                    <input type="text" class="d-none" id="media_paths" name="media_path" readonly>
                    @error('media_path')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="mb-3 col-md-6" id="myId">
                    <label for="media_path" class="form-label">Archivo</label>
                    <input type="file" class="form-control @error('media_path') is-invalid @enderror" id="media_path" name="media_path[]" multiple>

                    @error('media_path')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div class="mb-3 col-md-6">
                    <label for="link" class="form-label">Principal</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="main" name="main" value="1" {{ isset($notices) && $notices->main == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="main">
                            Marcar como principal
                        </label>
                    </div>
                    @error('main')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 align-self-end">
                    <button type="submit" class="btn btn-primary"> @if($notices->id) Actualizar @else Añadir @endif</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/libs/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/forms/select2.init.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/forms/datepicker-init.js') }}"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        $(document).ready(function() {
            $('.delete-attach').on('click', function(event) {
                event.preventDefault();
                let element = $(this).parent(), url = $(this).attr('href');

                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        element.remove();
                        toastr.success(response.success, "¡Éxito!", {
                            progressBar: true,
                        });
                        console.log('Solicitud AJAX POST exitosa');
                    },
                    error: function(xhr, status, error) {
                        toastr.error(response.error, "Ups!", {
                            progressBar: true,
                        });
                    }
                });
            });
        });

    </script>
    <script>
        let quill = new Quill('#editor-container', {
            theme: 'snow'
        });

        let contentInput = document.querySelector('input[name=content]');

        quill.on('text-change', function() {
            let html = quill.root.innerHTML;
            contentInput.value = html;
        });

        let existingContent = '{!! $notices->content ?? old('content') !!}';

        if (existingContent) {
            quill.root.innerHTML = existingContent;
        }
    </script>

    <script>
        Dropzone.autoDiscover = false;
        let uploadedPaths = [];
        let myDropzone = new Dropzone("#myDropzone", {
            paramName: "media_path",
            maxFilesize: 5,
            maxFiles: null,
            acceptedFiles: ".jpg,.jpeg,.png,.gif",
            addRemoveLinks: true,
            dictDefaultMessage: "Arrastra y suelta archivos aquí o haz clic para seleccionar",
            dictRemoveFile: "Eliminar archivo",
            dictCancelUpload: "Cancelar carga",
            autoProcessQueue: true,
            url: "{{ route('notices.uploads') }}",
            init: function() {

                this.on("sending", function(file, xhr, formData) {
                    formData.append('_token', '{{ csrf_token() }}');
                });

                this.on("success", function(file, response) {
                    uploadedPaths.push(response);
                    file.fullPath = response;
                    console.log(file)
                    console.log(response)
                    updateMediaPathsInput();
                });

                this.on("removedfile", function(file) {
                    let index = uploadedPaths.indexOf(file.fullPath);
                    if (index !== -1) {
                        uploadedPaths.splice(index, 1);
                        updateMediaPathsInput();
                    }
                });

            }
        });

        function updateMediaPathsInput() {
            let media_paths_input = document.getElementById('media_paths');
            media_paths_input.value = uploadedPaths.join(',');
        }
    </script>


    <!-- <script src="{{ asset('assets/js/pages/members/members-register.js') }}"></script> -->
@endsection
