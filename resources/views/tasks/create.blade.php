@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">{{ __('tasks.Create task') }}</h1>
    <div class="row">
        <div class="col">
            {{Form::open(['url' => route('tasks.store')])}}
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        {{Form::label('name', __('tasks.Task name'))}}
                        {{Form::bsText('name', '', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')])}}
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        {{Form::label('description', __('tasks.Description'))}}
                        {{Form::textarea('description', null, array('class' => 'form-control', 'cols' => '50', 'rows' => '10'))}}
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        {{Form::label('status_id', __('status.Status'))}}
                        {{Form::select('status_id', $taskStatuses, null, array('placeholder' => '----------', 'class' => 'form-control'))}}
                        @if ($errors->has('status_id'))
                        <div class="invalid-feedback d-block">
                            <strong>{{ $errors->first('status_id') }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        {{Form::label('assigned_to_id', __('tasks.Executor'))}}
                        {{Form::select('assigned_to_id', $users, null, array('placeholder' => '----------', 'class' => 'form-control'))}}
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        {{Form::label('label_id', __('labels.Labels'))}}
                        {{Form::select('label_id', $labels, null, ['placeholder' => '', 'multiple' => 'multiple', 'name' => 'labels[]', 'class' => 'form-control'])}}
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    {{Form::submit(__('tasks.Create'), array('class' => 'btn btn-primary mt-3'))}}
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
@endsection
