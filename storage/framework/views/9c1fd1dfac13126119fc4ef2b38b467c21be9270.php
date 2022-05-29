<?php $__env->startSection('content'); ?>

<!--Title-->
<div id="app">    
    <div class="font-sans">
        <a href="#" class="text-base font-bold no-underline md:text-sm text-primary-400 hover:underline">Statistics</a>
        <h1 class="pt-6 pb-2 font-sans text-xl text-gray-900 break-normal"></h1>
    </div>
    
    <business-statistics></business-statistics>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/business/statistics/index.blade.php ENDPATH**/ ?>