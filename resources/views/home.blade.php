@extends('layouts.app')

@section('content')
<main class="container py-4">
    <div class="p-5 mb-4 bg-light border rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">{{ __('home.Hello from Hexlet!') }}</h1>
            <p class="col-md-8 fs-4">{{ __('home.Practical programming courses!') }}</p>
            <button href="https://ru.hexlet.io/" class="btn btn-primary btn-lg" type="button">{{ __('home.Learn more') }}</button>
        </div>
    </div>
</main>
@endsection
