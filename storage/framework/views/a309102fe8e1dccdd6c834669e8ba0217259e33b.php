

<?php $__env->startSection('subject', $subject); ?>

<?php $__env->startSection('data'); ?>

    <div>
        Dear
        <div class="d-inline-block ltr bold"> <?php echo e($data['name']); ?> </div>.
        <br>
        We are glad to have confidence in 
        <div class="d-inline-block ltr bold"> <?php echo e($settings['app_name_long']); ?> </div>
        We always strive to provide our best experiences to be one of our success partners and join them as one of our respected clients.
        <br>

        You can also view the quotation in the attachments or through this link
        <a target="_blank" href="<?php echo e(url('quotation/pdf/' . $data['secret_id'] . '/view')); ?>"> <?php echo e(url('quotation/pdf/' . $data['secret_id'] . '/view')); ?> </a>
        <br>
        We hope to obtain your satisfaction.
    </div>

    <br>
    <br>

    <div class="rtl">
        عزيزى
        <div class="d-inline-block ltr bold"> <?php echo e($data['name']); ?> </div>.
        <br>
        سعداء لثقتك فى شركة 
        <div class="d-inline-block ltr bold"> <?php echo e($settings['app_name_long']); ?> </div>
        ونسعى دائما لتقديم أفضل ما لدينا من خبرات لتكون أحد شركاء نجاحنا والإنضمام إليها كأحد عملائنا المحترمين.
        <br>

        ويمكنك أيضا الاطلاع على عرض الاسعار الخاص بكم طرفنا من المرفقات أو من خلال هذا الرابط
        <a target="_blank" href="<?php echo e(url('quotation/pdf/' . $data['secret_id'] . '/view')); ?>"> <?php echo e(url('quotation/pdf/' . $data['secret_id'] . '/view')); ?> </a>
        <br>
        ونتمنى ان ينال رضاكم.
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('emails.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/o81ha81bwxnl/public_html/erp.creatoreg.com/project/resources/views/emails/send/send_quotation_to_lead.blade.php ENDPATH**/ ?>