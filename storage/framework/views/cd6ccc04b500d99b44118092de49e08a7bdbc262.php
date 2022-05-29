<?php $__env->startSection('content'); ?>
    <div>
        <h3>Sehr geehrte/r <?php echo e($customer_name); ?>,</h3>
        Wir bedanken uns für deine Buchung und werden dich noch zweimal vor Terminbeginn per Email erinnern. Wir bitten dich
        rechtzeitig den Termin zu stornieren, falls es nicht möglich ist diesen wahrzunehmen.<br>
        <?php echo e($service_name); ?>, <?php echo e($booking_created_date); ?><br>
        <?php echo e($business_name); ?> in <?php echo e($business_location['street']); ?> <?php echo e($business_location['street_number']); ?> |
        <?php echo e($business_location['zip_code']); ?> | <?php echo e($business_location['city']); ?><br>
        Telefon <?php echo e($business_phone); ?> | Fax: | Email: <?php echo e($business_email); ?><br><br>

        IHRE BUCHUNGSDETAILS IM ÜBERBLICK<br><br>

        <!-- Buchungsnummer: 38672592 -->
        Buchungsdatum: <?php echo e($booking_created_date); ?><br>
        Gebucht über: www.Youmas.de<br>
        Buchungsmodul: <?php echo e($service_name); ?><br>
        
        <!-- Bezahlt: Google Pay -->
        Summe: <?php echo e($total_price); ?>€<br>
        
        Vorname: <?php echo e($customer_first_name); ?><br>
        Nachname: <?php echo e($customer_last_name); ?><br>
        Mobiltelefon: +49 <?php echo e($customer_mobile_phone); ?><br>
        PLZ/Ort: <?php echo e($customer_zip_code); ?> <?php echo e($customer_city); ?><br><br>

        Die nachfolgenden Bedingungen (Abkürzung BHP) werden, soweit gültig vereinbart, Inhalt der Reservierung zwischen
        Kunde und Dienstleister und sind damit Vertragsinhalt. Wir bitten sie darum, diese Bedingungen genau zu lesen und
        unsere AGB zu beachten.<br><br>

        Ihr Youmas-Team<br><br>

        Dies ist eine automatisch generierte E-Mail von einer System-Email-Adresse. Bitte antworte nicht auf diese Mail.
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.email', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/email/booking/created.blade.php ENDPATH**/ ?>