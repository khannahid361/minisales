@extends('admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
@endsection
@section('heading')
    <h2 class="text-center">Invoice No: {{ $order->id }}</h2>
@endsection

@section('content')
    <div class="row col-md-12">

        <table class="table table-display">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>{{ $order->customer->name }}</th>
                </tr>
                <tr>
                    <th>Contact</th>
                    <th>{{ $order->customer->contact }}</th>
                </tr>
                <tr>
                    <th>Address</th>
                    <th>{{ $order->customer->address }}</th>
                </tr>
            </thead>
        </table>
        <div class="col-md-12">
            <hr>

            <br>
        </div>
        <div class="col-md-12">
            <h4 class="text-center">Order Details</h4>
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Selling price</th>
                        <th>Billed Quantity</th>
                        <th>Sub-total</th>
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
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td>{{ $order->amount }}Tk/=</td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
