<?php $__env->startSection('content'); ?>
<div id="app">
    <admin-profile :user="<?php echo e(json_encode($user)); ?>"></admin-profile>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>