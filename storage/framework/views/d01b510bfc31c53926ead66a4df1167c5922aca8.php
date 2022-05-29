<?php $__env->startSection('content'); ?>
<div>
    <h3>Sehr geehrte/r, <?php echo e($name); ?>: </h3>
    <p>Du hast erfolgreich ein neues Passwort für dein Youmas Konto erstellt.</p> <br />

    Sollte dir diese Änderung unbekannt sein, kontaktiere bitte unverzüglich unser Support-Team.
    <br>
    <br>

    Viele Grüße,
    <br>
    Youmas.
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.email', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/email/common/password_change.blade.php ENDPATH**/ ?>