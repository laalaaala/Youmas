<?php $__env->startSection('content'); ?>
<!--Title-->
<div class="font-sans">
    <a href="#" class="text-base font-bold no-underline md:text-sm text-primary-400 hover:underline">Dienstleistungen</a>
    <h1 class="pt-6 pb-2 font-sans text-xl text-gray-900 break-normal"></h1>
</div>
<div class="mt-5 bg-white rounded-sm shadow-sm md:p-5" id="app">
    <business-service-table :services="<?php echo e(json_encode($services)); ?>"></business-service-table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/dashboard/services.blade.php ENDPATH**/ ?>