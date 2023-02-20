<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            <input type='hidden' name='logined_checked' value="0" />
                        @else
                            <input type='hidden' name='logined_checked' value="1" />
                            <input type='hidden' name='user_id' value="{{Auth::user()->id}}" />
                            <li><a href="{{ route('home') }}">Dashboard</a></li>
                            <li><a href="{{ route('invite') }}">Invite-User</a></li>
                            <li><a href="{{ route('plan') }}">Plan</a></li>
                            <li><a href="{{ route('billing') }}">Billing</a></li>
                            <li><a href="{{ route('category_manage') }}">Category-Manage</a></li>
                            <!-- <li><a href="{{ route('category') }}">Category</a></li> -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Categories <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu category_menu" role="menu">
                                    
                                </ul>
                            </li>
                            @if (Auth::user()->permission)
                                <li><a href="{{ route('user') }}">User-Manage</a></li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('profile') }}">
                                            Profile
                                        </a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="text-center" style="margin-bottom: 25px;">
            @if(session('info'))
                <span class="alert alert-info">
                    {!! session('info') !!}
                </span>
            @endif
            @if(session('error'))
                <span class="alert alert-danger">
                    {!! session('error') !!}
                </span>
            @endif
        </div>

        @yield('content')
    </div>
    <script>
        var logined_user = $("[name=logined_checked]").val();
        if (logined_user == "1") {
            var user_id = $("[name=user_id]").val();
            $.get(
                "/category_manage/getCategory", {
                    id : user_id
                }, function (res) {
                    var html = "";
                    if (res.length > 0) {
                        for (var i=0;i<res.length;i++) {
                            var url = res[i].category.split(" ");
                            var link = "/cate/"+url.join("-")+"/"+user_id+"/"+res[i].id;
                            html += `<li>
                                <a href="`+link+`">
                                    `+res[i].category+`
                                </a>
                            </li>`;
                        }
                    } else {
                        html += `<li><a href="#">Empty Category</a></li>`;
                    }
                    $(".category_menu").html(html);
                }, "json"
            )
        }
    </script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
