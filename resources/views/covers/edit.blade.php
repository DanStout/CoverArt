@extends('main')
@section('title', 'Edit Cover')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Editing existing cover</h1>
        </div>
        <div class="panel-body">
            {!! Html::image($cover->large_preview_img_path, "Preview of {$cover->title}") !!}
            <p>Changing the image associated with a cover is not permitted. Instead you may delete this cover and upload a new one as desired.</p>
            {!! Form::model($cover, ['method' => 'put', 'route' => ['covers.update', $cover->id]]) !!}
            @include('covers.form')
            <div class="form-group">
                <button class="btn btn-primary">Save Cover</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection