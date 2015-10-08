<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/css/etxevents.css" />
        <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>

        @yield('header')
    </head>
    <body>

        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">ETX Events</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About</a></li>

                        <li class="dropdown">
                            <a href="/#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Events <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach (\App\ETXCategory::all()->sortBy('name') as $cat)
                                    <li><a href="/{{ $cat->slug }}">{{ $cat->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="/#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Directory <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach(\App\ETXTag::all()->sortBy('name') as $tag)
                                    <li><a href="/tag/{{ $tag->slug }}">{{ $tag->name }}</a></li>
                                @endforeach
                             </ul>
                        </li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if (!Auth::user())
                            <li><a href="/auth/login">Login</a></li>
                            <li><a href="/auth/register">Sign Up</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/dashboard">My Account</a></li>
                                    <li><a href="/auth/logout">Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container-fluid">
           @yield('content')
        </div>

    @yield('footer')
    </body>
</html>
