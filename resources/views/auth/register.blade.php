@extends('main')

@section('content')
{!! Form::open(['url' => 'auth/register',  'autocomplete' => 'off']) !!}
    @include('auth.form')
    <div class="form-group">
        <button class="btn btn-primary">Register</button>
    </div>
{!! Form::close() !!}
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