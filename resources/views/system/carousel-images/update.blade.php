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

                    <form id="carousel-image-save-update" action="{{ route('carousel-image-save-update') }}" method="POST">

                        @csrf

                        <div class="card card-default">

                        <div class="card-header">

                            <div class="row justify-content-between">

                                <div class="col-6">
                                    <h6>Editar imágen para carrusel</h6>
                                </div>

                                <div class="col-6 text-right">

                                    <a href="{{ route('carousel-image-index') }}">
                                        <button type="button" class="btn btn-danger elevation-2 mr-4">
                                            <i class="bx-fw bx bx-x-circle"></i> Cancelar
                                        </button>
                                    </a>

                                    <button type="submit" class="btn btn-success elevation-2" onclick="submitForm(); return false;"><i class='bx bx-fw bx-save'></i> Guardar</button>

                                </div>

                            </div>

                        </div>

                        <div class="card-body">

                            <input type="hidden" name="id" id="id" value="{{ $item->id }}">

                            <div class="row">

                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                    <div class="row">

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                            <label for="schools">Universidades:</label>
                                            <div class="select2-success @error('schools') is-invalid @enderror">
                                                <select name="schools[]" id="schools" class="select2" data-dropdown-css-class="select2-success" multiple="multiple" required>
                                                    @foreach( $list_schools as $school )
                                                        <option {{ ( in_array( $school->id, $item->schools ?? [] ) ) ? 'selected' : '' }} value="{{ $school->id }}">{{ $school->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('schools')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                            <label for="name">Nombre de la imágen:</label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $item->name }}" required>
                                            @error('name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                            <label for="content">Texto para la imagen web</label>
                                            <textarea class="tiny-editor form-control" style="width: 100%;" rows="10" name="content">{!! old('content') ?? $item->content ?? "" !!}</textarea>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                            <label for="content_movil">Texto para la imagen móvil</label>
                                            <textarea class="tiny-editor form-control" style="width: 100%;" rows="10" name="content_movil">{!! old('content_movil') ?? $item->content_movil ?? "" !!}</textarea>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                    <div class="row">

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                            <label>Imágen: ( 1920x850 píxeles )*</label>
                                            <div class="input-group">
                                                <label class="input-group-btn">
                                                        <span class="btn btn-primary btn-file elevation-2 btnFileOne" onchange="uploadImageOne()" data-action="btn-upload" data-input-url="image_url" data-preview-image="image_preview">
                                                           <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar imagen <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="upload_image" type="file" id="upload_image">
                                                         </span>
                                                </label>
                                                &nbsp;&nbsp;
                                                <input class="form-control @error('image_url') is-invalid @enderror" name="image_url" readonly="readonly" id="image_url" type="text" value="{{ old('image_url') ?? $item->image_url }}">
                                                @error('image_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">
                                            <label for="image_preview">Previsualización de imágen:</label>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">
                                            <img
                                                src="{{ old('image_url') ?? $item->image_url ?? "" }}"
                                                id="image_preview"
                                                class="img-fluid rounded mb-4"
                                                style="max-height: 400px"
                                            />
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                            <label>Imágen movil: ( 730x1390 píxeles )*</label>
                                            <div class="input-group">
                                                <label class="input-group-btn">
                                                    <span class="btn btn-primary btn-file elevation-2 btnFileTwo" onchange="uploadImageTwo()" data-action="btn-upload" data-input-url="image_movil_url" data-preview-image="image_movil_url_preview">
                                                        <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar imágen <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="upload_image_two" type="file" id="upload_image_two">
                                                     </span>
                                                </label>
                                                &nbsp;&nbsp;
                                                <input class="form-control @error('image_movil_url') is-invalid @enderror" name="image_movil_url" readonly="readonly" id="image_movil_url" type="text" value="{{ old('image_movil_url') ?? $item->image_movil_url }}">
                                                @error('image_movil_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">

                                            <label for="image_movil_url_preview">Previsualización de la imágen:</label>

                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">

                                            <img
                                                src="{{ old('image_movil_url') ?? $item->image_movil_url }}"
                                                id="image_movil_url_preview"
                                                class="img-fluid rounded mb-4"
                                                style="max-height: 420px"
                                            />

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

        tinyEditor( url_upload_image, token );

        uploadImageOne();

        uploadImageTwo();

        const submitForm = () => {

            let image_url = $('#image_url');

            if ( image_url.val() == '' ) {

                image_url.addClass('is-invalid');

                alertMessage('El campo imágen es requerido.', 'error');

                return false;

            }

            let campo_imagen_movil = $('#image_movil_url');

            if ( campo_imagen_movil.val() == '' ) {

                campo_imagen_movil.addClass('is-invalid');

                alertMessage('El campo imágen móvil es requerido.', 'error');

                return false;

            }

            $('#carousel-image-save-update').submit();

        }

    </script>

@endsection
