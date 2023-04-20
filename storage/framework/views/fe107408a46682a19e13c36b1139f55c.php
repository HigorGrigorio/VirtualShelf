<?php if (isset($component)) { $__componentOriginal165f8e34452936f6da18fceb86497519 = $component; } ?>
<?php $component = App\View\Components\App::resolve(['table' => $table,'tables' => $tables] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\App::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container px-0">
        <div class="pt-4 pb-3 container-fluid d-flex flex-row justify-content-between px-0">
            <div>
                <a href="<?php echo e(route('tables.country.create')); ?>" class="btn btn-dark">
                    <i class="fas fa-plus"></i>
                    <span class="ms-2">Add</span>
                </a>
            </div>
            <form action="<?php echo e(route('tables.country.index')); ?>" method="get"
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
                    <button type="submit" class="btn btn-dark">
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
                <table class="table align-middle mb-0 bg-white">
                    <thead style="  position: sticky;
                                 background: var(--bs-gray-200);
                                 top: 0;
                                 z-index: 100;">
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $pagination; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($row->id); ?></th>
                            <th><img src="<?php echo e($row->icon); ?>" alt="icon" style="width: 35px; object-fit: cover;"></th>
                            <th><?php echo e($row->name); ?></th>
                            <th><?php echo e($row->code); ?></th>
                            <td>
                                <a href="<?php echo e(route('tables.language.edit', ['id' => $row->id])); ?>"
                                   role="button"
                                   class="btn btn-link btn-rounded btn-sm fw-bold"
                                   data-mdb-ripple-color="dark">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button
                                    data-href="<?php echo e(route('tables.language.destroy', ['id' => $row->id])); ?>"
                                    data-mdb-toggle="modal"
                                    data-mdb-target="#confirm-modal"
                                    class="btn btn-link btn-rounded btn-sm fw-bold">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a href="<?php echo e(route('tables.language.show', ['id' => $row->id])); ?>"
                                   role="button"
                                   class="btn btn-link btn-rounded btn-sm fw-bold"
                                   data-mdb-ripple-color="dark">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <h3>There is no data to show</h3>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal165f8e34452936f6da18fceb86497519)): ?>
<?php $component = $__componentOriginal165f8e34452936f6da18fceb86497519; ?>
<?php unset($__componentOriginal165f8e34452936f6da18fceb86497519); ?>
<?php endif; ?>
<?php /**PATH C:\Users\higor\PhpstormProjects\VirtualShelf\resources\views/layout/country/index.blade.php ENDPATH**/ ?>