@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

            <div class="col-md-8 col-md-offset-2">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))

                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach
                </div>

            </div>

        <div class="col-md-6 col-md-offset-3">
            <h1>
                Zoek naar foto's
            </h1>
            {{--<p class="searchP">Vul een zoekterm in  </p>--}}

            {!! Form::open(['url' => '/','class' => 'form-horizontal', 'method' => 'get']) !!}

                <div>
                    <div class="form-group">
                        <div class="col-xs-8">

                                {!! Form::text('search', null, array('required',
                                                                    'class' => 'form-control searchField',
                                                                    'placeholder'=>'Zoekterm'))
                                !!}
                        </div>
                        <div class="col-xs-2">
                            {!! Form::submit('Zoeken', ['class' => 'btn-lg btn-primary']) !!}
                        </div>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">

        <div class="col-sm-8 col-xs-12">

            <div class="contentBoxView">
                @if($searching)
                    <h1>Zoekresultaten: <u><i>{{ $query }}</i></u></h1>
                @else
                    <h1>Laatste foto's</h1>
                @endif
            </div>
                @if(count($pictures) < 1)

                    <h3>Geen foto's gevonden...</h3>
                @else
                <div id="imageBox" class="row">
                    @foreach($pictures as $picture)

                        <div class="col-xs-12 col- col-sm-6 col-md-6">
                            <a href="{{ url('/image/'. $picture->id) }}">
                                <div class="coverImage"
                                     style="background-image:url('/uploads/thumbnails/{{ $picture->thumbnail->image }}')">
                                    <div class="imageTitle">{{ $picture->title }}</div>
                                </div>

                            </a>
                        </div>
                    @endforeach
                </div>
                {{ $pictures->links() }}
                @endif
        </div>

        <div class="col-sm-4 col-xs-12">
            <div class="contentBoxView">
                <div class="loginRegister">
                    <h1>AFotograaf</h1>
                </div>
            </div>

            <div class="contentBoxView">
                @if (Auth::guest())
                <p>AFotograaf biedt jou de mogelijkheid om jouw mooiste foto's met ieder ander te delen. Je kan gemakkelijk een account <a href="{{ url('/register') }}">aanmaken</a> om vervolgens te beginnen met het toevoegen van je eerste foto!  </p>
                @else

                <p>Bedankt voor het gebruiken van <a href="{{ url('/') }}">Afotograaf.nl</a>. Wij zijn zeer benieuwd naar jouw ervaringen met deze dienst die wordt aangeboden. Wij vragen je om via de <a href="{{ url('/contact') }}">contactpagina</a>  tips en eisen te melden zodat deze website voldoet aan jouw wensen!</p>

                @endif

            </div>
        </div>


    </div>

</div>
@endsection
