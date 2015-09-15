@extends('main')

@section('content')
<style>
    .item
    {
        width:210px;
        display:inline-block;
        text-align:center;
    }

    .item-container
    {
        text-align:center;
    }
</style>

<h1>Covers</h1>
    <div class="item-container">
        @foreach($covers as $cover)
            <div class="item">
                <h4>{!! Html::linkRoute('covers.show', $cover->title, [$cover->id]) !!}</h4>
                {!! Html::image($cover->preview_img_path, "Preview of {$cover->title}") !!}
                <p>Uploaded by {!! Html::linkRoute('profiles.show', $cover->user->name, $cover->user->id) !!}
            </div>
        @endforeach
    </div>

@endsection