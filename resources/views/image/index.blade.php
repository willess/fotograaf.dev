@extends('layouts.showPictures')

@section('content')

    <div class="container">
        <div class="contentBoxView">
            <div class="loginRegister">
                <h1>Mijn foto's</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))

                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    @foreach($categories as $category)
        <ul class="categoryList">
            <div class="categoryBox">
                <h2 class="categoryTitle"><a href="{{ url('category/'.$category->id.'/edit') }}">{{ $category->name }}</a></h2>
                {{--<h2 class="categoryTitle">{{ $category->name }} <a href="{{ url('category/'.$category->id.'/edit') }}">*</a></h2>--}}
            </div>
            @if(count($category->pictures) == 0)
                <p>Geen foto's aan deze categorie toegevoegd. Deze categorie wordt niet op jouw profielpagina getoond!</p>
            @endif
            <div class="slideshow">
                <div id="{{ $category->name }}" class="images {{ $category->id }}">
                    @foreach($category->pictures as $picture)
                        <li id="imageList">
                                <div class="editImageButton">
                                    <a href="{{ url('/image/'.$picture->id.'/edit') }}">
                                        <h2><span class="glyphicon glyphicon-cog"></span></h2>
                                    </a>
                                </div>
                            <a href="{{ url('/image/'. $picture->id) }}">
                                <img class="image {{ $picture->id }}" src="/uploads/thumbnails/{{ $picture->thumbnail->image }}">

                                {{--<img class="image {{ $picture->id }}" src="/uploads/images/{{ $picture->image }}">--}}
                            </a>
                        </li>
                    @endforeach
                </div>
            </div>
        </ul>
    @endforeach

@endsection
