<?php if (isset($component)) { $__componentOriginal165f8e34452936f6da18fceb86497519 = $component; } ?>
<?php $component = App\View\Components\App::resolve(['tables' => $tables,'table' => $singular] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\App::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="pt-lg-5 d-flex align-items-center">
        <div class="container-sm d-flex flex-column">
            <div>
                <h1 class="text-smoke">Inserting User</h1>
            </div>
            <form action="<?php echo e(route('tables.' . $singular . '.update', ['id' => $record->id])); ?>" method="POST"
                  enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div
                                class="card-body text-center d-flex justify-content-center flex-column align-items-center">
                                <img
                                    src="<?php echo e(isset($record) ? asset($record['photo'] ?? 'images/default-photo.jpg') : asset( 'images/default-photo.jpg')); ?>"
                                    id="avatar"
                                    alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                <button id="remove" type="button" class="btn btn-outline-danger ms-1">Remove</button>
                                <div class="d-flex flex-column justify-content-center mt-5 w-75">
                                    <label class="form-label file-label" for="input-file">Edit a user profile
                                        image</label>
                                    <input type="file" class="form-control" id="input-file" name="photo"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4 h-100">
                            <div class="card-body h-100">
                                <input type="checkbox" name="remove_photo"   style="display: none">

                                <?php if (isset($component)) { $__componentOriginal786b6632e4e03cdf0a10e8880993f28a = $component; } ?>
<?php $component = App\View\Components\Input::resolve(['type' => 'text','id' => 'name','name' => 'name','label' => 'User name','help' => 'Users can have the same name.','value' => isset($record) ? $record['name'] : null] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Input::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a)): ?>
<?php $component = $__componentOriginal786b6632e4e03cdf0a10e8880993f28a; ?>
<?php unset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a); ?>
<?php endif; ?>

                                <?php if (isset($component)) { $__componentOriginal786b6632e4e03cdf0a10e8880993f28a = $component; } ?>
<?php $component = App\View\Components\Input::resolve(['type' => 'email','id' => 'email','name' => 'email','label' => 'Email','help' => 'The email will be unique.','value' => isset($record) ? $record['email'] : null] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Input::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a)): ?>
<?php $component = $__componentOriginal786b6632e4e03cdf0a10e8880993f28a; ?>
<?php unset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a); ?>
<?php endif; ?>
                            </div>
                            <div class="d-flex gap-3 m-4 mt-0" role="group">
                                <button type="submit" class="btn btn-dark" style="width: 15%">Send</button>
                                <a href="<?php echo e(route($index)); ?>" class="btn btn-danger text-nowrap" style="width: 15%">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php $__env->startPush('scripts'); ?>
        <script>
            $(document).ready(function () {
                $('#input-file').on('change', function () {
                    //get the file name
                    let fileName = $(this).val();
                    //replace the "Choose a file" label
                    $(this).next('.file-label').html(fileName);
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        console.log(e.target.result);
                        $('#avatar').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                })

                $('#remove').on('click', function () {
                    $('#avatar').attr('src', '<?php echo e(asset('images/default-photo.jpg')); ?>');
                    $('#input-file').val('');
                    $(this).next('.file-label').html('Select a user profile image');
                    $('input[name="remove_photo"]').prop('checked', true);
                })
            })
        </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal165f8e34452936f6da18fceb86497519)): ?>
<?php $component = $__componentOriginal165f8e34452936f6da18fceb86497519; ?>
<?php unset($__componentOriginal165f8e34452936f6da18fceb86497519); ?>
<?php endif; ?>


<?php /**PATH C:\Users\higor\PhpstormProjects\VirtualShelf\resources\views/layout/user/edit.blade.php ENDPATH**/ ?>