@extends('blank')

@section('content')
    <div class="splash-container">
        <div class="card" style="background: linear-gradient(to bottom right, rgba(0,255,0,1), rgba(0,255,0,0))">
            <div class=""><span style="color: rgba(0,0,255,0.8);padding-top: 1.5rem;"
                    class="splash-description">Admin
                    LogIn</span></div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember
                                Me</span>
                        </label>
                    </div>
                    @if (session()->has('error'))
                        <div align="center" style="color: red;">
                            {{ session()->get('error') }}
                            <br>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>

        </div>
    </div>
@endsection
