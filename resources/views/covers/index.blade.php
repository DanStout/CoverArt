@extends('main')
@section('title', 'Covers')

@section('content')

@if(Auth::guest())
    <div class="jumbotron">
        <h1>Welcome to CoverArt.com</h1>
        <h2>Custom cover art for videogames and other media in standard formats with beautiful previews</h2>
        <p>Just click on a cover you like to view a larger preview and get a link to the full printable cover</p>
        <p>For cover creators:</p>
        <ol>
            <li>Download one of our {!! Html::linkRoute('templates.index', 'PSD templates') !!}</li>
            <li>Create a custom cover</li>
            <li>Upload your cover, and we'll generate a 3D preview for you</li>
        </ol>

    </div>
@endif

<h1>Covers</h1>
    <div class="item-container">
        @foreach($covers as $cover)
            <div class="thumbnail item">
                    <a href={!! route('covers.show', [$cover->id]) !!}>
                        {!! Html::image($cover->small_preview_img_path, "Preview of {$cover->title}") !!}
                        <h4>{{$cover->title}}</h4>
                    </a>
                    <p>Uploaded by {!! Html::linkRoute('profiles.show', $cover->user->name, $cover->user->id) !!}
                    <p>Platform: {{$cover->platform->name}}</p>

            </div>
        @endforeach
    </div>
    <div class="pagination-container">
        {!! $covers->render() !!}
    </div>

@endsection