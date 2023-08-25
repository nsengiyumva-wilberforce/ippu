<?php $__env->startSection('breadcrumb'); ?>
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Jobs</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(url('admin/jobs')); ?>">Jobs</a></li>
            <li class="breadcrumb-item active"><?php echo e($job->title); ?> - Edit</li>
        </ol>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="<?php echo e(implode('/', ['','jobs'])); ?>"> Jobs</a></li>
                <li class="breadcrumb-item"><?php echo app('translator')->get('Edit Job'); ?> #<?php echo e($job->id); ?></li>
            </ol>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('jobs.update', compact('job'))); ?>" method="POST" class="m-0 p-0">
                <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?>
                <div class="card-body row">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" value="<?php echo e(@old('title', $job->title)); ?>" />
                        <?php if($errors->has('title')): ?>
                        <div class='error small text-danger'><?php echo e($errors->first('title')); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" class="ckeditor"><?php echo e(@old('description', $job->description)); ?></textarea>
                        <?php if($errors->has('description')): ?>
                        <div class='error small text-danger'><?php echo e($errors->first('description')); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="visible_from" class="form-label">Visible From:</label>
                        <input type="date" name="visible_from" id="visible_from" class="form-control" value="<?php echo e(@old('visible_from', $job->visible_from)); ?>" />
                        <?php if($errors->has('visible_from')): ?>
                        <div class='error small text-danger'><?php echo e($errors->first('visible_from')); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="visible_to" class="form-label">Visible To:</label>
                        <input type="date" name="visible_to" id="visible_to" class="form-control" value="<?php echo e(@old('visible_to', $job->visible_to)); ?>" />
                        <?php if($errors->has('visible_to')): ?>
                        <div class='error small text-danger'><?php echo e($errors->first('visible_to')); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="deadline" class="form-label">Deadline:</label>
                        <input type="date" name="deadline" id="deadline" class="form-control" value="<?php echo e(@old('deadline', $job->deadline)); ?>" />
                        <?php if($errors->has('deadline')): ?>
                        <div class='error small text-danger'><?php echo e($errors->first('deadline')); ?></div>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <a href="<?php echo e(route('jobs.index', [])); ?>" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Update Job'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\redesign\ippu_chat\resources\views/admin/jobs/edit.blade.php ENDPATH**/ ?>