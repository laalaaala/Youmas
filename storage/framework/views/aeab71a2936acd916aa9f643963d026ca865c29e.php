<?php $__env->startSection('content'); ?>
<!--Title-->

<div id="app" class="">
    <!-- Subscription Payment -->
    <?php if(!$subscription || $subscription->status == 'inactive'): ?>
    <business-subscription :user="<?php echo e(json_encode($user)); ?>"></business-subscription>
    <!-- Subscription Detail -->
    <?php else: ?>
    <business-subscription-detail :subscription="<?php echo e(json_encode($subscription)); ?>"></business-subscription-detail>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/business/subscriptions/index.blade.php ENDPATH**/ ?>