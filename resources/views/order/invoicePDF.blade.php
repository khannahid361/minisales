<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabcart</title>
    <style>
        body {
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }

        .brand-section {
            background-color: #0d1033;
            padding: 10px 40px;
        }

        .logo {
            width: 50%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-6 {
            width: 50%;
            flex: 0 0 auto;
        }

        .text-white {
            color: #fff;
        }

        .company-details {
            float: right;
            text-align: right;
        }

        .body-section {
            padding: 16px;
            border: 1px solid gray;
        }

        .heading {
            font-size: 20px;
            margin-bottom: 08px;
        }

        .sub-heading {
            color: #262626;
            margin-bottom: 05px;
        }

        table {
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }

        table thead tr {
            border: 1px solid #111;
            background-color: #f2f2f2;
        }

        table td {
            vertical-align: middle !important;
            text-align: center;
        }

        table th,
        table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }

        .table-bordered {
            box-shadow: 0px 0px 5px 0.5px gray;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .text-right {
            text-align: end;
        }

        .w-20 {
            width: 20%;
        }

        .float-right {
            float: right;
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-white">Invoice No: {{ $order->id }}</h1>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">Customer Name: {{ $order->customer->name }}</h2>
                    <p class="sub-heading">Contact No. {{ $order->customer->contact }} </p>
                    <p class="sub-heading">Address: {{ $order->customer->address }} </p>
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Ordered Items</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="w-20">Selling price</th>
                        <th class="w-20">Billed Quantity</th>
                        <th class="w-20">Sub-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->cartitems as $item)
                        <tr>
                            <td>{{ $item->product->product_name }}</td>
                            <td>{{ $item->sales_price }}Tk/=</td>
                            <td>{{ $item->billed }}pc's</td>
                            <td style="float: right;">{{ $item->billed * $item->sales_price }}Tk/=</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Total</td>
                        <td>{{ $order->amount }}Tk/=</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h3 class="heading">Payment Status: Paid</h3>
            <h3 class="heading">Payment Mode: Cash on Delivery</h3>
        </div>
    </div>

</body>

</html>
