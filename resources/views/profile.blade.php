<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AFotograaf</title>

    {{--Fonts--}}
    <link href="https://fonts.googleapis.com/css?family=Karla|Libre+Baskerville" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <style>
        .header {
            background: /* top, transparent red, faked with gradient */ linear-gradient(
                    rgba(0, 0, 0, 0),
                    rgb(0, 0, 0)
            ),
                /* bottom, image */ url('/uploads/headers/{{ $user->header->header }}') no-repeat bottom center scroll;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }
    </style>
</head>
<body>

    <div id="loading">
        <div id="loadingImage"></div>
    </div>


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
                    Fotoprofiel
                </a>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <p class="navbar-btn">
                            <a href="{{ url('/image/create') }}" class="btn btn-primary">Plaats Foto  <span class="glyphicon glyphicon-plus-sign"></span></a>
                        </p>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li>
                            <a href="{{ url('/login') }}">Inloggen</a>
                        </li>
                        <li>
                            <p class="navbar-btn">
                                <a href="{{ url('/register') }}" class="btn btn-primary">Registreren</a>
                            </p>
                        </li>
                    @else
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position: relative; padding-left: 50px">
                                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width: 32px; height: 32px; position: absolute; top: 10px; left: 10px; border-radius: 50%">
                                {{ Auth::user()->first_name }} <span class="caret"></span>
                            </a>


                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/profiel') }}"><i class="fa fa-btn fa-user"></i>Profiel</a>
                                </li>
                                <li>
                                    <a href="{{ url('/'.Auth::user()->username) }}">Mijn pagina</a>
                                </li>
                                <li>
                                    <a href="{{ url('/image') }}"><i class="fa fa-btn fa-user"></i>Mijn foto's</a>
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Uitloggen
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

        <header class="header">
            <div class="header-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="header-text">
                                {{--<img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; border-radius:50%; border: 3px solid black">--}}
                                <h1 class="brand-heading">{{ $user->header->title }}</h1>
                                <p class="header-text">{{ $user->header->text }}</p>
                                @if(count($categories) > 0)
                                    <a href="#afbeeldingen" class="btn btn-circle page-scroll">
                                        <i class="fa fa-angle-double-down animated">Naar foto's</i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </header>
    {{--<div id="container" class="container">--}}
    <div id="container">

        @if(count($categories) > 0)
            {{--<div>--}}
                {{--<a href="#">--}}
                    {{--<button class="btn btn-default active">Laatste foto's</button>--}}
                {{--</a>--}}
                {{--<a href="#">--}}
                    {{--<button class="btn btn-primary active">Foto's per categorie</button>--}}
                {{--</a>--}}
            {{--</div>--}}

        <div id="afbeeldingen">
            @foreach($categories as $category)
                @if(count($category->pictures) > 0)
                <ul class="categoryList">
                    <h2 class="categoryTitle">{{ $category->name }}</h2>
                    <div class="slideshow">
                        <div id="{{ $category->name }}" class="images {{ $category->id }}">
                            @foreach($category->pictures as $picture)
                                <li id="imageList">
                                    <a href="{{ url('/image/'. $picture->id) }}">
                                        <img class="image {{ $picture->id }}" src="/uploads/thumbnails/{{ $picture->thumbnail->image }}">
                                    </a>
                                </li>
                            @endforeach
                        </div>
                    </div>
                </ul>
                @endif
            @endforeach
        </div>
            @else

            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2>{{ $user->first_name }} heeft helaas nog geen foto's toegevoegd!</h2>

                    </div>
                </div>
            </div>

        @endif
    </div>

<script>
    window.addEventListener('load', init);

    function init() {
        setTimeout(show, 750);
    }

    function show() {
        $('#loading').hide();
        $('#container').fadeIn();
        loadImages();
    }
    function loadImages(){


        {{--document.getElementsByClassName("header")[0].style.background = 'url(/uploads/' + {{ $user->header->header }} + ')';--}}

                @foreach($categories as $category)
            var width = 0;

                @foreach($category->pictures as $picture)
                    var imageWidth = document.getElementsByClassName({{ $picture->id }})[0].clientWidth;
        width = width + imageWidth + 4;
                @endforeach

                var d = document.getElementById("{{ $category->name }}").clientWidth;

        var a = document.getElementById("{{ $category->name }}").style.width = (width) + "px";

        @endforeach
        }

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<!-- Scripts -->
<script src="/js/app.js"></script>
<script src="/js/main.js"></script>

</body>
</html>



