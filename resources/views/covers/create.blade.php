@extends('main')

@section('title', 'New Cover')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading"><h1>Upload a new cover</h1></div>
        <div class="panel-body">
            {!! Form::model($cover = new Coverart\Cover(), ['route' => 'covers.store', 'files' => true]) !!}

                @include('covers.form')

                {!! Form::openGroup('cover', $errors, 'fallback') !!}
                    {!! Form::label('cover', 'Cover Image') !!}
                    {!! Form::file('cover', ['required']) !!}
                {!! Form::closeGroup('cover', $errors) !!}

                <div class="form-group">
                    <button class="btn btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> <span>Upload Cover</span></button>
                    <div class="help-block"></div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('button').prop('disabled', false);
        $('form').on('submit', function(event) {
            $(this)
                .find('button').prop('disabled', true)
                    .find('span')
                        .first().addClass('glyphicon-refresh gly-spin').removeClass('glyphicon-cloud-upload').end()
                        .last().text('Uploading...').end()
                    .end()
                .next().text('Uploading cover and generating preview. This may take a few seconds');
        });
    </script>
@endsection