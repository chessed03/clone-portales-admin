@extends('template.app')

@section('content')

    <div class="content-header">

        <div class="container-fluid">

            <div class="col-12 d-flex justify-content-between">

                <h1 class="">{{ $submodule }}</h1>

                <ol class="breadcrumb float-sm">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx-fw bx bx-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $module }}</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $submodule }}</a></li>
                    <li class="breadcrumb-item active">{{ $location }}</li>
                </ol>

            </div>

        </div>

    </div>

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">

                    <form action="{{ route('program-save-create') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="card card-default">

                        <div class="card-header">

                                <div class="row justify-content-between">

                                    <div class="col-4">
                                        <h6>Crear programa</h6>
                                    </div>

                                    <div class="col-8 text-right">

                                        <a href="{{ route('program-index') }}">
                                            <button type="button" class="btn btn-danger elevation-2 mr-4">
                                                <i class="bx-fw bx bx-x-circle"></i> Cancelar
                                            </button>
                                        </a>

                                        <button type="submit" class="btn btn-success elevation-2"><i class='bx bx-fw bx-save'></i> Guardar</button>

                                    </div>

                                </div>

                            </div>

                        <div class="card-body">

                                <div class="row">

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                        <div class="row">

                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                                <div class="row">

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                        <label for="schools">Universidad:</label>
                                                        <select name="school_id" id="school_id" class="form-control select2bs4 @error('school_id') is-invalid @enderror" required>
                                                            <option selected></option>
                                                            @foreach( $list_schools as $school )
                                                                <option {{ ( $school->id == old('school_id') ?? '' )  ? 'selected' : '' }} value="{{ $school->id }}">{{ $school->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('school_id')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                        <label for="name">Nombre del programa:</label>
                                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" oninput="generateSlug('name', 'slug')" required>
                                                        @error('name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                        <label for="slug">Slug:</label>
                                                        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}">
                                                        @error('slug')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                        <label for="level">Nivel:</label>
                                                        <input type="text" name="level" id="level" class="form-control @error('level') is-invalid @enderror" value="{{ old('level') }}">
                                                        @error('level')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                        <label for="area">Área:</label>
                                                        <input type="text" name="area" id="area" class="form-control @error('area') is-invalid @enderror" value="{{ old('area') }}">
                                                        @error('area')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                        <label for="description">Descripción:</label>
                                                        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                                                        @error('description')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                        <label for="duration">Duración:</label>
                                                        <input type="text" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}">
                                                        @error('duration')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                        <label for="meta_keywords">Meta tags keywords:</label>
                                                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" value="{{ old('meta_keywords') }}">
                                                        @error('meta_keywords')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 form-group">
                                                        <label for="inputFilePDF">Archivo anexo (PDF): máximo 20 Megas*</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" name="file" accept=".pdf" class="custom-file-input custom-upload-file @error('file') is-invalid @enderror" id="inputFilePDF" data-size="20000">
                                                                <label class="custom-file-label" for="inputFilePDF">Buscar archivo</label>
                                                            </div>
                                                        </div>
                                                        <span style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" role="alert"><strong class="custom-message-file"></strong></span>
                                                        @error('file')<span style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 form-group">
                                                        <label for="meta_keywords">Estado:</label>
                                                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                                            <option value="1" {{ ( old('status') == "1" ) ? 'selected' : '' }}> Publicar </option>
                                                            <option value="2" {{ ( old('status') == "2" ) ? 'selected' : '' }} {{ old('status') ?? 'selected' }}> Borrador</option>
                                                        </select>
                                                        @error('status')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                                <div class="row">

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                        <label>Imagen: ( 1180x664 píxeles )*</label>
                                                        <div class="input-group">
                                                            <label class="input-group-btn">
                                                                <span class="btn btn-primary btn-file elevation-2 btnFileOne" onchange="uploadImageOne()" data-action="btn-upload" data-input-url="image_url" data-preview-image="logo_preview">
                                                                    <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar imágen <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="upload_image" type="file" id="upload_image">
                                                                 </span>
                                                            </label>
                                                            &nbsp;&nbsp;
                                                            <input class="form-control @error('image_url') is-invalid @enderror" name="image_url" readonly="readonly" id="image_url" type="text" value="{{ old('image_url') }}">
                                                            @error('image_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">

                                                        <label for="logo_preview">Previsualización del la imágen:</label>

                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">
                                                        <img
                                                            src=""
                                                            id="logo_preview"
                                                            class="img-fluid rounded mb-4"
                                                            style="max-height: 220px"
                                                        />
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                        <label for="content">Contenido:</label>
                                        <textarea name="content" id="content" class="form-control tiny-editor">{{ old('content') }}</textarea>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        @error('content')<span class="error text-danger small"><strong>{{ $message }}</strong></span> @enderror
                                    </div>

                                </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

@endsection

@section('scripts')

    <script>

        let url_upload_image = '{{ route("multimedia-upload-image") }}';

        let token            = '{{ csrf_token() }}';

        uploadImageOne();

        tinyEditor( url_upload_image, token );

    </script>

@endsection

