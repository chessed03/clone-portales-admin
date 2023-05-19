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

                    <form action="{{ route('event-save-update') }}" method="POST">

                        @csrf

                        <div class="card card-default">

                            <div class="card-header">

                                <div class="row justify-content-between">

                                    <div class="col-6">
                                        <h6>Editar evento</h6>
                                    </div>

                                    <div class="col-6 text-right">

                                        <a href="{{ route('event-index') }}">
                                            <button type="button" class="btn btn-danger elevation-2 mr-4">
                                                <i class="bx-fw bx bx-x-circle"></i> Cancelar
                                            </button>
                                        </a>

                                        <button type="submit" class="btn btn-success elevation-2"><i class='bx bx-fw bx-save'></i> Guardar</button>

                                    </div>

                                </div>

                            </div>

                            <div class="card-body">

                            <input type="hidden" name="id" id="id" value="{{ $item->id }}">

                            <div class="row">

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

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

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                    <label for="name">Nombre del evento:</label>
                                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $item->name }}" oninput="generateSlug('name', 'slug')" required>
                                                    @error('name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                    <label for="slug">Slug:</label>
                                                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') ?? $item->slug }}">
                                                    @error('slug')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="description">Descripción:</label>
                                                    <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') ?? $item->description }}">
                                                    @error('description')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                    <label for="start_date">Fecha de inicio:</label>
                                                    <div class="input-group date datetime-input" id="start_date" data-target-input="nearest">
                                                        <input type="text" name="start_date" class="form-control datetimepicker-input @error('start_date') is-invalid @enderror" value="{{ ( $item->start_date) ? \Carbon\Carbon::createFromDate( old('start_date') ?? $item->start_date )->format('d/m/Y g:i A') : '' }}" data-target="#start_date"/>
                                                        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                        @error('start_date')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                    <label for="finish_date">Fecha de cierre:</label>
                                                    <div class="input-group date datetime-input" id="finish_date" data-target-input="nearest">
                                                        <input type="text" name="finish_date" class="form-control datetimepicker-input @error('finish_date') is-invalid @enderror" value="{{ ( $item->finish_date) ? \Carbon\Carbon::createFromDate( old('finish_date') ?? $item->finish_date )->format('d/m/Y g:i A') : '' }}" data-target="#finish_date"/>
                                                        <div class="input-group-append" data-target="#finish_date" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                        @error('finish_date')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label for="location">Ubicación:</label>
                                                    <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') ?? $item->location }}">
                                                    @error('location')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 form-group">
                                                    <label for="meta_keywords">Meta tags keywords:</label>
                                                    <input type="text" name="meta_keywords" id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" value="{{ old('meta_keywords') ?? $item->meta_keywords }}">
                                                    @error('meta_keywords')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 form-group">
                                                    <label for="meta_keywords">Estado:</label>
                                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                                        <option value="1" {{ ( ( old('status') ?? $item->status ) == 1 ) ? 'selected' : '' }}> {{ ( $item->status == 1 ) ? 'Publicado' : 'Publicar' }}</option>
                                                        <option value="2" {{ ( ( old('status') ?? $item->status ) == 2 ) ? 'selected' : '' }}> Borrador</option>
                                                    </select>
                                                    @error('status')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <div id="discount-price-component" data-has_cost="{{ old('input_has_cost') ?? $item->has_cost }}" data-input_value_price="{{ old('input_value_price') ?? $item->price }}" data-select_value_discount="{{ old('select_value_discount') ?? $item->discount }}"></div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" class="form-group">
                                                    @error('input_value_price')
                                                    <div class="text-danger">
                                                        <small><strong>El campo precio es requerido</strong></small>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" class="form-group">
                                                    @error('select_value_discount')
                                                    <div class="text-danger">
                                                        <small><strong>El campo decuento es requerido</strong></small>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <input type="text" name="input_value_price" id="input_value_price" value="{{ old('input_value_price') ?? $item->price }}" hidden>
                                                <input type="text" name="select_value_discount" id="select_value_discount" value="{{ old('select_value_discount') ?? $item->discount }}" hidden>
                                                <input type="text" name="input_has_cost" id="input_has_cost" value="{{ old('input_has_cost') ?? $item->has_cost ?? 0 }}" hidden>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group text-right" hidden>
                                                    <div class="custom-control custom-switch custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input check-notice" name="launch_notice" id="launch_notice" value="1" {{ ($notice) ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="launch_notice">Crear noticia</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                            <div class="row">

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label>Imagen: ( 1180x787 píxeles )*</label>
                                                    <div class="input-group">
                                                        <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file elevation-2 btnFileOne" onchange="uploadImageOne()" data-action="btn-upload" data-input-url="image_url" data-preview-image="logo_preview">
                                                    <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar imágen <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="upload_image" type="file" id="upload_image">
                                                 </span>
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <input class="form-control @error('image_url') is-invalid @enderror" name="image_url" readonly="readonly" id="image_url" type="text" value="{{ old('image_url') ?? $item->image_url }}">
                                                        @error('image_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">

                                                    <label for="logo_preview">Previsualización del la imágen:</label>

                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">
                                                    <img
                                                        src="{{ old('image_url') ?? $item->image_url }}"
                                                        id="logo_preview"
                                                        class="img-fluid rounded mb-4"
                                                        style="max-height: 220px"
                                                    />
                                                </div>

                                                {{--<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                    <label>Banner: ( 1240x350 píxeles )*</label>
                                                    <div class="input-group">
                                                        <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file elevation-2 btnFileTwo" onchange="uploadImageTwo()" data-action="btn-upload" data-input-url="image_banner_url" data-preview-image="image_about_us_preview">
                                                    <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar imágen <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="upload_image_two" type="file" id="upload_image_two">
                                                 </span>
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <input class="form-control @error('image_banner_url') is-invalid @enderror" name="image_banner_url" readonly="readonly" id="image_banner_url" type="text" value="{{ old('image_banner_url') ?? $item->image_banner_url }}">
                                                        @error('image_banner_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">

                                                    <label for="image_about_us_preview">Previsualización de la imágen:</label>

                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4 mb-lg-0 text-center">

                                                    <img
                                                        src="{{ old('image_banner_url') ?? $item->image_banner_url }}"
                                                        id="image_about_us_preview"
                                                        class="img-fluid rounded mb-4"
                                                        style="max-height: 420px"
                                                    />

                                                </div>--}}

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

        uploadImageOne();

    </script>

@endsection

