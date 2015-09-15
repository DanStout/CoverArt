@extends('main')

@section('content')
    <h1>{{$cover->title}}</h1>
    {!! Html::image($cover->preview_img_path, "Preview of {$cover->title}") !!}
    <p>{{$cover->description}}</p>
    <p>Created at: {{$cover->created_at}}</p>
    {!! Html::linkAsset($cover->full_img_path, 'View Printable Version', ['target' => '_blank']) !!}
@if(Auth::check() && $cover->user_id === Auth::user()->id)
    {!! Form::open(['route' => ['covers.destroy', $cover->id], 'method' => 'delete', 'class' => 'form-inline']) !!}
        {!! Html::linkRoute('covers.edit', 'Edit Cover', $cover->id, ['class' => 'btn btn-info']) !!}
        {!! Form::submit('Delete Cover', ['class' => 'btn btn-danger'] ) !!}
    {!! Form::close() !!}
@endif
@endsection
