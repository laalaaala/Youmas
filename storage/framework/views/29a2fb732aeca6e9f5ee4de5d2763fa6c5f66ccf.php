<?php $__env->startSection('content'); ?>
<div>
    <a href="/faq">
        <div class="flex p-5 bg-white rounded-sm shadow-sm" id="app" style="--tw-shadow: 0px 0px 8px 3px rgb(27 25 25 / 5%);">
            <div class="w-1/2 text-4xl">FAQs</div>

            <div class="w-1/2 text-right">
                <i class="text-4xl fas fa-chevron-right text-secondary-400"></i>
            </div>
        </div>
    </a>
    <div class="py-5 mt-5 bg-white rounded-sm shadow-sm md:p-5" id="app" style="--tw-shadow: 0px 0px 8px 3px rgb(27 25 25 / 5%);">

        <div class="flex">
            <div class="flex flex-col w-1/2 text-center">
                <i class="mb-3 text-4xl fas fa-phone text-primary-400"></i>
                631 34 99 92
            </div>
            <div class="flex flex-col w-1/2 text-center">
                <i class="mb-3 text-4xl fas fa-envelope text-primary-400"></i>
                info@youmas.de
            </div>
        </div>
        <div class="p-5 mt-8 ">
            <div class="font-sans">
                <a href="#" class="text-base font-bold no-underline md:text-sm text-primary-400 hover:underline">Supportanfrage</a>
                <h1 class="pt-6 font-sans text-xl text-gray-900 break-normal"></h1>
                <hr class="border-b border-secondary-400">
                <?php if(session('success')): ?>
                <div class="relative w-full px-6 py-4 mt-5 mb-4 text-center text-white bg-green-500 border-0 rounded">
                    <span class="inline-block mr-5 text-xl align-middle">
                        <i class="fas fa-bell"></i>
                    </span>
                    <span class="inline-block mr-8 align-middle">
                        <?php echo e(session('success')); ?>

                    </span>
                </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                <div class="relative w-full px-6 py-4 mt-5 mb-4 text-center text-white bg-red-500 border-0 rounded">
                    <span class="inline-block mr-5 text-xl align-middle">
                        <i class="fas fa-bell"></i>
                    </span>
                    <span class="inline-block mr-8 align-middle">
                        <?php echo e(session('error')); ?>

                    </span>
                </div>
                <?php endif; ?>
                <form action="/dashboard/support" method="POST">
                    <div class="flex flex-col flex-wrap md:flex-row">
                        <div class="mt-5 lg:w-1/3">
                            <label class="mr-5" for="name">Name</label>
                        </div>
                        <div class="pr-5 mt-2 lg:w-2/3 md:mt-5 lg:pr-0">
                            <input type="text" id="name" name="name" class="w-full p-2 border lg:w-2/3" placeholder="Name">
                        </div>
                        <div class="my-2 lg:w-1/3 md:my-5">
                            <label class="mr-5" for="email">Email</label>
                        </div>
                        <div class="pr-5 mb-2 lg:w-2/3 md:my-5 lg:pr-0">
                            <input type="email" id="email" name="email" class="w-full p-2 border lg:w-2/3" placeholder="Email">
                        </div>
                        <div class="lg:w-1/3">
                            <label class="mr-5" for="message">Nachricht</label>
                        </div>
                        <div class="w-full pr-5 mt-2 lg:pr-0 md:mt-0 md:w-2/3 ">
                            <textarea rows="7" class="w-full p-2 border lg:w-2/3" id="message" name="message" placeholder="Nachricht"></textarea>
                        </div>
                        <div class="flex items-center justify-end w-full mt-3">
                            <button class="inline-block px-4 py-2 text-white rounded shadow-lg bg-primary-400 hover:bg-secondary-400 focus:bg-secondary-400" type="submit">Nachricht absenden</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make( Auth::user()->type != 'business' ? 'layouts.customerDashboard' : 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/dashboard/support.blade.php ENDPATH**/ ?>