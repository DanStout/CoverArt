@extends('main')

@section('content')

    <h1>Upload a new cover</h1>

    {!! Form::model($cover = new Coverart\Cover(), ['route' => 'covers.store', 'files' => true, 'class' => 'dropzone', 'id' => 'cover-create-form']) !!}

        @include('covers.form')

        {!! Form::openGroup('cover', $errors, 'fallback') !!}
            {!! Form::label('cover', 'Cover Image') !!}
            {!! Form::file('cover', ['required']) !!}
        {!! Form::closeGroup('cover', $errors) !!}

        <div class="form-group">
            <button class="btn btn-primary">Upload Cover</button>
        </div>

    {!! Form::close() !!}
@endsection
