<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&display=swap&subset=arabic">
    <!-- ================================================================================== -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- ================================================================================== -->

    
    <style>
        body {
            margin: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }
        ol,
        ul,
        dl {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        ol ol,
        ul ul,
        ol ul,
        ul ol {
            margin-bottom: 0;
        }
        a {
            color: #007bff;
            text-decoration: none;
            background-color: transparent;
        }
        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        a:not([href]):not([tabindex]) {
            color: inherit;
            text-decoration: none;
        }
        a:not([href]):not([tabindex]):hover, a:not([href]):not([tabindex]):focus {
            color: inherit;
            text-decoration: none;
        }
        a:not([href]):not([tabindex]):focus {
            outline: 0;
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .btn:hover {
            color: #212529;
            text-decoration: none;
        }
        .btn:focus, .btn.focus {
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .btn-primary:focus, .btn-primary.focus {
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        }
        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            color: #fff;
            background-color: #5a6268;
            border-color: #545b62;
        }
        .btn-secondary:focus, .btn-secondary.focus {
            box-shadow: 0 0 0 0.2rem rgba(130, 138, 145, 0.5);
        }
        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            color: #fff;
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-success:focus, .btn-success.focus {
            box-shadow: 0 0 0 0.2rem rgba(72, 180, 97, 0.5);
        }
        .btn-info {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-info:hover {
            color: #fff;
            background-color: #138496;
            border-color: #117a8b;
        }
        .btn-info:focus, .btn-info.focus {
            box-shadow: 0 0 0 0.2rem rgba(58, 176, 195, 0.5);
        }
        .btn-warning {
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-warning:hover {
            color: #212529;
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-warning:focus, .btn-warning.focus {
            box-shadow: 0 0 0 0.2rem rgba(222, 170, 12, 0.5);
        }
        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-danger:focus, .btn-danger.focus {
            box-shadow: 0 0 0 0.2rem rgba(225, 83, 97, 0.5);
        }
        .btn-light {
            color: #212529;
            background-color: #f8f9fa;
            border-color: #f8f9fa;
        }
        .btn-light:hover {
            color: #212529;
            background-color: #e2e6ea;
            border-color: #dae0e5;
        }
        .btn-light:focus, .btn-light.focus {
            box-shadow: 0 0 0 0.2rem rgba(216, 217, 219, 0.5);
        }
        .btn-dark {
            color: #fff;
            background-color: #343a40;
            border-color: #343a40;
        }
        .btn-dark:hover {
            color: #fff;
            background-color: #23272b;
            border-color: #1d2124;
        }
        .btn-dark:focus, .btn-dark.focus {
            box-shadow: 0 0 0 0.2rem rgba(82, 88, 93, 0.5);
        }
        .btn-sm, .btn-group-sm > .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        .btn-block {
            display: block;
            width: 100%;
        }
        .btn-block + .btn-block {
            margin-top: 0.5rem;
        }
        input[type="submit"].btn-block,
        input[type="reset"].btn-block,
        input[type="button"].btn-block {
            width: 100%;
        }
        .float-left {
            float: left !important;
        }
        .float-right {
            float: right !important;
        }
        .float-none {
            float: none !important;
        }
    </style>

    <style>
        *,
        *::before,
        *::after {
        box-sizing: border-box;
        }

        body {
        font-family: "Nunito", sans-serif !important;
        margin: 0;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        }

        a {
        color: #007bff;
        text-decoration: none;
        background-color: transparent;
        }

        a:hover {
        color: #0056b3;
        text-decoration: underline;
        }

        a:not([href]) {
        color: inherit;
        text-decoration: none;
        }

        a:not([href]):hover {
        color: inherit;
        text-decoration: none;
        }

        .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        }

        @media (min-width: 576px) {
        .container {
            max-width: 540px;
        }
        }

        @media (min-width: 768px) {
        .container {
            max-width: 720px;
        }
        }

        @media (min-width: 992px) {
        .container {
            max-width: 960px;
        }
        }

        @media (min-width: 1200px) {
        .container {
            max-width: 1140px;
        }
        }

        .email-wrapper {
        background-color: #F5F5F5;
        min-height: 100vh;
        font-family: "Nunito", sans-serif !important;
        /**********************************************/
        /* ./main-header ************************************/
        /* ./main-content ************************************/
        /* ************************************************/
        /* ./main-footer ************************************/
        }

        @media (max-width: 400px) {
        .email-wrapper {
            font-size: 13px;
        }
        }

        .email-wrapper .rtl {
        direction: rtl !important;
        font-family: "Cairo", sans-serif, "Arial", "Verdana" !important;
        text-align: right !important;
        }

        .email-wrapper .ltr {
        direction: ltr !important;
        font-family: "Nunito", sans-serif !important;
        text-align: left !important;
        }

        .email-wrapper .bold {
        font-weight: bold;
        }

        .email-wrapper .d-block {
        display: block;
        }

        .email-wrapper .d-inline-block {
        display: inline-block;
        }

        .email-wrapper .d-none {
        display: none;
        }

        .email-wrapper .float-left,
        .email-wrapper .f-left {
        float: left;
        }

        .email-wrapper .float-right,
        .email-wrapper .f-right {
        float: right;
        }

        .email-wrapper .text-left {
        text-align: left;
        }

        .email-wrapper .text-right {
        text-align: right;
        }

        .email-wrapper .main-header {
        padding-top: 40px;
        padding-bottom: 10px;
        overflow: hidden;
        }

        .email-wrapper .main-header .logo {
        float: left;
        }

        .email-wrapper .main-header .logo .img {
        height: 90px;
        }

        @media (max-width: 768px) {
        .email-wrapper .main-header .logo .img {
            height: 70px;
        }
        }

        @media (max-width: 500px) {
        .email-wrapper .main-header .logo .img {
            height: 60px;
        }
        }

        @media (max-width: 400px) {
        .email-wrapper .main-header .logo .img {
            height: 45px;
        }
        }

        .email-wrapper .main-header .header-info {
        padding-top: 12px;
        float: right;
        text-align: right;
        }

        @media (max-width: 768px) {
        .email-wrapper .main-header .header-info {
            padding-top: 0px;
        }
        }

        .email-wrapper .main-content {
        background-color: #FFF;
        border-radius: 3px;
        /* ./mail-content ************************************/
        }

        .email-wrapper .main-content .header-content .background-message {
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        background-color: #333;
        text-align: center;
        padding: 15px 0;
        }

        .email-wrapper .main-content .header-content .background-message .image img {
        width: 70px;
        opacity: 1;
        }

        @media (max-width: 768px) {
        .email-wrapper .main-content .header-content .background-message .image img {
            width: 50px;
        }
        }

        .email-wrapper .main-content .mail-content {
        border: 1px solid #DDD;
        /* ./mail-subject ************************************/
        }

        .email-wrapper .main-content .mail-content .mail-subject {
        padding: 20px 0;
        text-align: center;
        margin-bottom: 20px;
        border-top: 0;
        }

        .email-wrapper .main-content .mail-content .mail-subject .subject {
        font-weight: bold;
        }

        @media (max-width: 768px) {
        .email-wrapper .main-content .mail-content .mail-subject .subject {
            font-size: 28px;
        }
        }

        @media (max-width: 500px) {
        .email-wrapper .main-content .mail-content .mail-subject .subject {
            font-size: 24px;
        }
        }

        .email-wrapper .main-content .mail-content .message {
        padding: 15px;
        word-wrap: break-word;
        }

        @media (min-width: 500px) {
        .email-wrapper .main-content .mail-content .message {
            width: 80%;
            margin: auto;
        }
        }

        .email-wrapper .main-footer {
        margin-top: 70px;
        text-align: center;
        }

        .email-wrapper .main-footer .social .link {
        width: 30px;
        height: 30px;
        margin: 0 2px;
        display: inline-block;
        }

        .email-wrapper .main-footer .social .link img {
        width: 100%;
        }

        .email-wrapper .main-footer .copyright {
        border-top: 1px solid #CCC;
        padding: 25px 0;
        color: #888;
        margin-top: 25px;
        }

        .email-wrapper .main-footer .copyright .mark {
        color: #555;
        cursor: pointer;
        }


        /*# sourceMappingURL=main.css.map*/
    </style>
    <!-- ================================================================================== -->

</head>
<body>
    
    <div class="email-wrapper">
        <div class="container">

            
            <div class="main-header">
                <div class="logo">
                    <?php echo e(Html::image($settings['logo'], 'Logo', ['class' => 'img'])); ?>

                </div>

                <div class="header-info">
                    <div class="line">
                        <b>
                            <?php echo e($settings['app_name_long']); ?>

                        </b>
                    </div>
                    <div class="line">
                        Tel: <?php echo e($settings['company_phone']); ?>

                    </div>
                    <div class="line">
                        <a href="mailto:<?php echo e($settings['company_email']); ?>"><?php echo e($settings['company_email']); ?></a>
                    </div>
                </div>
            </div>
            


            
            <div class="main-content">

                
                <div class="header-content">
                    <div class="background-message">
                        <div class="image">
                            <img src="<?php echo e(url('admin/images/logo-message.png')); ?>">
                        </div>
                    </div>
                </div>
                

                
                <div class="mail-content">

                    
                    <div class="mail-subject">
                        <h1 class="subject">
                            <?php echo $__env->yieldContent('subject'); ?>
                        </h1>
                    </div>
                    


                    <div class="message">
                        <?php echo $__env->yieldContent('data'); ?>
                    </div>
                </div>
                


            </div>
            




            
            <div class="main-footer">
                <div class="social">
                    <a class="link facebook" target="_blank" href="https://www.facebook.com/creatorsocialmedia/">
                        <img src="<?php echo e(url('admin/images/brands/facebook-logo.png')); ?>" alt="facebook">
                        
                    </a>
                    <a class="link instagram" target="_blank" href="https://instagram.com/creator_advertising?igshid=1r9bxiiccyckj">
                        <img src="<?php echo e(url('admin/images/brands/instagram-logo.png')); ?>" alt="instagram">
                        
                    </a>
                    <a class="link twitter" target="_blank" href="https://twitter.com/Creator_adv_eg?s=08">
                        <img src="<?php echo e(url('admin/images/brands/twitter-logo.png')); ?>" alt="twitter">
                        
                    </a>
                    <a class="link linkedin" target="_blank" href="https://www.linkedin.com/in/mohamed-abo-elala">
                        <img src="<?php echo e(url('admin/images/brands/linkedin-logo.png')); ?>" alt="linkedin">
                        
                    </a>
                </div>

                <div class="copyright">
                    Copyright &copy; <?php echo e(date('Y')); ?>

                    <a href="#" class="mark"><?php echo e($settings['app_name_long']); ?></a>,
                    All rights reserved.
                </div>

            </div>
            

        </div>
    </div>


</body>
</html>
<?php /**PATH C:\xampp\htdocs\creator\erp\resources\views/emails/app.blade.php ENDPATH**/ ?>