@extends('admin')
@section('heading')
    <h2 class="text-center">Edit Product Info</h2>
@endsection
@section('content')
    <div class="col-md-12">
        <form action="{{ route('updateProduct', $product->id) }}" enctype="multipart/form-data" method="post">
            @csrf
            <table>
                <tr>
                    <th>Product Name:</th>
                    <th> <input type="text" class="form-control" value="{{ $product->product_name }}" name="product_name"
                            id=""> </th>
                </tr>
                <tr>
                    <th>Description:</th>
                    <th> <textarea name="description" class="form-control" id="" size="20"
                            rows="2">{{ $product->description }}</textarea> </th>
                </tr>
                <tr>
                    <th>Quantity:</th>
                    <th> <input type="number" min="1" value="{{ $product->quantity }}" class="form-control"
                            name="quantity" id=""> </th>
                </tr>
                <tr>
                    <th>Purchase Price:</th>
                    <th> <input type="number" min="1" value="{{ $product->purchase_price }}" class="form-control"
                            name="purchase_price" id=""> </th>
                </tr>
                <tr>
                    <th>Sales Price:</th>
                    <th> <input type="number" min="1" value="{{ $product->sales_price }}" class="form-control"
                            name="sales_price" id=""> </th>
                </tr>
                <tr>
                    <th>Image:</th>
                    <th> <input type="file" class="form-control" name="image" id=""> </th>
                </tr>
            </table>
            <input type="submit" name="" value="Update Product" class="btn btn-outline-success" id="">
        </form>
    </div>
@endsection
