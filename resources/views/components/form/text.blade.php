{{Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes))}}

@if ($errors->has($name))
    <div class="invalid-feedback">{{ $errors->first($name)}}</div>
@endif
