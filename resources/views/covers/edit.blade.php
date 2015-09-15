@extends('main')

@section('content')
<h1>Editing cover</h1>
{!! Html::image($cover->preview_img_path, "Preview of {$cover->title}") !!}
<p>Changing the image associated with a cover is not permitted. Instead you may delete this cover and upload a new one as desired.</p>

{!! Form::model($cover, ['method' => 'put', 'route' => ['covers.update', $cover->id]]) !!}
    @include('covers.form')
    <div class="form-group">
        <button class="btn btn-primary">Save Cover</button>
    </div>
{!! Form::close() !!}
@endsection