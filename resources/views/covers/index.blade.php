@extends('main')

@section('content')
<style>
    .item
    {
        width:310px;
        display:inline-block;
        text-align:center;
    }

    .item-container
    {
        text-align:center;
        vertical-align:middle;
    }
</style>

<h1>Covers</h1>
    <div class="item-container">
        @foreach($covers as $cover)
            <div class="item">
                <h4>{!! Html::linkRoute('covers.show', $cover->title, [$cover->id]) !!}</h4>
                {!! Html::image($cover->small_preview_img_path, "Preview of {$cover->title}") !!}
                <p>Uploaded by {!! Html::linkRoute('profiles.show', $cover->user->name, $cover->user->id) !!}
                <p>Platform: {{$cover->platform->name}}</p>
            </div>
        @endforeach
    </div>

@endsection