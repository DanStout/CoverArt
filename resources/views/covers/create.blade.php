@extends('main')

@section('content')

    <h1>Upload a new cover</h1>

    {!! Form::model($cover = new Coverart\Cover(), ['url' => 'covers', 'files' => true]) !!}

        {!! Form::openGroup('title', $errors) !!}
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        {!! Form::closeGroup('title', $errors) !!}

        {!! Form::openGroup('description', $errors) !!}
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        {!! Form::closeGroup('description', $errors) !!}

        {!! Form::openGroup('cover', $errors) !!}
            {!! Form::label('cover', 'Cover Image') !!}
            {!! Form::file('cover', ['required']) !!}
        {!! Form::closeGroup('cover', $errors) !!}

        <div class="form-group">
            <button class="btn btn-primary">Upload Cover</button>
        </div>

    {!! Form::close() !!}
@endsection