<?php if (isset($component)) { $__componentOriginal165f8e34452936f6da18fceb86497519 = $component; } ?>
<?php $component = App\View\Components\App::resolve(['tables' => $tables,'table' => $table] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\App::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal-delete','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
    <div class="row d-flex justify-content-center h-100 w-100 align-items-center ">
        <div class="col col-lg-7 mb-4 mb-lg-0">
            <div class="card" style="border-radius: .5rem;">
                <div class="row g-0">
                    <div class="card-body">
                        <h2 class="pb-3">Viewing a User</h2>
                        <h6>Profile image</h6>
                        <div class="mt-3 mb-4 text-center w-100">
                            <img src="<?php echo e(url($record['photo'] ?? 'images/default-photo.jpg')); ?>" class="img-fluid" style="width: 100px;">
                        </div>
                        <h6>Information</h6>
                        <hr class="mt-0 mb-4">
                        <div class="row pt-1">
                            <div class="col-6 mb-3">
                                <h6>Name</h6>
                                <p class="text-muted"><?php echo e($record['name']); ?></p>
                            </div>
                            <div class="col-6 mb-3">
                                <h6>Email</h6>
                                <p class="text-muted"><?php echo e($record['email']); ?></p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex justify-content-start">
                                <a href="<?php echo e(route('tables.user.edit', ['id' => $record['id']])); ?>"
                                   role="button"
                                   class="btn btn-link btn-rounded btn-sm fw-bold"
                                   data-mdb-ripple-color="dark">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button href="<?php echo e(route('tables.user.destroy', ['id' => $record['id']])); ?>"
                                        data-mdb-toggle="modal"
                                        data-mdb-target="#confirm-modal"
                                        class="btn btn-link btn-rounded btn-sm fw-bold">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                            <a href="<?php echo e(route('tables.user.index')); ?>"
                               role="button"
                               class="btn btn-danger btn-rounded btn-sm fw-bold"
                               data-mdb-ripple-color="dark">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal165f8e34452936f6da18fceb86497519)): ?>
<?php $component = $__componentOriginal165f8e34452936f6da18fceb86497519; ?>
<?php unset($__componentOriginal165f8e34452936f6da18fceb86497519); ?>
<?php endif; ?>
<?php /**PATH C:\Users\higor\PhpstormProjects\VirtualShelf\resources\views/layout/user/show.blade.php ENDPATH**/ ?>