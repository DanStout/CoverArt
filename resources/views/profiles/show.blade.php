@extends('main')
@section('title', $user->name)

@section('content')
    <h1>{{$user->name}}</h1>

    <dl class="dl-horizontal">
        <dt>Display name</dt>
            <dd>{{$user->display_name}}</dd>
        <dt>Email</dt>
            <dd>{{$user->email}}</dd>
        <dt>Covers Uploaded</dt>
            <dd>{{$coverCount}}</dd>
        <dt>Joined at</dt>
            <dd>{{$user->created_at}}</dd>
    </dl>

    @if($user->isCurrent())
        {!! Html::linkRoute('profiles.edit', 'Edit your profile', [$user->id]) !!}
    @endif
@endsection