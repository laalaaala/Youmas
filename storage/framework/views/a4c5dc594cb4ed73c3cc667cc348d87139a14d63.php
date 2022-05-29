<?php $__env->startSection('content'); ?>

<div class="flex items-center max-w-lg mx-auto mt-12 mb-6 text-center h-100">
    <div class="flex flex-col">
        <div class="flex justify-center w-full mb-10">
            <p class="text-2xl font-bold text-primary-400">Registrieren als</p>
        </div>
        <div class="flex mt-5">
            <div class="w-1/2 mx-10">
                <a href="/register/customer">
                    <img src="/images/customer.svg" class="mx-auto mb-5" width="750">
                    <span class="text-xl font-medium">Kunde</span>
                </a>
            </div>
            <div class="w-1/2 mx-10 mt-2">
                <a href="/register/company">
                    <img src="/images/company.svg" class="mx-auto mb-5">
                    <span class="text-xl font-medium">Unternehmen</span>
                </a>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/auth/register.blade.php ENDPATH**/ ?>