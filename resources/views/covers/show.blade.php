@extends('main')

@section('content')
    <style>
        .hero
        {
            text-align:center;
        }
    </style>

    <div class="hero">
        <h1>{{$cover->title}}</h1>
        {!! Html::image($cover->large_preview_img_path, "Preview of {$cover->title}") !!}
    </div>
    <p>{{$cover->description}}</p>
    <p>Platform: {{$cover->platform->name}}</p>
    <p>Created at: {{$cover->created_at}}</p>
    {!! Html::linkAsset($cover->full_img_path, 'View Printable Version', ['target' => '_blank']) !!}
@if(Auth::check() && $cover->user_id === Auth::user()->id)
    {!! Form::open(['route' => ['covers.destroy', $cover->id], 'method' => 'delete', 'class' => 'form-inline']) !!}
        {!! Html::linkRoute('covers.edit', 'Edit Cover', $cover->id, ['class' => 'btn btn-info']) !!}
        {!! Form::submit('Delete Cover', ['class' => 'btn btn-danger'] ) !!}
    {!! Form::close() !!}
@endif
@endsection
