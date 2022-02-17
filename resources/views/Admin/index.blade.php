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
            <h4 align="center">Admin List</h4><a class="btn btn-outline-success" href="{{ route('createAdmin') }}">Register
                Admin</a><br>
            <br>
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>Admin</td>
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
