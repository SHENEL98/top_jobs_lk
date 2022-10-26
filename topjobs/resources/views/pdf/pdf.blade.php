<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test - Software Engineer</title>
    <style>
        p {
            font-size: 12px;
        }

        .logo {
            width: 250px;
        }

        .row {
            width: 100%;
        }

        .logo-div {
            width: 50%;
            float: left;
        }

        .company-address {
            width: 50%;
            float: left;
            font-size: 14px;
        }

        .title {
            width: 100%;
            background-color: #dcdde1;
            text-align: center;
            padding: 2px;
        }

        .left {
            width: 60%;
            float: left
        }

        .user-details {
            font-weight: bold;
            line-height: 17px;
        }

        .right {
            margin-top: -150px;
            padding-left: 550px;
            width: 40%;
            float: left;
        }

        table {
            width: 100%;
            // border-collapse: collapse;
            font-size: 12px;
            // margin-bottom: 50px;
        }

        a {
            color: #e1b12c;
        }
    </style>

</head>

<body>

    <table style="width: 100% ;  border-collapse: collapse;">
        <tr>
            <th style="width:30%  ; background-color: #EDF0F2 ;text-align:left ">

                <p>Developed by : W.S.A.Kurera </p>

                @foreach ($order as $order)
            </th>
            <th style="width:15% ; background-color: #EDF0F2 "></th>
            <th style="width:25% ; background-color: #EDF0F2 ">
                <h2 style="color: #136CB8">INVOICE</h2>
                <p class="user-details">No : {{ $order->id }}<br>

                    {{ $order->created_at }}</p>

            </th>
        </tr>
    </table>

    <table style="width: 100% ;  border-collapse: collapse">
        <tr>
            <th style="width:20%">
                <p style="text-align:left"><br>
                    {{ $order->customer->customer_name }}<br>
                    {{ $order->customer->address }} <br>
                    {{ $order->customer->phone_number }}<br>
                </p>
            </th>
            <th style="width:55%"></th>
            <th style="width:25%">
                <h4 style="text-align:left;">ORDER NO:{{ $order->id }}<br>
                    ORDER DATE: {{ $order->created_at }}<br>
            </th>
        </tr>
    </table>
    @endforeach

    <table style="width:100%">
        <tr>
            <td style="width:25% ; background-color: #689FCE ;font-color: white">PRODUCT NAME</td>
            <td style="width:10%; background-color: #689FCE">PRODUCT CODE</td>
            <td style="width:10% ; background-color: #689FCE">ORDER QUANITTY</td>
            <td style="width:15% ; background-color: #689FCE">FREE QTY</td>
            <td style="width:10% ; background-color: #689FCE">UNIT PRICE(Rs.)</td>
            <td style="width:20% ; background-color: #689FCE">TOTAL(Rs.)</td>
        </tr>
        <tbody>
            @foreach ($order_products as $order_product)
                <tr>
                    <td style=" border: 1px solid black;">{{ $order_product->product->product_name }}</td>
                    <td style=" border: 1px solid black;">{{ $order_product->product->product_code }}</td>
                    <td style=" border: 1px solid black; text-align:center;">{{ $order_product->qty }}</td>
                    <td style=" border: 1px solid black; text-align:center;">{{ $order_product->free_qty }} <br>
                        <span class="badge badge-secondary">{{$order_product->free->label}}</span>
                    </td>
                    <td style=" border: 1px solid black; text-align:center;">Rs. {{ $order_product->unit_price }}</td>
                    <td style=" border: 1px solid black; text-align:right;">Rs. {{ $order_product->amount }}</td> 
                </tr>
            @endforeach



        </tbody>
    </table>
    <br>
    <table style="width: 100%">
        @foreach ($ordertot as $ordertot)
            <tr>
                <th style="width: 65%"></th>
                <th style="width: 20% ; style="text-align:left;">NET TOTAL - </th>
                <th style="width: 15% ; style="text-align:right">Rs. {{ $ordertot->net_total }}/=</th>
            </tr>
        @endforeach
    </table>

    <br><br>
    <center>
        <h4 style="color:black;"> Thank You for shopping with us.! </h4>
    </center>
</body>

</html>
