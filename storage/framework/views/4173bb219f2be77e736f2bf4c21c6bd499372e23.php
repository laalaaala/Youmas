<?php $__env->startSection('content'); ?>
<div>
    <h3>Guten Tag <?php echo e($business_name); ?></h3>: <br />
    die folgende Buchung wurde mit der Buchungsnummer <?php echo e($booking_number); ?> am <?php echo e($cancelled_time); ?> vor Ablauf der festgelegten Frist erfolgreich storniert.<br><br>

    <strong>Buchungsdetails im Überblick </strong><br>
    <strong>Buchungsnummer:</strong> <?php echo e($booking_number); ?> <br>
    <strong>Buchungsdatum:</strong> <?php echo e($booking_start); ?> <br>
    <strong>Gebucht über:</strong> www.Youmas.de <br>
    <strong>Buchungsmodul:</strong> <?php echo e($service_name); ?> <br>
    <!-- <strong>Zeitraum:</strong> <?php echo e($cancelled_time); ?> <br> -->
    <!-- Bezahlt per: Per Bar/Google Pay -->
    <strong>Summe:</strong> <?php echo e($total_price); ?>€ <br>
    <br><br>
    Hierbei handelt es sich um eine automatisch generierte E-Mail einer System-Email. Bitte antworte nicht auf diese Mail.
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.email', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/email/business/booking_cancelled.blade.php ENDPATH**/ ?>