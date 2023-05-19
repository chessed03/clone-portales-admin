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

                    <form action="{{ route('certification-save-create') }}" method="POST">

                        @csrf

                        <div class="card card-default">

                        <div class="card-header">

                            <div class="row justify-content-between">

                                <div class="col-6">
                                    <h6>Crear certificación</h6>
                                </div>

                                <div class="col-6 text-right">

                                    <a href="{{ route('certification-index') }}">
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
                                                    <select name="school_id" id="school_id" class="form-control select2bs4 @error('school_id') is-invalid @enderror">
                                                        <option selected></option>
                                                        @foreach( $list_schools as $school )
                                                            <option {{ ( $school->id == old('school_id') ?? '' )  ? 'selected' : '' }} value="{{ $school->id }}">{{ $school->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('school_id')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="name">Nombre de la certificación:</label>
                                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                                    @error('name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="description">Descripción:</label>
                                                    <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                                                    @error('description')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label>Imagen: ( 197x148 píxeles )*</label>
                                                    <div class="input-group">
                                                        <label class="input-group-btn">
                                                    <span class="btn btn-primary btn-file elevation-2" onchange="uploadImage()" data-action="btn-upload" data-input-url="image_url" data-preview-image="image_preview">
                                                        <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar imagen <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="upload_image" type="file" id="upload_image">
                                                    </span>
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <input class="form-control @error('image_url') is-invalid @enderror" name="image_url" readonly="readonly" id="image_url" type="text" value="{{ old('image_url') }}">
                                                        @error('image_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                            <div class="row">

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">

                                                    <label for="image_preview">Previsualización de imágen:</label>

                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">

                                                    <img
                                                        src=""
                                                        id="image_preview"
                                                        class="img-fluid rounded mb-4"
                                                        style="max-height: 280px"
                                                    />

                                                </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

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

        uploadImage( url_upload_image, token );

    </script>

@endsection

