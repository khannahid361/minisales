@extends('admin')

@section('heading')
    <h2 class="text-center">Edit Customer Info</h2>
@endsection

@section('content')
    <div class="col-md-12">
        <form action="{{ route('updateCustomer', $customer->id) }}" method="POST">
            @csrf
            <table>
                <tr>
                    <th>Customer Name:</th>
                    <th> <input type="text" value="{{ $customer->name }}" required class="form-control" name="name"
                            id=""> </th>
                </tr>
                <tr>
                    <th>Address:</th>
                    <th> <textarea name="address" required class="form-control" id=""
                            rows="2">{{ $customer->address }}</textarea>
                    </th>
                </tr>
                <tr>
                    <th>Contact:</th>
                    <th> <input type="text" required minlength="11" value="{{ $customer->contact }}" maxlength="14"
                            class="form-control" name="contact" id=""> </th>
                </tr>
            </table>
            <input type="submit" value="Update" class="btn btn-outline-success">
        </form>
    </div>
@endsection
