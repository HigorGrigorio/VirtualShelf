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
    <link rel="stylesheet" href="<?php echo e(asset('css/notification-alert.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/index.css')); ?>">

    <title>Login</title>
</head>
<body>
<section class="vh-100 bg-dark-ocean">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <form action="<?php echo e(route('login')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-5">Sign in</h3>

                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>"
                                       class="form-control form-control-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"/>
                                <label class="form-label" for="email">Email</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password"
                                       class="form-control form-control-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"/>
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <!-- Checkbox -->
                            <div class="form-check d-flex mb-5 justify-content-between ">
                                <div>
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        value="<?php echo e(old('remember') ? 'checked' : ''); ?>"
                                        id="remember"
                                        name="remember"/>
                                    <label class="form-check-label text-black" for="remember">Remember
                                        password</label>
                                </div>
                                <a href="<?php echo e(route('password.request')); ?>">Forgot password?</a>
                            </div>
                            <button class="btn btn-ocean btn-lg btn-block" type="submit">Login</button>
                            <hr class="my-4">
                            <p class="small fw-bold text-black mt-4 pt-1 mb-0">
                                Don't have an account?
                                <a href="#!" class="link">Register</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php if($errors->any()): ?>
        <div id="alert-container">
            <div data-alert-count="1" class="alert animated flipInX alert-danger alert-dismissible">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <strong>
                        <i class="fa fa-x me-3"></i>
                        Login Failed
                    </strong>
                    <p class="p-3"><?php echo e($error); ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>
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
<?php /**PATH C:\Users\higor\PhpstormProjects\VirtualShelf\resources\views/auth/login.blade.php ENDPATH**/ ?>