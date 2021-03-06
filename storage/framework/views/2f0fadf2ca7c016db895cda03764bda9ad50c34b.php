<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="/css/app.css" rel="stylesheet">
    <title><?php echo $__env->yieldContent('title'); ?></title>
</head>
<body>
    <div id="app">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
<!-- file function common web -->
<script src="<?php echo e(asset('js/common.js')); ?>"></script>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>

</html><?php /**PATH D:\xampp\htdocs\vimoney_1\resources\views/master/master.blade.php ENDPATH**/ ?>