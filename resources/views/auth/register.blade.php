@extends('main')
@section('title', 'Register')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Create an account</h1>
        </div>
        <div class="panel-body">
            {!! Form::open(['url' => 'auth/register',  'autocomplete' => 'off']) !!}
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

                <div class="form-group">
                    <button class="btn btn-primary">Register</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
<script>
    var $emailInput = $('#email');
    var $emailHelp = $emailInput.next();

    $emailInput.on('blur', function() {
        var emailVal = $emailInput.val();
        if (emailVal)
        {
            $.getJSON('/auth/check/'+emailVal, function(data)
            {
                if (data.exists)
                {
                    $emailHelp.text('This email is already registered. Do you already have an account?')
                    $emailHelp.parent().addClass('has-error').removeClass('has-success');
                }
                else if (!$emailHelp.val())
                {

                    $emailHelp.text('');
                    $emailHelp.parent().removeClass('has-error');
                }

            });
        }
    });


</script>
@endsection