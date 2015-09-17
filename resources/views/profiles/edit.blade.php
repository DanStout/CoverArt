@extends('main')
@section('title', 'Edit Profile')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Edit your profile</h1>
        </div>
        <div class="panel-body">
            {!! Form::model($user, ['route' => ['profiles.update', $user->id], 'method' => 'put', 'autocomplete' => 'off']) !!}

                {!! Form::openGroup('display_name', $errors) !!}
                {!! Form::label('display_name', 'Display Name') !!}
                {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Billy Bob']) !!}
                {!! Form::closeGroup('display_name', $errors, 'Optional, and not required to be unique.') !!}

                {!! Form::openGroup('email', $errors) !!}
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Billy@bob.com']) !!}
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
                    <button class="btn btn-primary">Save Profile</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection