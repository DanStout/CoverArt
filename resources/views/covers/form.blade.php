{!! Form::openGroup('title', $errors) !!}
{!! Form::label('title', 'Title') !!}
{!! Form::text('title', null, ['class' => 'form-control']) !!}
{!! Form::closeGroup('title', $errors) !!}

{!! Form::openGroup('description', $errors) !!}
{!! Form::label('description', 'Description') !!}
{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
{!! Form::closeGroup('description', $errors) !!}