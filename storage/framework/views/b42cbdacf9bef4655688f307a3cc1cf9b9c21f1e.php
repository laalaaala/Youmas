<?php $__env->startSection('content'); ?>
<!--Title-->

<main class="max-w-lg md:w-1/2 mx-auto flex items-center" id="app">
    <div class="w-full max-w-lg">
        <customer-business-review :business="<?php echo e(json_encode($business)); ?>"></customer-business-review>
    </div>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/business/reviews/create.blade.php ENDPATH**/ ?>