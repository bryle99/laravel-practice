@extends('layouts.app')

@section('content')
    <h3><a href="{{route('posts.create')}}">Create</a></h3>
    <ul>
        @foreach($posts as $post)
            <li><a href="{{route('posts.show', $post->id)}}">{{ $post->title }}</a></li> 
        @endforeach
    </ul>

@endsection

