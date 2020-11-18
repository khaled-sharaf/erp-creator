<?php $__env->startSection('content'); ?>
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: <?php echo config('hr.name'); ?>

    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('hr::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\creator\erp\Modules/HR\Resources/views/app/hr_index.blade.php ENDPATH**/ ?>