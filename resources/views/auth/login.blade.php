@extends('layouts.app')
@section('content')
@include('components.menu')

<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="{{ route('web.index') }}">Home</a> <span class="mx-2 mb-0">/</span>
                <strong class="text-black">Login</strong></div>
        </div>
    </div>
</div>
<div class="container" style="padding-top: 71px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="h3 mb-3 text-black">{{ __('Login') }}</h2>
            <div class="p-3 p-lg-5 border">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" >{{ __('Login') }}</button>
                    </div>
                    <div class="form-group">
                        @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
            </div>

                </form>
            </div>
        </div>
    </div>
</div>
@include('components.footer')

@endsection
