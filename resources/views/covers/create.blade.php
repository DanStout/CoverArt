@extends('main')

@section('content')

    <h1>Upload a new cover</h1>

    {!! Form::open(['url' => 'covers', 'files' => true, 'autocomplete' => 'off']) !!}
        {!! Form::openGroup('category', $errors) !!}
            {!! Form::label('category', 'Category') !!}
            {!! Form::select('category', $categoryNames, null, ['class' => 'form-control']) !!}
        {!! Form::closeGroup('category', $errors) !!}

        {!! Form::openGroup('subcategory', $errors) !!}
            {!! Form::label('subcategory', 'Subcategory') !!}
            {!! Form::select('subcategory', $subcategoryNames, null, ['class' => 'form-control', 'required', 'placeholder' => 'Select a subcategory']) !!}
        {!! Form::closeGroup('subcategory', $errors) !!}

        {!! Form::openGroup('work', $errors) !!}
            {!! Form::label('work', 'Work') !!}
            {!! Form::select('work', [], null, ['class' => 'form-control', 'required', 'placeholder' => 'First select a subcategory']) !!}
        {!! Form::closeGroup('work', $errors) !!}

        {!! Form::openGroup('descrip', $errors) !!}
            {!! Form::label('descrip', 'Description') !!}
            {!! Form::textarea('descrip', null, ['class' => 'form-control']) !!}
        {!! Form::closeGroup('coverImg', $errors) !!}

        {!! Form::openGroup('coverImg', $errors) !!}
            {!! Form::label('coverImg', 'Cover Image') !!}
            {!! Form::file('coverImg', ['required']) !!}
        {!! Form::closeGroup('coverImg', $errors) !!}

        <div class="form-group hidden">
            <button class="btn btn-primary">Upload Cover</button>
        </div>

    {!! Form::close() !!}
@endsection

@section('scripts')
    <script>
    var $catSel = $('select[name="subcategory"]');
    $catSel.on('change', function(){
//        $.ajax({
//            url: '/covers/subcategories',
//            type: 'GET',
//            data:{subcategoryId: this.value}
//        })
//        .done(function(data, status, req){console.log('success: ', data)})
//        .fail(function(req, status, err){console.log(req, status, err)});

    });

    </script>
@endsection