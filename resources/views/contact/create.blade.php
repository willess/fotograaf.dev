@extends('layouts.app')


@section('content')

    <div class="contentBoxView">
        <div class="loginRegister">
            <h1>Contactpagina</h1>
        </div>
    </div>

    <div class="contentBoxView">
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

            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <p>Wij van <a>Afotograaf.nl</a> zijn zeer benieuwd naar jouw ervaringen met deze website. Zijn er tips of opmerkingen? Zet ze in het tekstveld hieronder en wij proberen er zo snel mogelijk aan te werken. Alle input is welkom, hoe meer hoe beter. Bijvoorbaat dank! En veel succes met het gebruiken van deze website.</p>

                    {!! Form::open(['url' => 'contact', 'class' => 'form-horizontal' , 'method' => 'post']) !!}

                    <div>
                        <div class="form-group">
                            {!! Form::label('name', 'Naam', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-user"></span>
                                    </div>
                                    {!! Form::text('name', Auth::user()->first_name, array_merge(['class' => 'form-control', 'readonly' => 'readonly'])) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            {!! Form::label('text', 'Bericht', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </div>
                                    {!! Form::textarea('text', null, array_merge(['class' => 'form-control'])) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {!! Form::submit('Verzenden', ['class' => 'btn-lg btn-primary']) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
    </div>
@endsection
