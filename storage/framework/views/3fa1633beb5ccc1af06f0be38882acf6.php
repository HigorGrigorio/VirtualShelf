<nav class="rounded-3 navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbar-buttons">
            <ul class="d-flex flex-row navbar-nav me-auto mb-lg-0 align-items-center">
                <a id="toggle-side-bar"
                   class="btn btn-dark px-3 me-3"
                   type="button"
                   aria-label="Toggle navigation">
                    <i class="fas fa-bars p-0 m-0"></i>
                </a>
                <span class="text-dark">
                    <?php $__currentLoopData = $breadCrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $word): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->index == count($breadCrumb) - 1): ?>
                            <span class="fw-bold">
                                    <?php echo e($word['name']); ?>

                            </span>
                        <?php elseif($word['route'] != null): ?>
                            <a href="<?php echo e($word['route']); ?>" class="link-dark text-decoration-underline">
                                <?php echo e($word['name']); ?>

                            </a>
                            >
                        <?php else: ?>
                            <?php echo e($word['name']); ?> >
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-link btn-floating">
                    <a href="#" class="text-dark">
                        <i class="fa-solid fa-bell"></i>
                    </a>
                </button>
                <button class="btn btn-link btn-floating">
                    <a href="#" class="text-dark">
                        <i class="fa-solid fa-gear"></i>
                    </a>
                </button>
                <a class="btn btn-dark px-3"
                   href="https://github.com/mdbootstrap/mdb-ui-kit"
                   role="button">
                    <i class="fa-solid fa-door-open me-3"></i>
                    Sign in
                </a>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH C:\Users\higor\PhpstormProjects\VirtualShelf\resources\views/components/nav-bar.blade.php ENDPATH**/ ?>