@extends ('layouts.app', ['title' => 'Register Account'])

@section('content')
    <main class="bg-dark-ocean" style="min-height: 100vh">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="w-75">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <form action="{{route('register')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body d-flex flex-row p-5">
                                <div class="container-md">
                                    <div class="h-100 text-center d-flex
                                            justify-content-center flex-column
                                            align-items-center">
                                        <img src="{{asset( 'images/default-photo.jpg') }}" id="avatar"
                                             alt="avatar" class="rounded-circle img-fluid" style="width: 255px;">
                                        <button id="remove" type="button" class="btn btn-outline-danger ms-1 mt-4">
                                            Remove
                                        </button>
                                        <div class="d-flex flex-column justify-content-center mt-3 w-75">
                                            <label class="form-label file-label" for="input-file">Select a user
                                                profile
                                                image</label>
                                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                                   id="input-file" name="photo"/>
                                        </div>
                                        @error('photo')
                                        <span class="form-text text-danger">
                                                    {{ $message }}
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="vr"></div>
                                <div class="container">
                                    <h3 class="mb-5 text-center">Sign up</h3>
                                    <div class="form-outline">
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                               class="form-control @error('email') is-invalid @enderror m-0"/>
                                        <label class="form-label" for="email">Email</label>
                                    </div>
                                    @if(!$errors->has('email'))
                                        <span class="form-text mb-1">
                                            The email address you entered is not registered.
                                        </span>
                                    @endif
                                    @error('email')
                                        <span class="form-text text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    <div class="form-outline">
                                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                                               class="form-control @error('name') is-invalid @enderror m-0"/>
                                        <label class="form-label" for="name">Name</label>
                                    </div>
                                    @if(!$errors->has('name'))
                                        <span class="form-text mb-1">
                                            Your name.
                                        </span>
                                    @endif
                                    @error('name')
                                    <span class="form-text text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    <div class="form-outline">
                                        <input type="password" id="password" name="password"
                                               value="{{ old('password') }}"
                                               class="form-control @error('password') is-invalid @enderror m-0"/>
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    @if(!$errors->has('password'))
                                        <span class="form-text mb-1">
                                            Your password must be 8-20 characters long, contain letters and numbers.
                                        </span>
                                    @endif
                                    @error('password')
                                    <span class="form-text text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    <div class="form-outline">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                               value="{{ old('password_confirmation') }}"
                                               class="form-control @error('password_confirmation') is-invalid @enderror m-0"/>
                                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    </div>
                                    @if(!$errors->has('password_confirmation'))
                                        <span class="form-text mb-1">
                                            Confirm your password.
                                        </span>
                                    @endif
                                    @error('password_confirmation')
                                    <span class="form-text text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    <button class="btn btn-ocean btn-lg btn-block mt-2" type="submit">Sign up</button>
                                    <p class="small form-text pt-1 mb-0">
                                        By clicking Sign up you agree to our.
                                    </p>
                                    <hr class="hr">
                                    <div class="d-flex justify-content-center w-100">
                                        <p class="small fw-bold text-black mb-0">
                                            You have an account?
                                            <a href="{{route('login')}}" class="link">Login</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
