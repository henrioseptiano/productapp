<!DOCTYPE HTML>
<html>
<head>
    <title>App Name - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Product App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @if(Session::has('role') && Session::get('role') == "Administrator")
                <li class="nav-item active">
                    <a class="nav-link" href="/addproduct">Add Product</a>
                </li>
                @endif
                <!--<li class="nav-item">
                    <a class="nav-link" href="#">Manage Product Brand</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Manage User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Manage Role</a>
                </li>-->
            </ul>
            <ul class="navbar-nav">

                @if(Session::has("username"))
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome, {{session()->get('username')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logoutprocess">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                @endif

            </ul>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vue.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vue-resource.min.js') }}"></script>
    @stack('scripts')
</body>
</html>