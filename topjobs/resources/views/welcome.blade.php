@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>PHP - Laravel Test</h2>
                    </div>
                    <div class="row card-body"> 
                        @if(!$products->isEmpty())
                            @foreach ($products as $product)
                                <div class="col-4">
                                    <div class="card" style="width: 18rem;">
                                        {{-- <a href="/products/{{ $product->id }}" class="card-link"> --}}
                                        <a href="{{ url('products') }}/{{ $product->id }}" class="card-link">

                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->product_name }}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">{{ $product->product_code }}</h6>
                                                <p class="card-text">Rs.{{ $product->price }}
                                                <p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else 
                            <h1 class="display-4">Products Not Available yet</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
