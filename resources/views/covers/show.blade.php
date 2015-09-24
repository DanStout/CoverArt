@extends('main')
@section('title', $cover->title)

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
        @if(Auth::check() && $cover->user_id === Auth::id())
            {!! Form::open(['route' => ['covers.destroy', $cover->id], 'method' => 'delete', 'class' => 'form-inline']) !!}
            <div class="btn-group role=group">
                {!! Html::linkRoute('covers.edit', 'Edit Cover', $cover->id, ['class' => 'btn btn-info']) !!}
                {!! Form::submit('Delete Cover', ['class' => 'btn btn-danger'] ) !!}
            </div>
            {!! Form::close() !!}
        @endif
    </div>
    <p>{{$cover->description}}</p>
    <p>Platform: {{$cover->platform->name}}</p>
    <p>Created {!! Html::time($cover->created_at) !!}</p>
    <p>Last Updated {!! Html::time($cover->updated_at) !!}</p>
    <p>Uploaded by {!! Html::linkRoute('profiles.show', $cover->user->name, $cover->user->id) !!}</p>
    {!! Html::linkAsset($cover->full_img_path, 'View Printable Version', ['target' => '_blank']) !!}

@endsection
