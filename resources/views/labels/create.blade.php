@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">{{ __('labels.Create label') }}</h1>
    <div class="row">
        <div class="col">
            {{Form::open(['url' => route('labels.store')])}}
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        {{Form::label('name', __('labels.Label name'))}}
                        {{Form::text('name', '', ['class' => 'form-control'])}}
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
                {{Form::submit(__('labels.Create'), ['class' => 'btn btn-primary mt-3'])}}
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
@endsection
