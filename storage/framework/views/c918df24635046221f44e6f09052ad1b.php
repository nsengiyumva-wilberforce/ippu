<?php $__env->startSection('breadcrumb'); ?>
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Jobs</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Jobs</li>
        </ol>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(implode('/', ['','jobs'])); ?>"> Jobs</a></li>
                </ol>

                <form action="<?php echo e(route('jobs.index', [])); ?>" method="GET" class="m-0 p-0">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm me-2" name="search" placeholder="Search Jobs..." value="<?php echo e(request()->search); ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> <?php echo app('translator')->get('Go!'); ?></button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive dataTable table-hover">
    <thead role="rowgroup">
    <tr role="row">
                    <th role='columnheader'>Title</th>
                    <th role='columnheader'>Visible From</th>
                    <th role='columnheader'>Visible To</th>
                    <th role='columnheader'>Deadline</th>
                <th scope="col" data-label="Actions">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
                            <td data-label="Title"><?php echo e($job->title ?: "(blank)"); ?></td>
                            <td data-label="Visible From"><?php echo e(date('d M, y',strtotime($job->visible_from)) ?: "(blank)"); ?></td>
                            <td data-label="Visible To"><?php echo e(date('d M, y',strtotime($job->visible_to)) ?: "(blank)"); ?></td>
                            <td data-label="Deadline"><?php echo e(date('d M, y',strtotime($job->deadline)) ?: "(blank)"); ?></td>

            <td data-label="Actions:" class="text-nowrap">
                                   <a href="<?php echo e(route('jobs.show', compact('job'))); ?>" type="button" class="btn btn-primary btn-sm me-1"><?php echo app('translator')->get('Show'); ?></a>
<div class="btn-group btn-group-sm">
    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="<?php echo e(route('jobs.edit', compact('job'))); ?>"><?php echo app('translator')->get('Edit'); ?></a></li>
        <li>
            <form action="<?php echo e(route('jobs.destroy', compact('job'))); ?>" method="POST" style="display: inline;" class="m-0 p-0">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="dropdown-item"><?php echo app('translator')->get('Delete'); ?></button>
            </form>
        </li>
    </ul>
</div>

                            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

                
            </div>
            <div class="text-center my-2">
                <a href="<?php echo e(route('jobs.create', [])); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('Create new Job'); ?></a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/ippu.org/resources/views/admin/jobs/index.blade.php ENDPATH**/ ?>