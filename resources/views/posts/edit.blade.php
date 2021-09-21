@extends('layouts.app')

@section('content')
<a type="button" href="{{route('posts.show', $post->id)}}">back</a>
<h1>Edit</h1>
        {{-- <form method="POST" action="/posts/{{$post->id}}"> --}}
            {{-- <input type="hidden" name="_method" value="PUT"> --}}
            {{-- <input type="text" name="title" placeholder="Enter title" value="{{$post->title}}">
            <input type="submit" value="UPDATE"> --}}
        {{-- </form> --}}
       {!! Form::model($post, ['method' => 'PATCH', 'action' => ['\App\Http\Controllers\PostsController@update', $post->id]]) !!}
            {{ csrf_field() }}
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', $post->title, ['class' => 'form-control']) !!}
            {!! Form::submit('Update Post', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
        <br>
        {{-- <form method="POST" action="/posts/{{$post->id}}"> --}}
            {{-- <input type="hidden" name="_method" value="DELETE"> --}}
            {{-- <input type="submit" value="DELETE">  --}}
        {{-- </form> --}}
        {!! Form::model($post, ['method' => 'DELETE', 'action' => ['\App\Http\Controllers\PostsController@destroy', $post->id]]) !!}
            {{ csrf_field() }}
            {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
@endsection