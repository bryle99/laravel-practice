@extends('layouts.app')

@section('content')
<a type="button" href="{{route('posts.index')}}">back</a>
<h1>Create</h1>
        {{-- < method="POST" action="/posts"> --}}
       {!! Form::open(['method' => 'POST', 'action' => '\App\Http\Controllers\PostsController@store', 'files' => true]) !!}
       <div class="form-group">
            {{-- <input type="text" name="title" placeholder="Enter title"> --}}
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['placeholder'=> 'Enter Title', 'class' => 'form-control']) !!}
            {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
            {{ csrf_field() }}
            {{-- <input type="submit" name="submit"> --}}
        </div>
        <br>
        <div class="form-group">
            {!! Form::file('file', ['class' => 'form-control']) !!}
        </div>
        {!! Form::close() !!}

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

@endsection