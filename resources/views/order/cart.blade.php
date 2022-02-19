@extends('admin')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('heading')
    <h2 class="text-center">Create Order</h2>
@endsection

@section('content')
    <div class="row col-md-12">

        <table class="table table-display">
            <thead>
                @if (session('name'))
                    <tr>
                        <th>Customer Name: </th>
                        <th>{{ session('name') }}</th>
                    </tr>
                @endif
                @if (session('contact'))
                    <tr>
                        <th>Contact: </th>
                        <th>{{ session('contact') }}</th>
                    </tr>
                @endif
                @if (session('address'))
                    <tr>
                        <th>Address: </th>
                        <th>{{ session('address') }}</th>
                    </tr>
                @endif
            </thead>
        </table>
        <div class="col-md-12">
            <hr>
            @if (session()->has('success'))
                <br>
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                    <br>
                </div>
            @endif
            @if (session()->has('error'))
                <br>
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                    <br>
                </div>
            @endif
            <br>
        </div>
        <div class="col-md-3">
            <form action="{{ route('addToCart') }}" method="post">
                @csrf
                <label for="">Product</label>
                <select name="product_id" class="form-control" id="product">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                    @endforeach
                </select>
                <label for="">Sales Price</label>
                <input type="number" class="form-control" name="sales_price" readonly value="" id="sale">
                <label for="">Billed Quantity</label>
                <input type="number" min="1" class="form-control" name="billed" value="" id="">
                <input type="submit" value="Add To Cart" class="btn btn-outline-success" id="">
            </form>
        </div>
        <div class="col-md-9">
            <h4 class="text-center">Cart</h4>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Selling price</th>
                        <th>Billed Quantity</th>
                        <th>Sub-total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (session('cartItems'))
                        @foreach (session('cartItems') as $key => $value)
                            <tr>
                                <td>
                                    {{ $value['name'] }}
                                </td>
                                <td>
                                    {{ $value['sales_price'] }} Tk/=
                                </td>
                                <td>
                                    {{ $value['quantity'] }} pc's
                                </td>
                                <td>
                                    {{ $value['sales_price'] * $value['quantity'] }} Tk/=
                                </td>
                                <td>
                                    <a role="button" href="{{ route('removeCart', $key) }}"><button
                                            class="btn btn-link text-danger"><i class="fas fa-times"></i></button></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @if (session('cartItems'))
                <div class="col-12 text-right">
                    <a href="{{ route('checkOut') }}" class="btn btn-outline-primary">Checkout</a>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $("#product").select2({
            placeholder: "Select Product",
            allowClear: true
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#product').on('change', function() {
                var productId = $(this).val();
                if (productId) {
                    $.ajax({
                        url: '/findProduct/' + productId,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            // console.log(data);
                            if (data) {
                                $('#sale').empty();
                                $('#sale').focus();
                                $('#sale').val(data.sales_price);
                            } else {
                                $('#sale').empty();
                            }
                        }
                    });
                } else {
                    $('#sale').empty();
                }
            });
        });
    </script>
@endsection
