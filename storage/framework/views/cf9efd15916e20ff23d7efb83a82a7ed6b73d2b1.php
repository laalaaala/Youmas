<?php $__env->startSection('content'); ?>
<div id="app" class="w-full">
    <customer-checkout :business="<?php echo e(json_encode($business)); ?>" :business-user="<?php echo e(json_encode($businessUser)); ?>" :customer="<?php echo e(json_encode($customer)); ?>"></customer-checkout>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/checkout.blade.php ENDPATH**/ ?>