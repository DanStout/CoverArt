{!! Form::openGroup('title', $errors) !!}
{!! Form::label('title', 'Title') !!}
{!! Form::text('title', null, ['class' => 'form-control']) !!}
{!! Form::closeGroup('title', $errors) !!}

{!! Form::openGroup('description', $errors) !!}
{!! Form::label('description', 'Description') !!}
{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
{!! Form::closeGroup('description', $errors) !!}

{!! Form::openGroup('platform_id', $errors) !!}
{!! Form::label('platform_id', 'Platform') !!}
{!! Form::select('platform_id', $platforms, null, ['class' => 'form-control']) !!}
{!! Form::closeGroup('platform_id', $errors) !!}