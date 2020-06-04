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
                                        No comments yet
                                    </p>
                                @endforelse
                            </div>

                            @can ('comment', $ticket)
                            <div class="card-footer">
                                Create new comment
                            </div>
                            <form method="POST" id="form" action="{{ route('comment_save', ['id' => $ticket]) }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="comment"
                                           class="col-md-4 col-form-label text-md-right">{{ __('comment content') }}</label>
                                    <div class="col-md-6">
                                    <textarea id="comment" type="text" class="form-control" name="contents">
                                      {{ old('form')}}
                                    </textarea>
                                        @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save Comment') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                                @else
                                <div class="col-md-6 offset-md-4">
                                <p>You cant comment on this boyo</p>
                                </div>
                                @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
