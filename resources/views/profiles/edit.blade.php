@extends('main')

@section('content')
    <h1>Edit your profile</h1>

    {!! Form::model($user, ['route' => ['profiles.update', $user->id], 'method' => 'put', 'autocomplete' => 'off']) !!}
        @include('auth.form')
        <div class="form-group">
            <button class="btn btn-primary">Save Profile</button>
        </div>
    {!! Form::close() !!}

@endsection