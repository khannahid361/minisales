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
            <h4 align="center">Product List</h4>
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#myModal">
                Add Product
            </button>
            <br>
            <br>
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Stock Quantity</th>
                        <th>Purchase Price</th>
                        <th>Sales Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td><img height="60" width="85" src="{{ asset('storage/images/' . $product->image) }}" alt="">
                            </td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->quantity }} pc's</td>
                            <td>{{ $product->purchase_price }}</td>
                            <td>{{ $product->sales_price }}</td>
                            <td><a href="{{ route('editProduct', $product->id) }}" class="btn btn-outline-primary">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Product Information</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('storeProduct') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <table>
                            <tr>
                                <th>Product Name:</th>
                                <th> <input type="text" class="form-control" name="product_name" id=""> </th>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <th> <textarea name="description" class="form-control" id="" size="20"
                                        rows="2"></textarea> </th>
                            </tr>
                            <tr>
                                <th>Quantity:</th>
                                <th> <input type="number" min="1" class="form-control" name="quantity" id=""> </th>
                            </tr>
                            <tr>
                                <th>Purchase Price:</th>
                                <th> <input type="number" min="1" class="form-control" name="purchase_price" id=""> </th>
                            </tr>
                            <tr>
                                <th>Sales Price:</th>
                                <th> <input type="number" min="1" class="form-control" name="sales_price" id=""> </th>
                            </tr>
                            <tr>
                                <th>Image:</th>
                                <th> <input type="file" class="form-control" name="image" id=""> </th>
                            </tr>
                        </table>
                        <input type="submit" style="float: right;" class="btn btn-outline-primary" value="Create">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
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
