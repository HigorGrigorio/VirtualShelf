<div data-alert-count="<?php echo e($id); ?>" class="alert animated flipInX alert-<?php echo e($type); ?> alert-dismissible">
    <strong>
        <i class="<?php echo e($icon); ?> me-3"></i>
        <?php echo e($title); ?>

    </strong>
    <p class="p-3"><?php echo e($message); ?></p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php if($timeout): ?>
    <?php $__env->startPush('scripts'); ?>
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    let alert = $('[data-alert-count=<?php echo e($id); ?>]');

                    if (alert) {
                        alert.remove();
                    }
                }, <?php echo e($timeout); ?>);
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\higor\PhpstormProjects\VirtualShelf\resources\views/components/alert.blade.php ENDPATH**/ ?>