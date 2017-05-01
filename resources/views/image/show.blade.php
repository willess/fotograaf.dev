@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

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

        <div class="contentBoxView">
            <div>
                <h2>{{ $image->title }}</h2>
                <p class="imageInfo">Fotomaker: <a href="{{ url('/'.$user->username) }}">{{ $user->username }}</a></p>
                <p class="imageInfo">Locatie: {{ $image->location }}</p>
                <p class="imageInfo">Omschrijving: {{ $image->subscription }}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8">
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

                <h1>Reageer</h1>
                {{--@if (Auth::guest())--}}
                    {{--<p>  <a href="{{ url('/login') }}">Log in</a> om te reageren op deze foto!</p>--}}
                {{--@else--}}

                    {!! Form::open(['url' => 'parentcomment','class' => 'form-horizontal', 'method' => 'post']) !!}

                    <input type="hidden" value="{{ $image->id }}" name="id">

                    <div>
                        <div class="form-group">
                            {{--{!! Form::label('subscription', 'Reactie', ['class' => 'col-md-4 control-label']) !!}--}}
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </div>
                                    {!! Form::textarea('reaction', null, array_merge(['class' => 'form-control'])) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <div class="col-md-8">
                                {!! Form::submit('Verstuur', ['class' => 'btn-lg btn-primary']) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                {{--@endif--}}

                <hr />

                <h1>Reacties</h1>

                @if(count($reactions) > 0)

                <ul>
                    @foreach($reactions as $reaction)
                        <hr />

                        {{--<li>--}}
                            <p> <a href="{{ url('/'.$reaction->username) }}">{{ $reaction->username }}</a> - <span class="commentDate">{{ $reaction->created_at }}</span></p>
                            <p>{{ $reaction->reaction }}</p>


                            @if(Auth::user())
                                @if(Auth::user()->username == $reaction->username)
                                    <a>Wijzig</a> - <a>Verwijder</a>
                                @endif
                            @endif
                        {{--</li>--}}

                    @endforeach
                </ul>

                @else

                    <p>Deze foto heeft nog geen reactie</p>

                @endif



            </div>
        </div>

        {{--<div class="col-sm-8">--}}
            {{--<div class="contentBoxView">--}}
                {{--<h1>Reacties</h1>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-sm-4">
            <div class="contentBoxView">
                <h1>Bekijk ook</h1>

                @foreach($photos as $photo)

                    <a href="{{ url('/image/'. $photo->id) }}">
                        <div class="imageBox2"
                             style="background-image:url('/uploads/thumbnails/{{ $photo->thumbnail->image }}')">
                        </div>
                    </a>


                    {{--<a href="{{ url('/image/'.$photo->id) }}">--}}
                        {{--<img class="imageBox" src="/uploads/images/{{ $photo->image }}">--}}
                    {{--</a>--}}

                @endforeach
            </div>
        </div>
    </div>


@endsection
