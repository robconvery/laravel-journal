@extends('app::layouts.vendor.dashboard.dashboard')

@section('content')

    <div class="container-fluid">

        <h1>Edit Journal Entry</h1>

        <form name="frm" method="post" action="{{ route('laravel-journal-store', $journal) }}">
            @csrf
            @include('laravel-journal::partials.entry')
            <button class="btn btn-primary">Save</button>
            <a href="{{ route('laravel-journal-entry', [
                'date' => $journal->created_at->format('Y-m-d')
            ]) }}">Cancel</a>
        </form>
    </div>

@endsection
