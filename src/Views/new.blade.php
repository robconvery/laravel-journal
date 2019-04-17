@extends('app::layouts.vendor.dashboard.dashboard')

@section('content')

    <div class="container-fluid">

        <h1>Create Journal Entry</h1>

        <form name="frm" method="post" action="{{ route('laravel-journal-create') }}">

            @csrf

            @include('laravel-journal::partials.entry')

            <button class="btn btn-success" type="submit">Create</button>
            <a class="btn btn-link" href="{{ route('laravel-journal-all') }}">Cancel</a>

        </form>

    </div>

@endsection
