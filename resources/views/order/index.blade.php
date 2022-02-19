@extends('admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
@endsection

@section('heading')
    <h2 class="text-center">Order List</h2>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="col-md-12">
            <h4 align="center">Order List</h4><a class="btn btn-outline-success" href="{{ route('getCustomer') }}">Create
                Order</a><br>
            <br>
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Customer Name</th>
                        <th>Order Amount</th>
                        <th>Created by</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->amount }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td><a class="btn btn-outline-primary" href="{{ route('invoice', $order->id) }}">View
                                    Invoice</a><a class="btn btn-outline-danger"
                                    href="{{ route('invoicePDF', $order->id) }}">GeneratePDF</a></td>
                        </tr>
                    @endforeach
                </tbody>
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
