@extends('main')
@section('title', $user->name)

@section('content')
    <p><strong>{{ $user->name }}</strong> has uploaded {{ $covers->total() }} covers since joining {!! Html::time($user->created_at) !!}</p>

    @if($user->isCurrent())
        {!! Html::linkRoute('profiles.edit', 'Edit your profile', [$user->id], ['class' => 'btn btn-info']) !!}
    @endif

    <h1>Covers uploaded</h1>
    @include('covers.list')
@endsection