@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">{{ __('status.Statuses') }}</h1>
    <div class="row">
        <div class="col">
            {{ Form::model($taskStatus, ['url' => route('task_statuses.store'), 'class' => 'w-50']) }}
        <div class="form-group">
        {{ Form::label('name', __('status.Status name')) }}
        {{ Form::text('name', null, ['class' => $errors->any() ? 'form-control is-invalid' : 'form-control']) }}
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
       </div>
       <div class="form-row">
           <div class="col">
            {{Form::submit(__('status.Create'), ['class' => 'btn btn-primary mt-3'])}}
           </div>
        </div>
    </div>
    {{Form::close()}}
</div>
</div>
@endsection
