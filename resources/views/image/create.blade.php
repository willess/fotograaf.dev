@extends('layouts.app')

@section('content')

    <div class="contentBoxView">
        <div class="loginRegister">
            <h1>Voeg een nieuwe foto toe</h1>
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

                {!! Form::open(['url' => 'image','class' => 'form-horizontal', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

                    <div id="addImage">
                        <div class="form-group">
                            {!! Form::label('image', 'Voeg afbeelding toe', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::file('image', array_merge(['id' => 'inputFile'])) !!}
                            </div>
                        </div>
                        {{--<input type="file" name="image">--}}
                        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                    </div>

                    <div>
                        <div class="form-group">
                            {!! Form::label('title', 'Titel van de foto', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-circle-arrow-right"></span>
                                    </div>
                                    {!! Form::text('title', null, array_merge(['class' => 'form-control'])) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            {!! Form::label('location', 'Locatie van de foto', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-map-marker"></span>
                                    </div>
                                    {!! Form::text('location', null, array_merge(['class' => 'form-control'])) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            {!! Form::label('subscription', 'Omschrijving van de foto', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </div>
                                    {!! Form::textarea('subscription', null, array_merge(['class' => 'form-control'])) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                    </div>

                    <div>
                        <div class="form-group">
                            {!! Form::label('category', 'Categorie*', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th-list"></span>
                                    </div>
                                    <input class="form-control" list="categories" name="category">
                                    <datalist id="categories">
                                        @if(count($categories) > 0)
                                            @foreach($categories as $category)

                                                <option value="{{ $category->name }}"></option>

                                            @endforeach
                                        @endif
                                        {{--<option value="overige">--}}
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <p>* Kies uit de lijst met jouw categorieen. Wil je een nieuwe toevoegen, kan je deze in het veld typen! </p>
                    </div>

                    {{--<div>--}}
                        {{--<div class="form-group">--}}
                            {{--{!! Form::label('tags', 'Tags**', ['class' => 'col-md-4 control-label']) !!}--}}
                            {{--<div class="col-md-6">--}}
                                {{--{!! Form::text('tags', null, array_merge([ 'class' => 'form-control', 'id' => 'tags'])) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<p>** Type een tag gevolgd bij een 'Enter' om de volgende te kunnen typen!</p>--}}
                    {{--</div>--}}

                <div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            {!! Form::submit('Voeg afbeelding toe', ['class' => 'btn-lg btn-primary']) !!}
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection
