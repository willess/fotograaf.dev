@extends('layouts.app')

@section('content')

    <div class="contentBoxView">
        <div class="loginRegister">
            <h1>Wijzig categorie: {{ $category->name }}</h1>
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

        @if(isset($categoryError))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ $categoryError }}</li>
                </ul>
                </div>
        @endif

            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    {!! Form::open(['url' => 'category/update', 'class' => 'form-horizontal', 'method' => 'put']) !!}

                        <input type="hidden" value="{{ $category->id }}" name="id">

                        <div>
                            <div class="form-group">
                                {!! Form::label('category', 'Categorie', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th-list"></span>
                                        </div>
                                        {!! Form::text('category', $category->name, array_merge(['class' => 'form-control'])) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {!! Form::submit('Wijzig categorie', ['class' => 'btn-lg btn-primary']) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                    <div>
                        <p>Er horen {{ count($categoryCount->pictures) }} foto's bij deze categorie. Terug naar <a href="{{ url('/image') }}">Mijn foto's!</a></p>
                    </div>

                    {{--{{ count($categoryCount->pictures) }}--}}

                    {{--@if($categoryCount->pictures > 0)--}}
                        {{--Dikke test--}}
                    {{--@endif--}}

                    {{--@foreach($categories as $category)--}}
                        {{--@if(count($category->pictures) > 0)--}}
                            {{--test--}}
                        {{--@endif--}}
                        {{--{{ $category }}--}}

                    {{--@endforeach--}}

                    @if(count($categoryCount->pictures) <= 0)
                    <div>
                        {!! Form::open(['url' => 'category/'.$category->id, 'class' => 'deleteImageButton', 'method' => 'delete', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Verwijderen', ['class' => 'btn-lg btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>

                    @else

                        <div class="deleteImageButton">
                            <button disabled="disabled" class="btn-lg btn-danger">Verwijderen</button>
                        </div>
                        <div class="deleteImageButton">
                            <p>Verwijder of verplaats eerst alle foto's uit deze categorie voordat je de categorie kan verwijderen *</p>

                        </div>


                    @endif

                </div>
            </div>



    </div>
@endsection
