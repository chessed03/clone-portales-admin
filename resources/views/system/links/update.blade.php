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

                    <form action="{{ route('link-save-update') }}" method="POST">

                        @csrf

                        <div class="card card-default">

                            <div class="card-header">

                                <div class="row justify-content-between">

                                    <h6>Crear Link</h6>

                                    <div class="col-6 text-right">

                                        <a href="{{ route('link-index') }}">
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

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="schools">Universidad:</label>
                                                <select name="school_id" id="school_id" class="form-control select2bs4 @error('school_id') is-invalid @enderror">
                                                    <option selected></option>
                                                    @foreach( $list_schools as $school )
                                                        <option {{ ( $school->id == $item->school_id ?? '' )  ? 'selected' : '' }} value="{{ $school->id }}">{{ $school->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('school_id')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                <label for="platform_high_school_students_url">URL plataforma de estudiantes - Nivel Preparatoria:</label>
                                                <input type="text" name="platform_high_school_students_url" id="platform_high_school_students_url" class="form-control" value="{{ old('platform_high_school_students_url') ?? $item->platform_high_school_students_url }}">
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                <label for="platform_high_school_teachers_url">URL plataforma de maestros - Nivel Preparatoria:</label>
                                                <input type="text" name="platform_high_school_teachers_url" id="platform_high_school_teachers_url" class="form-control" value="{{ old('platform_high_school_teachers_url') ?? $item->platform_high_school_teachers_url }}">
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                <label for="platform_degree_students_url">URL plataforma de estudiantes - Nivel Licenciatura:</label>
                                                <input type="text" name="platform_degree_students_url" id="platform_degree_students_url" class="form-control" value="{{ old('platform_degree_students_url') ?? $item->platform_degree_students_url }}">
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                <label for="platform_degree_teachers_url">URL plataforma de maestros - Nivel Licenciatura:</label>
                                                <input type="text" name="platform_degree_teachers_url" id="platform_degree_teachers_url" class="form-control" value="{{ old('platform_degree_teachers_url') ?? $item->platform_degree_teachers_url }}">
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
