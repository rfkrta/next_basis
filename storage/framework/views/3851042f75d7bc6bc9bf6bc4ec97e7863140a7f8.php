<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title>NextBasis</title>
    <link rel="shortcut icon" href="logo.png" />

    <!-- <?php echo $__env->yieldPushContent('prepend-style'); ?> -->
    <?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- <?php echo $__env->yieldPushContent('addon-style'); ?> -->
</head>

<body>

    <div class="container">
        <?php echo $__env->make('sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->yieldPushContent('prepend-script'); ?>
    <?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('addon-script'); ?>
</body>

</html><?php /**PATH D:\Project\next_basis\resources\views/head.blade.php ENDPATH**/ ?>