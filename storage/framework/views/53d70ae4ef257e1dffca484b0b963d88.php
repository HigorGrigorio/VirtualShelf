<div class="form-outline mb-5">
    <input value="<?php echo e($value ?? old($name)); ?>" type="<?php echo e($type); ?>" id="<?php echo e($id); ?>" name="<?php echo e($name); ?>"
           class="form-control <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"/>
    <?php if(isset($label)): ?>
        
        <label class="form-label" for="<?php echo e($name); ?>"><?php echo e($label); ?></label>
    <?php endif; ?>
    <?php if(!$errors->has($name)): ?>
        <?php if(isset($help)): ?>
            <span class="form-helper">
                <?php echo e($help); ?>

            </span>
        <?php endif; ?>
    <?php else: ?>
        <span class="form-helper" style="color: var(--mdb-danger);">
            <?php echo e($errors->get($name)[0]); ?>

        </span>
    <?php endif; ?>
</div>

<?php /**PATH C:\Users\higor\PhpstormProjects\VirtualShelf\resources\views/components/input.blade.php ENDPATH**/ ?>