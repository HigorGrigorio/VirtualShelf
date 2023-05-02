@extends('layouts.app')

@section('content')
    <section class="vh-100 bg-dark-ocean">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        @if(!isset($status))
                            <form action="{{route('password.email')}}" method="POST">
                                @csrf
                                <div class="card-body p-5 text-center">

                                    <h4 class="mb-4">Enter with your email to reset password</h4>

                                    <div class="form-outline mb-4">
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                               class="form-control form-control-lg @error('email') is-invalid @enderror"/>
                                        <label class="form-label" for="email">Email</label>
                                    </div>

                                    <button class="btn btn-ocean btn-lg btn-block" type="submit">Send reset password
                                        link
                                    </button>
                                    <hr class="my-4">
                                    <p class="small fw-bold text-black mt-4 pt-1 mb-0">
                                        Do you have an account?
                                        <a href="{{route('login')}}" class="link">Sign In</a>
                                    </p>
                                </div>
                            </form>
                        @else
                            <div class="card-body p-5 text-center">
                                <h4 class="mb-4">{{$status}}</h4>
                            </div>
                            <hr class="my-4">
                            <p class="small fw-bold text-black mt-4 pt-1 mb-0">
                                Do you have an account?
                                <a href="{{route('login')}}" class="link">Sign In</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
