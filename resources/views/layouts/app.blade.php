<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Programium') }}</title>
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" crossorigin="anonymous" />
        <script src="{{asset('js/all.min.js')}}" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="/">{{ config('app.name', 'Programium') }}</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                        @auth
                        <a class="dropdown-item" href="#"><b>{{ auth()->user()->name }}</b></a>
                        @else
                        <a class="dropdown-item" href="{{ route('login') }}"><b>Login</b></a>
                        @endauth
                        <a class="dropdown-item" href="">Configuración</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}">Salir</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="true" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                @auth {{ ucfirst(auth()->user()->role) }} @endauth
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    @auth
                                    @if (auth()->user()->role == 'administrador')
                                    <a class="nav-link" href="{{route('profesores.index')}}">Profesores</a>
                                    <a class="nav-link" href="{{route('cursos.index')}}">Cursos</a>
                                    <a class="nav-link" href="{{route('alumnos.index')}}">Alumnos</a>
                                    <a class="nav-link" href="{{route('materias.index')}}">Materias</a>
                                    @elseif(auth()->user()->role == 'profesor')
                                    <a class="nav-link" href="{{route('cursos.index')}}">Cursos</a>
                                    <a class="nav-link" href="{{route('alumnos.index')}}">Alumnos</a>
                                    <a class="nav-link" href="{{route('materias.index')}}">Materias</a>
                                    @elseif(auth()->user()->role == 'alumno')
                                    <a class="nav-link" href="{{route('cursos.index')}}">Cursos</a>
                                    <a class="nav-link" href="{{route('materias.index')}}">Materias</a>

                                    @endif
                                    @endauth
                                </nav>
                            </div>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        @auth
                        <div class="small">Usuario: {{ auth()->user()->name }}</div>
                          {{ auth()->user()->role }}
                        @endauth
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                @yield('content')

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; {{ config('app.name', 'Programium') }} 2020</div>
                            <div>
                                <a href="#">Politicas & Privacidad</a>
                                &middot;
                                <a href="#">Terminos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="{{asset('js/jquery-3.5.1.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
        <script src="{{asset('js/jquery.dataTables.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('js/dataTables.bootstrap4.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('assets/demo/datatables-demo.js')}}"></script>
        @yield('scripts')

        <script>
            $(document).ready(function(){
                $(document).on('click', '.site_data', function(){

                });


            });
        </script>
    </body>
</html>
