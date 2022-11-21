<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'sudip.me') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datetimepicker/jquery.datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fancybox-3.0/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/styles.css') }}">
    @stack('styles')
</head>

<body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="" class="logo">
                <span class="logo-mini">
                    {{ config('app.name', 'Laravel') }}
                </span>
                <span class="logo-lg">
                    {{ config('app.name', 'Laravel') }}
                </span>
            </a>

            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <span class="project-name-header"></span>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('admin-assets/images/avatar.png') }}" alt="avatar"
                                    class="user-image">
                                <span class="hidden-xs">
                                    {{ Auth::user()->name }}
                                </span>
                            </a>

                            <ul class="dropdown-menu">

                                <li class="user-header">
                                    <img src="{{ asset('admin-assets/images/avatar.png') }}" alt="avatar"
                                        class="img-circle">
                                    <p>
                                        {{ Auth::user()->name }}
                                        <small>
                                            {{ Auth::user()->mobile }}<br>
                                            {{ Auth::user()->email }}
                                        </small>
                                    </p>
                                </li>

                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a class="btn btn-custom btn-flat" href="{{ route('profile') }}">My Account</a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-custom btn-flat" href="{{ route('admin.logout') }}">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" class="non-validate" action="{{ route('admin.logout') }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="">
                        <a href="">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="">
                            <i class="fa fa-solid fa-address-card"></i>
                            <span>Contacts</span>
                        </a>
                    </li>

                    {{-- <li class="{{ Request::routeIs('products.*') ? 'active' : '' }}">
                        <a href="{{ route('products.index') }}">
                            <i class="fa fa-folder-open-o"></i>
                            <span>Products</span>
                        </a>
                    </li> --}}

                    {{-- <li class="{{ Request::routeIs('categories.*') ? 'active' : '' }}">
                        <a href="{{ route('categories.index') }}">
                            <i class="fa fa-folder"></i>
                            <span>Categories</span>
                        </a>
                    </li> --}}

                    <li class="">
                        <a href="">
                            <i class="fa fa-newspaper-o"></i>
                            <span>Blogs</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="">
                            <i class="fa fa-newspaper-o"></i>
                            <span>Testimonial</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="">
                            <i class="fa fa-newspaper-o"></i>
                            <span>Company profile</span>
                        </a>
                    </li>

                    {{-- <li class="{{ Request::routeIs('galleries.*') ? 'active' : '' }}">
                        <a href="{{ route('galleries.index') }}">
                            <i class="fa fa-file-image-o"></i>
                            <span>Galleries</span>
                        </a>
                    </li> --}}

                    {{-- <li class="{{ Request::routeIs('slides.*') ? 'active' : '' }}">
                        <a href="{{ route('slides.index') }}">
                            <i class="fa fa-picture-o"></i>
                            <span>Slides</span>
                        </a>
                    </li> --}}

                    <li class="{{ Request::routeIs('users.*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>

                </ul>
            </section>
        </aside>

        <div class="content-wrapper">
            @if (session('successMessage'))
                <section class="content-header">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        {{ session('successMessage') }}
                    </div>
                </section>
            @endif

            @if (session('errorMessage'))
                <section class="content-header">
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        {{ session('errorMessage') }}
                    </div>
                </section>
            @endif

            @yield('content')
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                Developed by <a href="https://oshnisoftware.com" target="_blank">Oshni Software</a>
            </div>
            <strong>
                Copyright &copy; {{ date('Y') }} {{ config('app.name', 'sudip.me') }}.
            </strong> All rights reserved.
        </footer>
    </div>

    <script>
        var base_url = '{{ url('') }}';
    </script>
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/fancybox-3.0/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/app.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
