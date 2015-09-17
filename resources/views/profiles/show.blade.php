@extends('main')
@section('title', $user->name)

@section('content')
    <h1>{{$user->name}}</h1>

    <dl class="dl-horizontal">
        <dt>Covers Uploaded</dt>
        <dd>{{$coverCount}}</dd>
        <dt>Joined at</dt>
        <dd>{{$user->created_at}}</dd>
    </dl>

    @if(Auth::id() === $user->id)
        {!! Html::linkRoute('profiles.edit', 'Edit your profile', [$user->id]) !!}
    @endif
@endsection