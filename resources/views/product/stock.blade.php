@extends('admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
@endsection

@section('heading')
    <h2 class="text-center"></h2>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="col-md-12">
            <h4 align="center">Product Stock</h4>
            <br>
            <a href="{{ route('stockPDF') }}" class="btn btn-outline-success">Export PDF</a>
            <br>
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Sold Quantity</th>
                        <th>Current Stock</th>
                        <th>Purchase Price</th>
                        <th>Sales Price</th>
                        <th>Current Stock Sale Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->sold }}pc's</td>
                            <td>{{ $product->stock }} pc's</td>
                            <td>{{ $product->purchase_price }}Tk/=</td>
                            <td>{{ $product->sales_price }}Tk/=</td>
                            <td>{{ $product->sales_price * $product->stock }}Tk/=</td>
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
