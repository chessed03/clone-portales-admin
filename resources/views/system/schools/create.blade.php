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

                    <form action="{{ route('school-save-create') }}" method="POST">

                        @csrf

                        <div class="card card-default">

                            <div class="card-header">

                                <div class="row justify-content-between">

                                    <div class="col-6">
                                        <h6>Crear universidad</h6>
                                    </div>

                                    <div class="col-6 text-right">

                                        <a href="{{ route('school-index') }}">
                                            <button type="button" class="btn btn-danger elevation-2 mr-4">
                                                <i class="bx-fw bx bx-x-circle"></i> Cancelar
                                            </button>
                                        </a>

                                        <button type="submit" class="btn btn-success elevation-2"><i class='bx-fw bx bx-save'></i> Guardar</button>

                                    </div>

                                </div>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                            <div class="row">

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="name">Nombre:</label>
                                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                                    @error('name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="contact">Contacto:</label>
                                                    <input type="text" name="contact" id="contact" class="form-control @error('contact') is-invalid @enderror" value="{{ old('contact') }}">
                                                    @error('contact')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="address">Dirección:</label>
                                                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                                                    @error('address')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                    <label for="phone_main">Telefono principal:</label>
                                                    <input type="text" name="phone_main" id="phone_main" class="form-control @error('phone_main') is-invalid @enderror" value="{{ old('phone_main') }}">
                                                    @error('phone_main')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                    <label for="phone_secondary">Telefono secundario:</label>
                                                    <input type="text" name="phone_secondary" id="phone_secondary" class="form-control" value="{{ old('phone_secondary') }}">
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                    <label for="email_main">Correo principal:</label>
                                                    <input type="text" name="email_main" id="email_main" class="form-control @error('email_main') is-invalid @enderror" value="{{ old('email_main') }}">
                                                    @error('email_main')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                    <label for="email_secondary">Correo secundario:</label>
                                                    <input type="text" name="email_secondary" id="email_secondary" class="form-control" value="{{ old('email_secondary') }}">
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                    <label for="facebook">Facebook:</label>
                                                    <input type="text" name="facebook" id="facebook" class="form-control" value="{{ old('facebook') }}">
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                    <label for="instagram">Instagram:</label>
                                                    <input type="text" name="instagram" id="instagram" class="form-control" value="{{ old('instagram') }}">
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                    <label for="twitter">Twitter:</label>
                                                    <input type="text" name="twitter" id="twitter" class="form-control" value="{{ old('twitter') }}">
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                    <label for="youtube">Youtube:</label>
                                                    <input type="text" name="youtube" id="youtube" class="form-control" value="{{ old('youtube') }}">
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 form-group">
                                                    <label for="years_experience">Años de experiencia:</label>
                                                    <input type="number" name="years_experience" id="years_experience" class="form-control" value="{{ old('years_experience') }}">
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9 form-group">
                                                    <label for="mail_recipients">Correos receptores: ( usar separador "," coma )*</label>
                                                    <input type="text" name="mail_recipients" id="mail_recipients" class="form-control" value="{{ old('mail_recipients') }}">
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="description">Descripción:</label>
                                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                                                    @error('description')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="meta_keywords">Meta tags keywords:</label>
                                                    <input type="text" name="meta_keywords" id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" value="{{ old('meta_keywords') }}">
                                                    @error('meta_keywords')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="meta_description">Meta tags description:</label>
                                                    <input type="text" name="meta_description" id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" value="{{ old('meta_description') }}">
                                                    @error('meta_description')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label>Logo: ( 354x142 píxeles )*</label>
                                                    <div class="input-group">
                                                        <label class="input-group-btn">
                                                        <span class="btn btn-primary btn-file elevation-2 btnFileOne" onchange="uploadImageOne()" data-action="btn-upload" data-input-url="logo_url" data-preview-image="logo_preview">
                                                            <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar logo <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="upload_image" type="file" id="upload_image">
                                                         </span>
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <input class="form-control @error('logo_url') is-invalid @enderror" name="logo_url" readonly="readonly" id="logo_url" type="text" value="{{ old('logo_url') }}">
                                                        @error('logo_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">

                                                    <label for="logo_preview">Previsualización del logo:</label>

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

                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                            <div class="row">

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="background_color_about_us">Color de fondo:</label>
                                                    <input type="color" name="background_color_about_us" id="background_color_about_us" class="form-control @error('background_color_about_us') is-invalid @enderror" value="{{ old('background_color_about_us') }}">
                                                    @error('background_color_about_us')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="title_about_us">Titulo "nosotros":</label>
                                                    <input type="text" name="title_about_us" id="title_about_us" class="form-control @error('title_about_us') is-invalid @enderror" value="{{ old('title_about_us') }}">
                                                    @error('title_about_us')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="description_about_us">Descripción "nosotros":</label>
                                                    <textarea name="description_about_us" id="description_about_us" class="form-control @error('description_about_us') is-invalid @enderror" rows="3">{{ old('description_about_us') }}</textarea>
                                                    @error('description_about_us')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="mission_about_us">Misión "nosotros":</label>
                                                    <textarea name="mission_about_us" id="mission_about_us" class="form-control @error('mission_about_us') is-invalid @enderror" rows="3">{{ old('mission_about_us') }}</textarea>
                                                    @error('mission_about_us')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="vision_about_us">Visión "nosotros":</label>
                                                    <textarea name="vision_about_us" id="vision_about_us" class="form-control @error('vision_about_us') is-invalid @enderror" rows="3">{{ old('vision_about_us') }}</textarea>
                                                    @error('vision_about_us')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                {{--<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label>Imágen "nosotros": ( 840x250 píxeles )*</label>
                                                    <div class="input-group">
                                                        <label class="input-group-btn">
                                                        <span class="btn btn-primary btn-file elevation-2 btnFileTwo" onchange="uploadImageTwo()" data-action="btn-upload" data-input-url="image_about_us_url" data-preview-image="image_about_us_preview">
                                                            <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar imágen <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="upload_image_two" type="file" id="upload_image_two">
                                                         </span>
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <input class="form-control @error('image_about_us_url') is-invalid @enderror" name="image_about_us_url" readonly="readonly" id="image_about_us_url" type="text" value="{{ old('image_about_us_url') }}">
                                                        @error('image_about_us_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">

                                                    <label for="image_about_us_preview">Previsualización de la imágen:</label>

                                                </div>--}}

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">

                                                    <img
                                                        src=""
                                                        id="image_about_us_preview"
                                                        class="img-fluid rounded mb-4"
                                                        style="max-height: 420px"
                                                    />

                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <label for="notice_privacy">Aviso de privacidad:</label> &nbsp;&nbsp; @error('notice_privacy')<span class="error text-danger small"><strong>El campo aviso de privacidad es requerido</strong></span> @enderror
                                                    <textarea name="notice_privacy" id="notice_privacy" class="form-control form-group tiny-editor">{{ old('notice_privacy') }}</textarea>
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

        uploadImageOne();

        uploadImageTwo();

        tinyEditor( url_upload_image, token );

    </script>

@endsection
