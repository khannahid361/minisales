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
            <h4 align="center">Customer List</h4>
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#myModal">
                Add Customer
            </button>
            <br>
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
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->contact }}</td>
                            <td>{{ $customer->address }}</td>
                            <td><a href="{{ route('editCustomer', $customer->id) }}"
                                    class="btn btn-outline-primary">Edit</a>
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
                                <th> <textarea name="address" required class="form-control" id="" size="20" rows="2"></textarea>
                                </th>
                            </tr>
                            <tr>
                                <th>Contact:</th>
                                <th> <input type="text" required minlength="11" maxlength="14" class="form-control" name="contact"
                                        id=""> </th>
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
