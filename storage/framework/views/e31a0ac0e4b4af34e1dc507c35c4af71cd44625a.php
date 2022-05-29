<?php $__env->startSection('content'); ?>
<div class="mt-5 bg-white rounded-sm shadow-sm md:p-5" id="app">
    <customer-favorites :favorites="<?php echo e(json_encode($favs)); ?>"></customer-favorites>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.customerDashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/dashboard/favorites.blade.php ENDPATH**/ ?>