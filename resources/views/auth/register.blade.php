@extends('main')

@section('content')
{!! Form::model(['url' => 'auth/register']) !!}

    {!! Form::openGroup('email', $errors) !!}
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    {!! Form::closeGroup('email', $errors) !!}

    {!! Form::openGroup('password', $errors) !!}
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    {!! Form::closeGroup('password', $errors) !!}

    {!! Form::openGroup('password_confirmation', $errors) !!}
        {!! Form::label('password_confirmation', 'Confirm Password') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    {!! Form::closeGroup('password_confirmation', $errors) !!}

    <div class="form-group">
        <button class="btn btn-primary">Register</button>
    </div>

{!! Form::close() !!}
@endsection
