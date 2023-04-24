<?php $__env->startSection('content'); ?>
    <div class="container px-0">
        <div class="pt-4 pb-3 container-fluid d-flex flex-row justify-content-between px-0">
            <div>
                <a href="<?php echo e(route('tables.user.create')); ?>" class="btn btn-ocean">
                    <i class="fas fa-plus"></i>
                    <span class="ms-2">Add</span>
                </a>
            </div>
            <form action="<?php echo e(route('tables.user.index')); ?>" method="get"
                  class="d-flex flex-row w-75 gap-3 align-items-center">
                <div>
                    <select name="limit" class="form-select" aria-label="Limit of exhibition..." style="width: 5rem">
                        <?php $__currentLoopData = $limits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $op): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($op); ?>" <?php echo e($op == $limit ? 'selected' : ''); ?>><?php echo e($op); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="input-group">
                    <div class="form-outline">
                        <input type="search" id="search" name="search" class="form-control" value="<?php echo e($search ?? ''); ?>"/>
                        <label class="form-label" for="search">Search</label>
                    </div>
                    <button type="submit" class="btn btn-ocean">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <?php if(isset($pagination)): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal-delete','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            <div class="d-block scrollable-y table-bordered" style="height: calc(100vh - 220px)">
                <table class="table table-sm align-middle mb-0 bg-white">
                    <thead style="  position: sticky;
                                 background: var(--bs-gray-200);
                                 top: 0;
                                 z-index: 100;">
                    <tr class="text-black">
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $pagination; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($row->id); ?></th>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="<?php echo e(url($row->photo ?? 'images/default-photo.jpg')); ?>"
                                             class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm"><?php echo e($row->name); ?></h6>
                                        <p class="text-xs text-secondary mb-0"><?php echo e($row->email); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="<?php echo e(route('tables.user.edit', ['id' => $row->id])); ?>"
                                   role="button"
                                   class="btn btn-link text-warning btn-rounded btn-sm fw-bold"
                                   data-mdb-ripple-color="primary">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button
                                    data-href="<?php echo e(route('tables.user.destroy', ['id' => $row->id])); ?>"
                                    data-mdb-toggle="modal"
                                    data-mdb-target="#confirm-modal"
                                    class="btn btn-link text-danger btn-rounded btn-sm fw-bold">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a href="<?php echo e(route('tables.user.show', ['id' => $row->id])); ?>"
                                   role="button"
                                   class="btn btn-link text-success btn-rounded btn-sm fw-bold"
                                   data-mdb-ripple-color="primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-1">
                <?php echo e($pagination->links()); ?>

            </div>
        <?php else: ?>
            <h3>There is no data to show</h3>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\higor\PhpstormProjects\VirtualShelf\resources\views/user/index.blade.php ENDPATH**/ ?>