<?php $__env->startSection('content'); ?>
<main>
    <div id="app">
        <?php if(isset($is_favorite)): ?>
        <business-single-view :auth="<?php echo e(json_encode(true)); ?>" :is_favorite="<?php echo e(json_encode($is_favorite)); ?>" :business-service-categories="<?php echo e(json_encode($business_service_categories)); ?>" :business="<?php echo e(json_encode($business)); ?>"></business-single-view>
        <?php else: ?>
        <business-single-view  :auth="<?php echo e(json_encode(false)); ?>"  :business-service-categories="<?php echo e(json_encode($business_service_categories)); ?>" :business="<?php echo e(json_encode($business)); ?>"></business-single-view>

        <?php endif; ?>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/business/show.blade.php ENDPATH**/ ?>