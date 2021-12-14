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
                                <td>{{ $status->created_at }}</td>
                                @if(Auth::check())
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="{{ route('task_statuses.destroy', $status->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">{{ __('status.Delete') }}</button>
                                        </form>
                                        <a href="{{ route('task_statuses.edit', ['task_status' => $status]) }}"class="btn btn-primary">{{ __('status.Edit') }}</a>
                                    </div>
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
