@extends('layouts.app')

@section('content')
    <a type="button" href="{{route('posts.index')}}">back</a>
    <div class="image-container">
        <img height="300" src="{{$post->path}}" alt="">
    </div>
    <h1> {{ $post->title }} </h1>
   <a type="button" href="{{route('posts.edit', $post->id)}}">edit</a>
@endsection