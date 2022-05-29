<?php $__env->startSection('content'); ?>
<!--Title-->
<div class="font-sans">
    <a href="#" class="text-base font-bold no-underline md:text-sm text-primary-400 hover:underline">Profile</a>
    <h1 class="pt-6 pb-2 font-sans text-xl text-gray-900 break-normal"></h1>
</div>
<div id="app">

    <business-profile-image-carousel></business-profile-image-carousel>
    <hr class="border-b border-secondary-400">
    <!-- About -->
    <div class="flex flex-col xl:flex-row">
        <business-profile-opening-hours> </business-profile-opening-hours>
        <business-profile :user="<?php echo e(json_encode($user)); ?>" class="xl:w-3/4" />
    </div>
    <div class="w-full mt-2">
        <?php if(!$user->stripeAccount && $user->subscription->plan_name == 'Golden'): ?>
        <form action="/dashboard/profile/stripe">
            <?php echo csrf_field(); ?>
            <button class="px-10 py-1 font-bold text-white bg-purple-400 rounded">Connect Stripe Account</button>
        </form>
        <?php elseif($user->stripeAccount && $user->subscription->plan_name == 'Golden'): ?>
        <form action="/dashboard/profile/stripe/deauthorize" method="POST">
            <button class="px-10 py-1 font-bold text-white bg-purple-400 rounded">Disconnect Stripe Account</button>
        </form>
        <?php endif; ?>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/business/dashboard.blade.php ENDPATH**/ ?>