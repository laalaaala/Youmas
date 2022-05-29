<?php $__env->startSection('content'); ?>
    <div class="w-full" id="app">
    <page-header page="Häufig gestellte Fragen" title="FAQ's"></page-header>
        <faqs-view :faqs="<?php echo e(json_encode($faqs)); ?>"></faqs-view>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/faq.blade.php ENDPATH**/ ?>