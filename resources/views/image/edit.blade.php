@extends('layouts.app')

@section('content')


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

    <div id="imageBox">
        <img id="showImage" src="{{ url('/uploads/images/'.$image->image) }}" />
    </div>

    <div class="contentBoxView">
        <div class="loginRegister">
            <h1>Wijzig deze foto</h1>
        </div>
    </div>

    <div class="contentBoxView">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                {!! Form::open(['url' => 'image/update', 'class' => 'form-horizontal', 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}

                    <div>
                        <input type="hidden" name="id" value="{{ $image->id }}" />
                    </div>

                    <div>
                        <div class="form-group">
                        {!! Form::label('title', 'Titel van de foto', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-circle-arrow-right"></span>
                                    </div>
                                    {!! Form::text('title', $image->title, array_merge(['class' => 'form-control'])) !!}
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
                                    {!! Form::text('location', $image->location, array_merge(['class' => 'form-control'])) !!}
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
                                    {!! Form::textarea('subscription', $image->subscription, array_merge(['class' => 'form-control'])) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                        {!! Form::label('category', 'Categorie *', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th-list"></span>
                                    </div>
                                    <input class="form-control" list="categories" name="category" value="{{ $category->name }}">
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
                        <p>* Om uit jouw lijst met categorien te kiezen moet je de huidige categorie weghalen! Ook kan je een nieuwe categorie aanmaken. </p>
                    </div>

                    {{--<div>--}}
                        {{--<div class="form-group">--}}
                        {{--{!! Form::label('tags', 'Tags', ['class' => 'col-md-4 control-label']) !!}--}}
                            {{--<div class="col-md-6">--}}
                            {{--{!! Form::text('tags', null, ['id' => 'tags', 'class' => 'form-control']) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<p>** Type een tag gevolgd bij een 'Enter' om de volgende te kunnen typen!</p>--}}
                    {{--</div>--}}

                <div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            {!! Form::submit('Opslaan', ['class' => 'btn-lg btn-primary']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}


                <div>
                    {!! Form::open(['url' => 'image/'.$image->id, 'class' => 'deleteImageButton', 'method' => 'delete', 'enctype' => 'multipart/form-data']) !!}
                    {!! Form::submit('Verwijder deze foto', ['class' => 'btn-lg btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
                {{--<a href="{{ url('/image') }}"><button class="btn-lg btn-default">Annuleren</button></a>--}}


            </div>
        </div>

    </div>



@endsection
