@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Define Free Issues</h2>
                    </div>
                    <div class="card-body">
                        @livewire('frees')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
