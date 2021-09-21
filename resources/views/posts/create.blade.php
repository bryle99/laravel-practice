@extends('layouts.app')

@section('content')
<a type="button" href="{{route('posts.index')}}">back</a>
<h1>Create</h1>
        <form method="POST" action="/posts">
            <input type="text" name="title" placeholder="Enter title">
            {{ csrf_field() }}
            <input type="submit" name="submit">
        </form>
@endsection