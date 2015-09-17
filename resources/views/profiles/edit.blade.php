@extends('main')
@section('title', 'Edit Profile')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Edit your profile</h1>
        </div>
        <div class="panel-body">
            {!! Form::model($user, ['route' => ['profiles.update', $user->id], 'method' => 'put', 'autocomplete' => 'off']) !!}
                @include('auth.form')
                <div class="form-group">
                    <button class="btn btn-primary">Save Profile</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection