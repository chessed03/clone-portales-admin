<!DOCTYPE html>
<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token_UWl0eGVuTg==" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('template.appheaderlibraries')

    @livewireStyles

    @viteReactRefresh

    @vite('resources/js/app.js')

</head>

    <body class="sidebar-mini layout-footer-fixed text-sm">

        <div class="wrapper">

            <div class="preloader flex-column justify-content-center align-items-center">

                <img class="animation__shake" src="{{ asset("template/admin/img/images/AdminLTELogo.png") }}" alt="AdminLTELogo" height="120" width="120">

            </div>

            <nav class="main-header navbar navbar-expand sidebar-dark-success text-sm">

                <ul class="navbar-nav">

                    <li class="nav-item">

                        {{--<a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: #ffffff"><i class='bx-fw bx bx-grid-vertical'></i></a>--}}

                    </li>

                </ul>

                <ul class="navbar-nav ml-auto">


                    <li class="nav-item dropdown">

                        <a class="nav-link p-0" data-toggle="dropdown" href="#">

                            <img  width="100" height="100" src="{{ (auth()->user()->profile_photo_path) ? '/storage' . auth()->user()->profile_photo_path : asset("template/admin/img/profile-photos/default.png") }}" class="rounded-circle" style="width: 30px; height: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </a>

                        <div class="dropdown-menu dropdown-menu-right">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class='bx-fw bx bx-log-out-circle'></i> Cerrar sesión
                                </a>
                            </form>

                            {{--<div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                                <i class='bx-fw bx bx-log-out-circle'></i> Cerrar sesión
                            </a>--}}

                        </div>

                    </li>

                </ul>

            </nav>

            <div class="content-wrapper">
                @yield('content')
            </div>

            @include('template.sidebar')

            <footer class="main-footer text-sm">

                <strong>Copyright &copy; 2023 <a href="#">{{ config('app.name', 'Laravel') }}</a>.</strong> Todos los derechos reservados.

                <div class="float-right d-none d-sm-inline-block">

                    <b>Version</b> 1.0

                </div>

            </footer>

        </div>

        @include('template.appfooterlibraries')

        @yield('scripts')

        @if ( $message = Session::get('success') )

            <script>

                setTimeout(() => {

                    alertMessage( '{{ $message }}', 'success' );

                }, "500");

            </script>

        @endif

        @if ($message = Session::get('error'))
            <script>

                setTimeout(() => {

                    alertMessage( '{{ $message }}', 'error' );

                }, "500");

            </script>
        @endif

        @livewireScripts

        @stack('js')

        <script type="text/javascript">

            window.livewire.on('closeCreateModal', () => {

                $('.create-modal').modal('hide');

            });

            window.livewire.on('closeUpdateModal', () => {

                $('.update-modal').modal('hide');

            });

            window.livewire.on('message', ( text, icon ) => {

                alertMessage( text, icon );

            });

            const warningModal = () => {

                Swal.fire({
                    icon: 'info',
                    title: '403 - Acceso denegado',
                    text: 'Su usuario no tiene los permisos necesarios.',
                    footer: 'Contacte al administrador',
                    showConfirmButton: false,
                    timer: 3000,
                    allowOutsideClick: false
                })

            }

        </script>

    </body>

</html>
