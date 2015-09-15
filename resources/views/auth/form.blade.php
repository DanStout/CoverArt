{!! Form::openGroup('display_name', $errors) !!}
{!! Form::label('display_name', 'Display Name') !!}
{!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Billy Bob']) !!}
{!! Form::closeGroup('display_name', $errors, 'Optional, and not required to be unique.') !!}

{!! Form::openGroup('email', $errors) !!}
{!! Form::label('email', 'Email') !!}
{!! Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'Billy@bob.com']) !!}
{!! Form::closeGroup('email', $errors) !!}

{!! Form::openGroup('password', $errors) !!}
{!! Form::label('password', 'Password') !!}
{!! Form::password('password', ['class' => 'form-control', 'required']) !!}
{!! Form::closeGroup('password', $errors) !!}

{!! Form::openGroup('password_confirmation', $errors) !!}
{!! Form::label('password_confirmation', 'Confirm Password') !!}
{!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}
{!! Form::closeGroup('password_confirmation', $errors) !!}