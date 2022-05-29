<?php $__env->startSection('content'); ?>
<div class="p-5 pt-0 bg-white rounded-sm shadow-sm" id="app">
    <customer-booking-table :bookings="<?php echo e(json_encode($bookings)); ?>"></customer-booking-table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.customerDashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/customer/bookings.blade.php ENDPATH**/ ?>