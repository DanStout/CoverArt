@extends('main')

@section('content')
<h1>Covers</h1>
    @foreach($covers as $cover)
        <h3>{{ $cover->title }}</h3>
        <p>{{ $cover->description }}</p>
        <img width="500" src="{!! $cover->img_path!!}">
        <hr />
    @endforeach
@endsection