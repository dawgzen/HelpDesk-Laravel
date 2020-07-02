@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ticket') }}</div>
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="card-header">
                                {{ $ticket->submitting_user->name }}
                                <em> {{ $ticket->created_at->toFormattedDateString() }}</em>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $ticket->title }}

                                </h5>
                                <p class="card-text">
                                    {!! nl2br(e($ticket->description)) !!}

                                </p>
                                <div class="card-footer">
                                    {{ $ticket->status->description }}
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{session('success')}}
                                    </div>
                                @endif

                                <p id="comments"></p>

                                @forelse ($ticket->comments as $comment)
                                    <p class="card-text">
                                        {{ $comment->created_at->toFormattedDateString()}}
                                        {{ $comment->user->name}}
                                        {!! nl2br(e($comment->contents))!!}
                                    </p>
                                @empty
                                    <p class="card-text">
                                        {{ __('noComment') }}
                                    </p>
                                @endforelse
                            </div>
                            @can('claim', $ticket)
                                <form method="POST" action="{{ route('ticket_claim',  ['id' => $ticket]) }}">
                                    <button>
                                        {{ __('claim') }}
                                    </button>
                                    @method('PUT')
                                    @csrf
                                </form>
                            @endcan

                            @can('close', $ticket)
                                <form method="POST" action="{{ route('ticket_close',  ['id' => $ticket]) }}">
                                    <button>
                                        {{ __('close') }}
                                    </button>
                                    @method('PUT')
                                    @csrf
                                </form>
                            @endcan

                            @can('free', $ticket)
                                <form method="POST" action="{{ route('ticket_free', ['id' => $ticket]) }}">
                                    <button>
                                        {{ __('free') }}
                                    </button>
                                    @method('PUT')
                                    @csrf
                                </form>
                            @endcan

                            @can('escalate', $ticket)
                                <form method="POST" action="{{ route('ticket_escalate', ['id' => $ticket]) }}">
                                    <button>
                                        {{ __('escalate') }}
                                    </button>
                                    @method('PUT')
                                    @csrf
                                </form>
                            @endcan

                            @can('deescalate', $ticket)
                                <form method="POST" action="{{ route('ticket_deescalate', ['id' => $ticket]) }}">
                                    <button>
                                        {{ __('deescalate') }}
                                    </button>
                                    @method('PUT')
                                    @csrf
                                </form>
                            @endcan

                            @can('delegate', $ticket)
                                <button type="button" class="btn btn-primary"
                                        data-toggle="modal" data-target="#delegateModal">
                                    {{__('delegate')}}
                                </button>
                            @endcan


                            @can ('comment', $ticket)

                                <div class="card-footer">
                                    {{ __('comment') }}
                                </div>
                                <form method="POST" id="form" action="{{ route('comment_save', ['id' => $ticket]) }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="comment"
                                               class="col-md-4 col-form-label text-md-right">{{ __('comment content') }}</label>
                                        <div class="col-md-6">
                                            <textarea id="comment" type="text" class="form-control"
                                                      name="comment">{{ old('comment')}}</textarea>
                                            @error('comment')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('SaveComment') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="col-md-6 offset-md-4">
                                    <p> {{ __('cantComment') }}</p>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('delegate', $ticket)
        <div class="modal fade" id="delegateModal" tabindex="-1" role="dialog"
             aria-labelledby="Delegate ticket" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delegate ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="form" action="{{ route('ticket_delegate', $ticket) }}">
                            @csrf
                            @method('PUT')
                            <select name="worker_id" id="worker_id">
                                @foreach($delegatable_users as $delegatable_user)
                                    <option value="{{$delegatable_user->id}}">{{$delegatable_user->name}}</option>
                                @endforeach
                            </select>
                            <button type="submit">Delegate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
