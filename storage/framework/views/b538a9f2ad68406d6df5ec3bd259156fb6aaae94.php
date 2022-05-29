<?php $__env->startSection('content'); ?>
<div id="app" class="h-full">
    <customer-profile :user="<?php echo e(json_encode($user)); ?>" />
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.customerDashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/customer/dashboard.blade.php ENDPATH**/ ?>