@extends ('layouts.app')

@section('content')
    <main class="vh-100 bg-dark-ocean">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <form action="{{route('password.update')}}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="card-body p-5 text-center">

                                <h4 class="mb-4">Enter with your email to reset password</h4>

                                <div class="form-outline mb-4">
                                    <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}"
                                           class="form-control form-control-lg @error('email') is-invalid @enderror"/>
                                    <label class="form-label" for="email">Email</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="password" name="password"
                                           class="form-control form-control-lg @error('password') is-invalid @enderror"/>
                                    <label class="form-label" for="password">Password</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="password" name="password_confirmation"
                                           class="form-control form-control-lg @error('password') is-invalid @enderror"/>
                                    <label class="form-label" for="password_confirmation">Password</label>
                                </div>

                                <button class="btn btn-ocean btn-lg btn-block" type="submit">
                                    Reset Password
                                </button>
                                <hr class="my-4">
                                <p class="small fw-bold text-black mt-4 pt-1 mb-0">
                                    Do you have an account?
                                    <a href="{{route('login')}}" class="link">Sign In</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="alert-container">
            @if($errors->any())
                <div data-alert-count="1" class="alert animated flipInX alert-danger alert-dismissible">
                    @foreach ($errors->all() as $error)
                        <strong>
                            <i class="fa fa-x me-3"></i>
                            Login Failed
                        </strong>
                        <p class="p-3">{{ $error }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    @endforeach
                </div>
            @endif
            @if(isset($status))
                <div data-alert-count="1" class="alert animated flipInX alert-info alert-dismissible">

                    <strong>
                        <i class="fa fa-exclamation-circle"></i>
                        Info
                    </strong>
                    <p class="p-3">{{ $success }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif
        </div>
    </main>
@endsection
