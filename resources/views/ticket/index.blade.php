@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tickets') }}</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-succes">
                                {{ session('success') }}
                            </div>
                        @endif
                        @forelse($tickets as $ticket)
                            <div class="card mb-3">
                                <div class="card-header">
                                    {{ $ticket->submitting_user->name }}
                                    <em> {{ $ticket->created_at->toFormattedDateString() }}</em>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('ticket_show', ['id' => $ticket]) }}">
                                            {{ $ticket->title }}
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        {!! nl2br(e($ticket->description)) !!}
                                    </p>
                                </div>
                                <div class="card-footer">
                                    {{ $ticket->status->description }}
                                </div>
                            </div>

                        @empty
                            {{ __('No tickets available...') }}

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
