<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');

body {
  font-family: 'Poppins', sans-serif;
}
</style>
</head>
<body>

<p>Dear <?php echo e($user->name); ?>,</p>

<p>Your account is now <?php echo e($user->status); ?></p>

<?php if($user->comment): ?>
<p>Comment</p>
<?php echo e($user->comment); ?>

<?php endif; ?>
<p>Thank You</p>

</body>
</html>
<?php /**PATH /var/www/ippu.org/resources/views/mails/account.blade.php ENDPATH**/ ?>