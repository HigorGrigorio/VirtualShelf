<div class="form-outline mb-5">
    <textarea id="<?php echo e($id); ?>" name="<?php echo e($name); ?>"
              <?php if($max>0): ?>
                  data-mdb-showcounter="true"
                  maxlength="<?php echo e($max); ?>"
              <?php endif; ?>
              class="form-control <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
              rows="<?php echo e($rows); ?>"><?php echo e($value ?? old($name)); ?></textarea>
    <?php if(isset($label)): ?>
        
        <label class="form-label" for="<?php echo e($name); ?>"><?php echo e($label); ?></label>
    <?php endif; ?>
    <?php if(!$errors->has($name)): ?>
        <?php if(isset($help)): ?>
            <span class="form-helper">
                <?php echo e($help); ?>

            </span>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($errors->has($name)): ?>
        <?php $__currentLoopData = $errors->get($name); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="form-helper" style="color: var(--mdb-danger)">
            <?php echo e($message); ?>

        </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>

<?php /**PATH C:\Users\higor\PhpstormProjects\VirtualShelf\resources\views/components/text-area.blade.php ENDPATH**/ ?>