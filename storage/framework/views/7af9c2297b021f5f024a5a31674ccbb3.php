<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit Profile</h5>
    </div>
    <form method="POST" action="<?php echo e(url('update_profile')); ?>">
        <?php echo csrf_field(); ?>
        <div class="card-body row">
            <div class="col-md-12 mb-3">
                <span>Name</span>
                <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <span>Gender</span>
                <select class="form-select" name="gender" required>
                    <option value="" selected disabled>Please Select Gender</option>
                    <option value="Male" <?php echo e(($user->gender == "Male") ? 'selected' : ''); ?>>Male</option>
                    <option value="Female" <?php echo e(($user->gender == "Female") ? 'selected' : ''); ?>>Female</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <span>DOB</span>
                <input type="date" class="form-control" name="dob" value="<?php echo e($user->dob); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <span>Membership Number</span>
                <input type="text" class="form-control" name="membership_number" value="<?php echo e($user->membership_number); ?>">
            </div>
            <div class="col-md-6 mb-3">
                <span>Address</span>
                <input type="text" class="form-control" name="address" value="<?php echo e($user->address); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <span>Phone no.</span>
                <input type="text" class="form-control" name="phone_no" value="<?php echo e($user->phone_no); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <span>Alt Phone no.</span>
                <input type="text" class="form-control" name="alt_phone_no" value="<?php echo e($user->alt_phone_no); ?>">
            </div>
            <div class="col-md-6 mb-3">
                <span>NOK Name</span>
                <input type="text" class="form-control" name="nok_name" value="<?php echo e($user->nok_name); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <span>NOK Email</span>
                <input type="text" class="form-control" name="nok_email" value="<?php echo e($user->nok_address); ?>">
            </div>
            <div class="col-md-6 mb-3">
                <span>NOK Phone no.</span>
                <input type="text" class="form-control" name="nok_phone_no" value="<?php echo e($user->nok_phone_no); ?>" required>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\redesign\ippu_chat\resources\views/profile/edit.blade.php ENDPATH**/ ?>