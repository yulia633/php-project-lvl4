@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">{{ __('status.Status edit') }}</h1>
    @include('flash::message')
    <div class="row">
        <div class="col">
            {{Form::model($taskStatus, ['url' => route('task_statuses.update', ['task_status' => $taskStatus]), 'method' => 'PATCH'])}}
            <div class="form-row">
                <div class="col-4">
                    <div class="form-group">
                        {{Form::label('name', __('status.Status name'))}}
                        {{Form::text('name', $taskStatus->name, ['class' => 'form-control'])}}
                        @if ($errors->any())
                            <div class="invalid-feedback d-block">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    {{Form::submit(__('status.Update'), ['class' => 'btn btn-primary mt-3'])}}
                </div>
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>
@endsection
