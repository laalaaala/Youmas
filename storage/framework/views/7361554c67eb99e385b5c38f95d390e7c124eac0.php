<?php $__env->startSection('content'); ?>
<!--Title-->
<div class="font-sans">
    <a href="#" class="text-base font-bold no-underline md:text-sm text-primary-400 hover:underline">Buchungen</a>
    <h1 class="pt-6 pb-2 font-sans text-xl text-gray-900 break-normal"></h1>
</div>
<div class="p-5 mt-5 bg-white rounded-sm shadow-sm" id="app">
    <business-booking-calendar :employees="<?php echo e(json_encode($employees)); ?>" :user="<?php echo e(json_encode($user)); ?>"></business-booking-calendar>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/dashboard/booking-calendar.blade.php ENDPATH**/ ?>