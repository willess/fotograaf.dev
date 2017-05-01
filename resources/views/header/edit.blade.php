@extends('layouts.app')

@section('content')

    <div id="headerProfile">
        <h4><a href="{{ url('/profiel') }}">Profiel</a></h4>
        <h4><a class="active" href="{{ url('/header') }}">Header</a></h4>
    </div>

    <div class="contentBoxView">
        <div class="loginRegister">
            <h1>Header</h1>
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

                <p>Je hebt een eigen profielpagina met een headerafbeelding, je naam en een inspirerende tekst.</p>

                {!! Form::open(['url' => 'header/updaten', 'class' => 'form-horizontal' ,'enctype' => 'multipart/form-data', 'method' => 'post']) !!}

                    <div>
                        <div class="form-group">
                        {!! Form::label('title', 'Titel header', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-circle-arrow-right"></span>
                                    </div>
                                    {!! Form::text('title', $user->header->title, array_merge(['class' => 'form-control'])) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                        {!! Form::label('text', 'Tekst header', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </div>
                                    {!! Form::text('text', $user->header->text, array_merge(['class' => 'form-control'])) !!}
                                </div>
                            </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Header afbeelding</label>
                            <div class="col-md-6">
                                <input id="inputFile" type="file" name="header">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>

                        </div>
                    </div>

                        <div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    {!! Form::submit('Header opslaan', ['class' => 'btn-lg btn-primary test']) !!}
                                </div>
                            </div>
                        </div>

                {!! Form::close() !!}

                        <div>
                            <div class="form-group">
                                {!! Form::label('', '', ['class' => 'col-md-4 control-label']) !!}
                                <a href="{{ url('/'.$user->username) }}">fotograaf.nl/{{ $user->username }}</a>
                                {{--{!! Form::label('username', 'Gebruikersnaam (Let op, deze tekst komt achter de link te staan!') !!}--}}
                                {{--{!! Form::text('username', $user->username) !!}--}}
                            </div>
                        </div>
            </div>
        </div>

    </div>

    <img id="headerProfile" src="/uploads/headers/{{ $user->header->header }}">

    </div>
</div>
    
@endsection
