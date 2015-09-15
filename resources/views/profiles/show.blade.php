@extends('main')

@section('content')
    <h1>Showing profile of: {{$user->name}}</h1>
    <p>They've uploaded {{$coverCount}} covers.</p>
    @if(Auth::id() === $user->id)
        {!! Html::linkRoute('profiles.edit', 'Edit your profile', [$user->id]) !!}
    @endif
@endsection