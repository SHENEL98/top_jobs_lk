@extends('layouts.app') 
@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Order View</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">  
                        @if(!$orders->isEmpty())
                            <table class="table table-bordered mt-5">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Customer Name</th>
                                        <th>Order Date</th>
                                        <th>Order Time</th>
                                        <th>Net Amountt</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->customer->customer_name }}</td>
                                            <td>
                                            {{ \Carbon\Carbon::parse($order->created_at)->isoFormat('YYYY MMM Do HH mm') }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($order->created_at)->isoFormat('HH mm') }}
                                                </td>
                                            <td>{{ $order->net_total }}</td> 
                                            <td class="text-right">
                                                <div class="btn-group" role="group" aria-label="user_actions">
                                                    <a href="{{ url('order') }}/{{ $order->id }}" data-toggle="tooltip"
                                                        data-placement="top" title="View" class="btn btn-info">
                                                        <span class="badge badge-info">View</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else 
                            <h1 class="display-6">Orders not Available yet</h1>

                            @endif
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
