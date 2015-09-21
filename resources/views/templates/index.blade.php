@extends('main')
@section('title', 'Templates')

@section('content')
    <h1>Templates</h1>


        <div class="item-container">
            @foreach($platforms as $platform)
                <div class="thumbnail item">
                    {!! Html::image($platform->template_preview_path) !!}
                    <p> {{$platform->name}}</p>
                    <p>{!! Html::linkRoute('templates.download', 'Download PSD', [$platform->id]) !!}</p>

                </div>
            @endforeach
        </div>
@endsection
