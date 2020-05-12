@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Not allowed') }}</div>
                    <div class="card-body">
                        {{__('You cant view this content, you sneaky little devil.')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
