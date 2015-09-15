@extends('main')

@section('content')
{!! Form::model(['url' => 'auth/register']) !!}
    @include('auth.form');
    <div class="form-group">
        <button class="btn btn-primary">Register</button>
    </div>
{!! Form::close() !!}
@endsection
