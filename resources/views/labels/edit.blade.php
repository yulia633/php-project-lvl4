@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">{{ __('labels.Edit label') }}</h1>
    <div class="row">
        <div class="col">
            {{Form::model($label, ['url' => route('labels.update', ['label' => $label]), 'method' => 'PATCH'])}}
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        {{Form::label('name', __('labels.Label name'))}}
                        {{Form::text('name', $label->name, ['class' => 'form-control'])}}
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
                <div class="col-6">
                    <div class="form-group">
                        {{Form::label('description', __('labels.Description'))}}
                        {{Form::textarea('description', null, ['class' => 'form-control', 'cols' => '50', 'rows' => '10'])}}
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    {{Form::submit(__('labels.Update'), ['class' => 'btn btn-primary mt-3'])}}
                </div>
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>
@endsection
