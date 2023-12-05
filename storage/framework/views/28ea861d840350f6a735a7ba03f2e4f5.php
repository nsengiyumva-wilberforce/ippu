<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Product-Service & Income-Expense Category')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Categories</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Categories</li>
        </ol>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create constant category')): ?>
            <a href="#" data-url="<?php echo e(route('product-category.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Category')); ?>"  class="btn btn-sm btn-primary">
                <i class="ri-add-fill"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="text-end mb-3">
        
            <a href="#" data-url="<?php echo e(url('admin/product-category/create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Category')); ?>"  class="btn btn-sm btn-primary">
                <i class="ri-add-fill"></i> Create New Category
            </a>
        
    </div>
    <div class="row">
        <div class="col-3">
            
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Category')); ?></th>
                                <th> <?php echo e(__('Type')); ?></th>
                                <th width="10%"> <?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="font-style"><?php echo e($category->name); ?></td>
                                    <td class="font-style">
                                        <?php echo e(__(\App\Models\ProductServiceCategory::$categoryType[$category->type])); ?>

                                    </td>
                                    <td class="Action">
                                        <span>
                                        
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(url('admin/product-category/'.$category->id.'/edit')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Product Category')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" title="<?php echo e(__('Edit')); ?>">
                                                        <i class="las la-edit text-white"></i>
                                                    </a>
                                                </div>
                                            
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete constant category')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['product-category.destroy', $category->id],'id'=>'delete-form-'.$category->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($category->id); ?>').submit();">
                                                        <i class="las la-trash text-white"></i>
                                                    </a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ippu/resources/views/admin/productServiceCategory/index.blade.php ENDPATH**/ ?>