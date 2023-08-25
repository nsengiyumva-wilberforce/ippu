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

<?php echo $request->message; ?>


<p>Thank You</p>

</body>
</html>
<?php /**PATH C:\wamp64\www\redesign\ippu_chat\resources\views/mails/reminder.blade.php ENDPATH**/ ?>