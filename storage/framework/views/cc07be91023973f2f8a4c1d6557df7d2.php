<?php $__env->startSection('content'); ?>
<?php $__empty_1 = true; $__currentLoopData = $activityLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activityLog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<div class="card">
    <div class="card-body">
        <?php if($activityLog->causer): ?>
        <b><?php echo e($activityLog->causer->name); ?></b> <br> <?php echo e($activityLog->description); ?>

        <br>
        <small>Time: <?php echo e($activityLog->created_at->format('Y-m-d H:i:s')); ?></small>
        <?php else: ?>
        <b>Unkown</b> <br> <?php echo e($activityLog->description); ?>

        <br>
        <small>Time: <?php echo e($activityLog->created_at->format('Y-m-d H:i:s')); ?></small>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="card">
    <div class="card-body">No activity logs found</div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\david\Desktop\work\ippu\ippu\resources\views/admin/audit/index.blade.php ENDPATH**/ ?>