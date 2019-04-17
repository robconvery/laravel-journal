@extends('layouts.vendor.dashboard.dashboard')

@section('content')

    <div class="container-fluid">

        <h1>{{$journals->first()->created_at->format('l jS F Y')}}</h1>

        <div class="row">
            <div class="col">

                @foreach($journals as $journal)

                    <p>
                        <strong>{{ $journal->created_at->format('g:ia') }}</strong> &dash;

                        @foreach($journal->entryAsArray as $line)
                            {{ $line }}
                            @if($loop->last)
                                &nbsp;
                            @else
                                <br/>
                            @endif
                        @endforeach

                        <a href="{{ route('laravel-journal-edit', $journal) }}">
                            <i class="fas fa-edit"></i>
                        </a>

                    </p>

                @endforeach


                    {{--&nbsp;
                    --}}


            </div>
        </div>

        <a class="btn btn-link" href="{{ route('laravel-journal-all') }}">All journals</a>

    </div>

@endsection
