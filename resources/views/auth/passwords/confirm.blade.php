@extends('layouts.app')

@section('content')
    <section class="vh-100 bg-dark-ocean">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-header">{{ __('Confirm Password') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                               class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                                               required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-lg btn-ocean">
                                            {{ __('Confirm Password') }}
                                        </button>

                                        @if (Route::has('password.reset'))
                                            <a class="btn btn-link pt-3" href="{{ route('password.reset') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
