<?php $__env->startSection('content'); ?>

<div>
    <h3>Sehr geehrte/r, <?php echo e($name); ?></h3>
    <p>Wir freuen uns über ihre Registrierung bei Youmas.de</p>

    <br />
    Nutzen sie bitte den folgenden Link zur Bestätigung ihrer Email-Adresse: <br>
    <a href="<?php echo e($link); ?>">Email-Adresse verifizieren</a>
    <br /><br />

    <p>Sollten sie Fragen oder Anregungen für uns haben, können sie uns gerne kontaktieren. Dazu stehen unsere Kontaktformulare bereit. Wir werden sie schnellstmöglich kontaktieren.</p>

    Ihr Team von Youmas
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.email', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/email/common/user_registered.blade.php ENDPATH**/ ?>