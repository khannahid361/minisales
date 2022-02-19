<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <h2>Product Stock</h2>
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

</body>

</html>
