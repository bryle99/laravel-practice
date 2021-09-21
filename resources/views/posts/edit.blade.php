@extends('layouts.app')

@section('content')
<a type="button" href="{{route('posts.show', $post->id)}}">back</a>
<h1>Edit</h1>
        <form method="POST" action="/posts/{{$post->id}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <input type="text" name="title" placeholder="Enter title" value="{{$post->title}}">
            <input type="submit" value="UPDATE">
        </form>
        <br>
        <form method="POST" action="/posts/{{$post->id}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" value="DELETE"> 
        </form>
@endsection