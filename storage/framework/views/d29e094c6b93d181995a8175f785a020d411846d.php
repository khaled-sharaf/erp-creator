<?php $__env->startSection('subject', $subject); ?>

<?php $__env->startSection('data'); ?>

    <div>
        Glad to join the Google 
        <div class="d-inline-block ltr bold">
            <?php echo e($settings['app_name_long']); ?>

        </div>
        team.
        <br>

        You can log in through this link
        <a href="<?php echo e(url('/login')); ?>" target="_blank"><?php echo e(url('/login')); ?></a>.

        <br>
        <br>

        <div class="bold">
            Login Information:
        </div>
        <span class="bold">Email:</span> <?php echo e($data['email']); ?>

        <br>
        <span class="bold">Password:</span> <?php echo e($data['password']); ?>

        <br>
        <br>
        Please complete your profile information through this link
        <a href="<?php echo e(url('/hr/users/'. $data["id"] . '/edit')); ?>" target="_blank"><?php echo e(url('/hr/users/'. $data["id"] . '/edit')); ?></a>.
    </div>

    <br>
    <br>

    <div class="rtl">
        
        سعداء لانضمامك لفريق شركة
        <div class="d-inline-block ltr bold">
            <?php echo e($settings['app_name_long']); ?>

        </div>.
        <br>

        يمكنك تسجيل الدخول من خلال هذا الرابط
        <a href="<?php echo e(url('/login')); ?>" target="_blank"><?php echo e(url('/login')); ?></a>.

        <br>
        <br>

        <div class="bold">
            بيانات الدخول:
        </div>
        <div class="ltr">
            <span class="bold">Email:</span> <?php echo e($data['email']); ?>

            <br>
            <span class="bold">Password:</span> <?php echo e($data['password']); ?>

        </div>
        <br>
        <br>
        يرجى استكمال بيانات الملف الشخصي الخاص بك من خلال هذا الرابط

        <a href="<?php echo e(url('/hr/users/'. $data["id"] . '/edit')); ?>" target="_blank"><?php echo e(url('/hr/users/'. $data["id"] . '/edit')); ?></a>.
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\creator\erp\resources\views/emails/send/welcome_user.blade.php ENDPATH**/ ?>