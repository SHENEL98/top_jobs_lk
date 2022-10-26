@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-9">
                                <h2>Order View</h2>
                            </div>
                            <div class="col-3">
                                <a href="/invoice?id={{$order->id}}" >
                                <button type="button"
                                    class="btn btn-outline-info">DOWNLOAD PDF</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Order Number</th>
                                    <td>{{ $order->id }}</td>
                                </tr>
                                <tr>
                                    <th>Customer Name</th>
                                    <td>{{ $order->customer->customer_name }}</td>
                                </tr>
                                <tr>
                                    <th>Customer Phone number </th>
                                    <td>{{ $order->customer->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Customer Address</th>
                                    <td>{{ $order->customer->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table class="table table-bordered mt-5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Purchase Quantity</th>
                                        <th>Free Issued Quantity</th>
                                        <th>Unit Price (Rs.)</th>
                                        <th>Amount (Rs.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_products as $order_product)
                                        <tr>
                                            <td></td>
                                            <td>{{ $order_product->product->product_name }}
                                                <br><small>
                                                    {{ \Carbon\Carbon::parse($order_product->product->expired_at)->isoFormat('YYYY MMM Do HH mm') }}</small>
                                            </td>
                                            <td>{{ $order_product->product->product_code }}</td>
                                            <td>{{ $order_product->qty }}</td>
                                            <td>{{ $order_product->free_qty }}
                                                <br><span class="badge badge-info">{{ $order_product->free->label }}</span>
                                            </td>
                                            <td>{{ $order_product->unit_price }}</td>
                                            <td>{{ $order_product->amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
