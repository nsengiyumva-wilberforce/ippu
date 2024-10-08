
<?php $__env->startSection('breadcrumb'); ?>
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Reports</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">CPDs Report</li>
        </ol>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form class="row mb-3">
	<div class="col-md-8 row">
		<div class="form-group col-md-6">
			<select class="form-control" name="cpd">
				<option value="*" <?php echo e((is_null(request('cpd'))?'': ((request('cpd') == '*') ? 'selected' : ''))); ?>>All CPDs</option>
				<?php $__currentLoopData = $cpds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cpd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($cpd->id); ?>" <?php echo e((is_null(request('cpd'))?'': ((request('cpd') == $cpd->id) ? 'selected' : ''))); ?>><?php echo e($cpd->topic); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		<div class="form-group col-md-6">
			<select class="form-control" name="status">
				<option value="">Status</option>
				<option value="Attended" <?php echo e((is_null(request('status'))?'': ((request('status') == "Attended") ? 'selected' : ''))); ?>>Attended</option>
				<option value="Pending" <?php echo e((is_null(request('status'))?'': ((request('status') == "Pending") ? 'selected' : ''))); ?>>Pending</option>
			</select>
		</div>
	</div>
	<div class="col-md-4">
		<input type="submit" class="btn btn-primary" name="" value="Search">
	</div>
</form>
<div class="card">
	<div class="card-header">
		<h5>CPDs Reports</h5>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered dataTable">
				<thead>
					<th>CPD</th>
					<th>Member</th>
					<th>Status</th>
					<th>Payment</th>
				</thead>
				<tbody>
					<?php $__currentLoopData = $attendences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($attendence?->cpd?->topic); ?></td>
							<td><?php echo e($attendence?->user?->name); ?></td>
							<td><?php echo e($attendence?->status); ?></td>
							<td><?php echo e(number_format($attendence?->cpd_payment?->amount)); ?></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/ippu.org/resources/views/admin/reports/cpds.blade.php ENDPATH**/ ?>