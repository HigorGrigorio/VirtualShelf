<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- MDB -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('css/notification-alert.css')}}">

    <link rel="stylesheet" href="{{asset('css/index.css')}}">

    <title>Login</title>
</head>
<body>
<section class="vh-100 bg-dark-ocean">
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
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous">
</script>

<!-- MDB -->
<script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js">
</script>

<script>
    document.addEventListener('readystatechange', function (e) {
        e.preventDefault();

        setTimeout(function () {
            let container = document.getElementById('alert-container');

            if (container) {
                container.remove();
            }
        }, 8000);
    });
</script>
</body>
</html>
