@extends('template.app')
@section('content')

    <div class="content-header">

        <div class="container-fluid">

            <div class="col-12 d-flex justify-content-between">

                <h1 class="">Inicio</h1>

                <ol class="breadcrumb float-sm">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx-fw bx bx-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                </ol>

            </div>

        </div>

    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">Sistema de administración de portales</div>

                    <div class="card-body text-center">

                       <h1>Bienvenido</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
