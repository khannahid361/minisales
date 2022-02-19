@extends('admin')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('heading')
    <h2 class="text-center">Select Customer</h2>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="col-md-12">
            @if (session()->has('success'))
                <br>
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                    <br>
                </div>
            @endif
            <form action="{{ route('setCustomer') }}" method="post">
                @csrf
                <table>
                    <tr>
                        <td>
                            <select style="width: 200px; height:40px" name="customer_id" id="customer_id">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="submit" style="background: rgba(0, 255, 0, 0.1)" value="Create"
                                class="" id=""></td>

            </form>
            <td><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#myModal">
                    Add Customer
                </button></td>
            </tr>
            </table>
        </div>
    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Customer Information</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('addCustomer') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <table>
                            <tr>
                                <th>Customer Name:</th>
                                <th> <input type="text" required class="form-control" name="name" id=""> </th>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <th> <textarea name="address" required class="form-control" id="" size="20"
                                        rows="2"></textarea>
                                </th>
                            </tr>
                            <tr>
                                <th>Contact:</th>
                                <th> <input type="text" required minlength="11" maxlength="14" class="form-control"
                                        name="contact" id=""> </th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">
        $("#customer_id").select2({
            placeholder: "Select Customer",
            allowClear: true
        });
    </script>
@endsection
