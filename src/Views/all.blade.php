@extends('layouts.vendor.dashboard.dashboard')

@section('content')

    <div class="container-fluid">

        <h1>My Journal</h1>

        <div class="row">
            <div class="col">
                <a class="btn btn-success mb-3" href="{{ route('laravel-journal-new') }}">Create Journal Entry</a>
            </div>
        </div>

        <div class="row">
            <div class="col">

                @foreach($Journals as $date => $Journal)

                    <div>
                        <a class="btn btn-link" href="{{ route('laravel-journal-entry', [
                            'date' => $date
                        ]) }}">{{ \Carbon\Carbon::parse($date)->format('d-M-y') }}</a>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

@endsection
