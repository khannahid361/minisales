@extends('admin')

@section('heading')
    <h2 class="text-center">Admin Info</h2>
@endsection

@section('content')
    <div class="col-md-12">
        @if (session()->has('error'))
            <div align="center" class=" alert alert-danger">
                {{ session()->get('error') }}
                <br>
            </div>
        @endif
        @if (session()->has('success'))
            <div align="center" class=" alert alert-success">
                {{ session()->get('success') }}
                <br>
            </div>
        @endif
        <h4>Do you want to change your password?</h4>
        <form action="{{ route('updatePassword') }}" method="post">
            @csrf
            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-outline-success">Update</button>
        </form>
    </div>
@endsection
