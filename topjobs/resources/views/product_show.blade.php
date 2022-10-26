@extends('layouts.app')
@section('content')
    <script>
        function addToCart() {
            alert("ylo");
        }
    </script>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Product Details</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Product Name</th>
                                    <td>{{ $product->product_name }}</td>
                                </tr>
                                <tr>
                                    <th>Product Code </th>
                                    <td>{{ $product->product_code }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{ $product->price }}</td>
                                </tr>
                                <tr>
                                    <th>Expirt On</th>
                                    <td>{{ \Carbon\Carbon::parse($product->expired_at)->isoFormat('YYYY MMM Do') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <h4>Free Issues Details</h4>
                        <hr>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Label</th>
                                    <th>Type</th>
                                    <th>Free quantity</th>
                                    <th>Range</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($free_labels as $free_label)
                                    <tr>
                                        <td>{{ $free_label->label }}</td>
                                        <td>{{ $free_label->type }}</td>
                                        <td>{{ $free_label->free_qty }}</td>
                                        <td>{{ $free_label->lower_limit }} - {{ $free_label->upper_limit }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (!$free_labels->isEmpty())
                        <div class="body">
                            <form name="cartForm" id="cartForm" method="post" action="javascript:void(0)">
                                @csrf
                                <div class="form-row align-items-left">
                                    <div class="col-sm-3 my-1">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">#</div>
                                            </div>
                                            <input type="hidden" value="{{ $product->id }}" name="product_id"
                                                id="product_id">
                                            <input type="text" class="form-control" id="qty"
                                                name="qty"placeholder="Enter Quantity">
                                        </div>
                                    </div>
                                    <div class="col-auto my-1">
                                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <h1 class="display-6">Need to issue free labe before place a order</h1>
                    @endif
                    <script>
                        if ($("#cartForm").length > 0) {
                            $("#cartForm").validate({
                                submitHandler: function(form) {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $('#submit').html('Please Wait...');
                                    $("#submit").attr("disabled", true);
                                    $.ajax({
                                        url: "{{ url('add_cart') }}",
                                        type: "POST",
                                        data: $('#cartForm').serialize(),
                                        success: function(r) {
                                            console.log(r);
                                            $('#submit').html('Submit');
                                            $("#submit").attr("disabled", false);
                                            if (r.status == 200) {
                                                swal.fire({
                                                    title: 'Product Successfully Added To Cart',
                                                    position: 'center',
                                                    icon: 'success',
                                                    type: 'success',
                                                    padding: '2em',
                                                    confirmButtonColor: '#282d3b',
                                                    confirmButtonText: 'SUCCESS',
                                                    onClose: function() {
                                                        window.location.href = '{{ url('/') }}';
                                                    }
                                                });
                                            } else {
                                                console.log("can not order");
                                                Swal.fire(
                                                    'Enter Quantity in free issue limit range !',
                                                    '',
                                                    'question'
                                                );
                                            }
                                        }
                                    });
                                }
                            })
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
