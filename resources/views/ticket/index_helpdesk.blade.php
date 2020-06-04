@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Tickets') }}</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-succes">
                                {{ session('success') }}
                            </div>
                        @endif
                        @forelse($assigned_tickets as $assigned_ticket)
                            <div class="card mb-3">
                                <div class="card-header">
                                    {{ $assigned_ticket->submitting_user->name }}
                                    <em> {{ $assigned_ticket->created_at->toFormattedDateString() }}</em>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">
                                        @can ('assign', App\Tickets::class)
                                        <a href="{{ route('ticket_show', ['id' => $assigned_ticket]) }}">
                                            {{ $assigned_ticket->title }}
                                        </a>
                                        @else
                                            <p>{{$assigned_ticket->title }}</p>
                                        @endcan

                                    </h5>
                                    <p class="card-text">
                                        {!! nl2br(e($assigned_ticket->description)) !!}
                                    </p>
                                </div>
                                <div class="card-footer">
                                    {{ $assigned_ticket->status->description }}
                                </div>
                            </div>
                        @empty
                            {{ __('No tickets available...') }}

                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Tickets') }}</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-succes">
                                {{ session('success') }}
                            </div>
                        @endif
                        @forelse($unassigned_tickets as $unassigned_ticket)
                            <div class="card mb-3">
                                <div class="card-header">
                                    {{ $unassigned_ticket->submitting_user->name }}
                                    <em> {{ $unassigned_ticket->created_at->toFormattedDateString() }}</em>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('ticket_show', ['id' => $unassigned_ticket]) }}">
                                            {{ $unassigned_ticket->title }}
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        {!! nl2br(e($unassigned_ticket->description)) !!}
                                    </p>
                                </div>
                                <div class="card-footer">
                                    {{ $unassigned_ticket->status->description }}
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
