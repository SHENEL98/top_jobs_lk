@extends('layouts.app') 


@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Placing Order</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleFormControlInput2" class="col-4">Customer Name</label>
                            <select class="form-control" name='customer_id' id="customer_id">
                                <option value="">--Select Customer --</option>
                                @if ($customers)
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                    @endforeach
                                @else
                                    <option value="">No product yet
                                    <option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Purchase Quantity</th>
                                    <th>Free Quantity</th>
                                    <th>Unit Price (Rs.)</th>
                                    <th>Amount (Rs.)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="cart_product_table">

                            </tbody>
                        </table>
                        <table class="table">
                            <tfoot class="thead-light">
                                <tr>
                                    <td><button onclick="clear_cart();" class="btn btn-outline-dark">
                                            Clear Shopping Cart
                                        </button></td>
                                    <td>Net Total :</td>
                                    <td id="net_total" name="net_total">Rs. 00.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" value="" id="amount_total" name="amount_total" />

                        <button type="submit" onclick="place_order()" class="btn btn-success">PLACE ORDER</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            cart_load_cart();
        });

        function cart_load_cart() {
            $.ajax({
                url: 'getcart',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                error: function(error) {
                    console.log("error");
                    console.log(error);
                },
                success: function(r) {

                    let value = '';
                    let check = '';
                    let total = 0.00;
                    let items_count = 0;


                    for (var item in r) {

                        let subtotal = r[item].price * r[item].qty;

                        value += '<tr>';
                        value += '<td>' + r[item].product_name + '</td>';
                        value += '<td>' + r[item].product_code + '</td>';
                        value += '<td>' + r[item].qty + '</td>';
                        value += '<td>' + r[item].free_qty + '</td>';
                        value += '<td>Rs.' + r[item].price + '</td>';
                        value += '<td>Rs.' + parseFloat(subtotal) + '</td>';

                        value += '<td colspan="7" class="clearfix">';
                        value += '<div style="float: right">';
                        value += '<span   onclick="remove_cart(\'' + r[item].product_id +
                            '\');" style="color: #000;" title="Remove product" class="btn-remove"><button class="btn btn-outline-danger">Remove</button><span class="sr-only">Remove</span></span>';
                        value += '</div>';
                        value += '</td>';
                        value += '</tr>';

                        total = total + subtotal;
                        items_count++;
                    }

                    $('#cart_product_table').html(value);
                    $('#sub_total').html('Rs.' + total);
                    let netTotal = total;
                    $('#net_total').html('Rs.' + netTotal);
                    $('#checkout').val(total);
                    $('#CHECKo').html(check);

                    $('#amount_total').val(total);



                }
            });
        }

        function remove_cart(product_id) {
            $.ajax({
                url: 'remove_cart',
                type: "post",
                data: {
                    product_id: product_id,
                    _token: '{{ csrf_token() }}'

                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                error: function(error) {
                    console.log(error);
                    Swal.fire(
                        'ERROR',
                        '',
                        'question'
                    )
                },
                success: function(r) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Product Removed From Cart',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    cart_load_cart()
                }
            });
        }

        function clear_cart() {
            $.ajax({
                url: 'allremove_cart',
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}'

                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                error: function(error) {
                    console.log(error);
                },
                success: function(r) {
                    console.log(r);
                    if (r.status == 200) {
                        swal.fire({
                            title: 'Cart is Empty ',
                            padding: '2em',
                            confirmButtonColor: '#282d3b',
                            // confirmButtonText: 'SUCCESS',
                            onClose: function() {
                                window.location.href = '{{ url('/') }}';
                            }
                        });
                    }
                    cart_load_cart()
                }
            });
        }

        function place_order() {
            var customer_id = $('#customer_id').val();
            var amount_total = parseInt($('#amount_total').val());

            if (customer_id != null) {
                $.ajax({
                    url: 'place_order',
                    type: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        customer_id: customer_id,
                        amount_total: amount_total
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',

                    error: function(error) {
                        console.log(error);
                        swal.fire({
                            title: 'Check Your Entered Details',
                            padding: '2em'
                        });
                    },

                    success: function(r) {
                        console.log(r);
                        if (r.status == 200) {
                            swal.fire('Any fool can use a computer');
                            let alert_contect = '';
                            alert_contect += '<br>'
                            alert_contect += '<input type="hidden" name="order_id" value="' + r.data[0][
                                'order_id'
                            ] + '">'
                            alert_contect += '<a target="_blank" href="/invoice?id=' + r.data[0]['order_id'] +
                                '" class="btn btn-dark mb-15" style = "padding:10px;font-size: 1.5rem;background-color:#282d3b;color:white;">DOWNLOAD INVOICE</a>'
                            alert_contect += '<h5 style = "color:#666666;">Order Number: #' + r.data[0][
                                'order_id'
                            ] + '</h5>'
                            alert_contect += '<p>'
                            alert_contect += 'Order Date: ' + r.data[0]['created_at'] + ''
                            alert_contect += '<br>Order total: Rs. ' + r.data[0]['net_total'] + ''
                            alert_contect += '</p>'
                            alert_contect += '<h4>Billing Address</h4>'
                            alert_contect += '<p>'
                            alert_contect += '' + r.data[0]['customer_name'] + ''
                            alert_contect += '<br>Phone:' + r.data[0]['phone_number'] + ''
                            alert_contect += '<br>Address:' + r.data[0]['address'] + ''
                            alert_contect += '</p>'

                            swal.fire({
                                title: 'ORDER INFORMATION',
                                // text: 'Your order has been successfully placed!',
                                html: alert_contect,
                                type: 'success',
                                padding: '2em',
                                confirmButtonColor: '#282d3b',
                                confirmButtonText: 'SUCCESS',
                                onClose: function() {
                                    window.location.href = '{{ url('/') }}';

                                }
                            });
                        }
                        if (r.status == 500) {
                            swal.fire({
                                title: 'Check Your Entered Details',
                                text: 'Pleace try again later!',
                                type: 'error',
                                confirmButtonColor: '#282d3b',
                                padding: '2em'
                            });
                        }
                    }
                });
            } else {
                swal.fire({
                    title: 'Select Customer Name',
                    type: 'error',
                    confirmButtonColor: '#282d3b',
                    padding: '2em'
                });
            }

        }
    </script>
@endsection
