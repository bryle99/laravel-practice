@extends('layouts.app')

@section('content')
    <a type="button" href="{{route('posts.index')}}">back</a>
   <h1> {{ $post->title }} </h1>
   <a type="button" href="{{route('posts.edit', $post->id)}}">edit</a>
@endsection