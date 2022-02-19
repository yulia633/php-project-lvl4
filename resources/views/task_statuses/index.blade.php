@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">{{ __('status.Statuses') }}</h1>
    @include('flash::message')
    @if(Auth::check())
    <div class="row">
        <div class="col my-2">
            <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">{{ __('status.Create status') }}</a>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col my-2">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">{{ __('status.Status name') }}</th>
                        <th scope="col">{{ __('status.Date of creation') }}</th>
                        @if(Auth::check())
                        <th scope="col">{{ __('status.Actions') }}</th>
                        @endif
                    </tr>
                    @if ($taskStatuses)
                        @foreach ($taskStatuses as $status)
                            <tr>
                                <td>{{ $status->id }}</td>
                                <td scope="row"> {{ $status->name }} </td>
                                <td>{{ $status->created_at->format('d.m.Y') }}</td>
                                @if(Auth::check())
                                <td>
                                    <a class="text-danger" href="{{ route('task_statuses.destroy', $status->id) }}" data-method="delete" rel="nofollow" data-confirm="Вы уверены?">{{ __('status.Delete') }}</a>
                                    <a href="{{ route('task_statuses.edit', $status->id) }}">{{ __('status.Edit') }}</a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            {{ $taskStatuses->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
