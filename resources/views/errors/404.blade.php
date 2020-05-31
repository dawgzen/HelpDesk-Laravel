@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __("404 not found") }}</div>
                    <div class="card-body">
                        {{__("It seems like this page doesnt exist friend, please go back and try again. or dont, i dont really care.")}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
