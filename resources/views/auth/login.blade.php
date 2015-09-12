@extends('main')

@section('content')

{!! Form::model(['url' => 'auth/login']) !!}

    {!! Form::openGroup('email', $errors) !!}
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    {!! Form::closeGroup('email', $errors) !!}

    {!! Form::openGroup('password', $errors) !!}
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password', ['class' => 'form-control'] ) !!}
    {!! Form::closeGroup('password', $errors ) !!}

    <div class="form-group">
        {!! Form::label('remember', 'Keep me logged in') !!}
        {!! Form::checkbox('remember') !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}
@endsection
