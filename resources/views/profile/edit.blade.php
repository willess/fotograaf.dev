@extends('layouts.app')

@section('content')

    <div id="headerProfile">
            <h4><a class="active" href="{{ url('/profiel') }}">Profiel</a></h4>
            <h4><a href="{{ url('/header') }}">Header</a></h4>
    </div>

    <div class="contentBoxView">
        <div class="loginRegister">
            <h1>Profielgegevens</h1>
        </div>
    </div>

    <div class="contentBoxView">


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
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                {!! Form::open(['url' => 'profiel/updaten', 'class' => 'form-horizontal' ,'enctype' => 'multipart/form-data', 'method' => 'put']) !!}

                    <div>
                        <div class="form-group">
                            <div class="loginRegister">
                            <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; border-radius:50%; margin-right:25px;">
                                </div>
                        </div>
                    </div>

                <div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Profielfoto</label>
                        <div class="col-md-6">
                            <input id="inputFile" type="file" name="avatar">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>

                    </div>
                </div>

                    {{--<div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label>Update jouw profiel foto</label>--}}
                            {{--<input id="inputFile" type="file" name="avatar">--}}
                            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div>
                        <div class="form-group">
                        {!! Form::label('first_name', 'Voornaam', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-user"></span>
                                    </div>
                                    {!! Form::text('first_name', $user->first_name, array_merge(['class' => 'form-control'])) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                        {!! Form::label('last_name', 'Achternaam', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-user"></span>
                                    </div>
                                    {!! Form::text('last_name', $user->last_name, array_merge(['class' => 'form-control'])) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                        {!! Form::label('city', 'Woonplaats', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-home"></span>
                                    </div>
                                    {!! Form::text('city', $user->city, array_merge(['class' => 'form-control'])) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                        {!! Form::label('username', 'Persoonlijke link: ', ['class' => 'col-md-4 control-label']) !!}
                        <a href="{{ url('/'.$user->username) }}">fotograaf.nl/{{ $user->username }}</a>
                        {{--{!! Form::label('username', 'Gebruikersnaam (Let op, deze tekst komt achter de link te staan!') !!}--}}
                        {{--{!! Form::text('username', $user->username) !!}--}}
                        </div>
                    </div>

                <div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            {!! Form::submit('Profiel opslaan', ['class' => 'btn-lg btn-primary']) !!}
                        </div>
                    </div>
                </div>

        {!! Form::close() !!}

            </div>
        </div>
    </div>


@endsection
