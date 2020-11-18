<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice <?php echo e('#0000' . $contract->id); ?> </title>
    <?php echo $__env->make('pdf.css.invoice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>

<body>

    

    <htmlpagefooter name="page-footer">
        <footer class="footer">
            <div class="address">
                <div class="text"><?php echo e(getSettings('company_address')); ?></div>
            </div>
        </footer>
    </htmlpagefooter>

    
    <div class="page-header">
        <div class="pdf-title">
            <div class="line">
                <span class="bold">
                    <?php echo e(getSettings('app_name_long')); ?>

                </span>
            </div>
            <div class="line">
                Tel: <?php echo e(getSettings('company_phone')); ?>

            </div>
            <div class="line">
                <a href="mailto:<?php echo e(getSettings('company_email')); ?>"><?php echo e(getSettings('company_email')); ?></a>
            </div>
        </div>
        <div class="logo">
            <img class="img"
                src="<?php echo e(url('/') . '/' . getSettings('logo')); ?>"
                style="height: 70px; float: left;"
            >
        </div>
    </div>

    <!-- ===================================================================================================== -->
    <div class="clear"></div>
    <!-- ===================================================================================================== -->

    <section class="wrapper-content">
        <div class="content">
            <!-- ========================================================================== -->
            <h2 class="page-title">
                <b class="label-page">Invoice</b> INV/<?php echo e(date('Y') . '/' . '0000' . $contract->id); ?>

            </h2>

            <div class="dates">
                <div class="date">
                    <div class="header">Invoice Date</div>
                    <div class="value"><?php echo e(date('Y-m-d')); ?></div>
                </div>

                <div class="date">
                    <div class="header">Contracting Date</div>
                    <div class="value"><?php echo e($contract->start_date); ?></div>
                </div>

                <div class="date">
                    <div class="header">Reference</div>
                    <div class="value">INV/<?php echo e(date('Y') . '/' . '0000' . $contract->id); ?></div>
                </div>


                <div class="date">
                    <div class="header">Client name</div>
                    <div class="value"><?php echo e($contract['lead']['name']); ?></div>
                </div>

                <div class="date">
                    <div class="header">Client phone</div>
                    <div class="value"><?php echo e($contract['lead']['phone']); ?></div>
                </div>

                <div class="date">
                    <div class="header">Personal sales</div>
                    <div class="value"><?php echo e($contract['personalSales']['name']); ?></div>
                </div>

                <?php if($contract->lead->company_address != null): ?>
                    <div class="date address">
                        <div class="header">Company address</div>
                        <div class="value"><?php echo e($contract['lead']['company_address']); ?></div>
                    </div>
                <?php endif; ?>

            </div>


            <div class="services">
                <!-- ======================================== -->
                <div class="custom-table"
                    style="background-image: url('<?php echo e(url('/') . '/' . getSettings('logo')); ?>');
                            background-repeat: no-repeat;
                            background-image-opacity: 0.08;
                            background-position: center center;
                            background-size: 70%;
                ">

                    <div class="head">
                        <div class="row">
                            <div class="side">Service</div>
                            <div class="side">Description</div>
                            <div class="side price">Amount</div>
                        </div>
                    </div>

                    <div class="body">
                        <?php $__currentLoopData = $contract->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row <?php echo e(!$loop->last ? 'active' : ''); ?>">
                                <div class="side bold"><?php echo e($service['originalServices']['name']); ?></div>
                                <div class="side"><?php echo e($service['originalServices']['description']); ?></div>
                                <div class="side price"><span class="amount"><?php echo e($service['amount']); ?></span> EGP</div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <!-- ======================================== -->
                <div class="payments">
                    <div class="wrapper-payments">
                        
                        <div class="row row-total-amount">
                            <div class="side title">Total</div>
                            <div class="side"><span class="price"><?php echo e($contract->total_amount); ?></span> EGP</div>
                        </div>

                        
                        <?php $__currentLoopData = $contract->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row row-paid-amount">
                                <div class="side title">Paid on <?php echo e($payment->date); ?></div>
                                <div class="side"><span class="price"><?php echo e($payment->amount); ?></span> EGP</div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        

                        <div class="row row-amount-due">
                            <div class="side title">Amount Due</div>
                            <div class="side"><span class="price"><?php echo e($contract->total_amount - $contract->paid_amount); ?></span> EGP</div>
                        </div>

                    </div>
                </div>

                <!-- ======================================== -->
            </div>
            <!-- ========================================================================== -->

            <div class="terms">
                <!-- ======================================== -->
                <div class="line">
                    <?php echo getSettings('invoice_terms'); ?>

                </div>
                <!-- ======================================== -->
            </div>
            <!-- ========================================================================== -->

        </div>
    </section>
    <!-- ===================================================================================================== -->

</body>
</html>
<?php /**PATH /home/o81ha81bwxnl/public_html/erp.creatoreg.com/project/resources/views/pdf/contract/invoice.blade.php ENDPATH**/ ?>