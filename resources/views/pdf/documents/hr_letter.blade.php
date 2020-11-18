<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>HR Letter</title>
    @include('pdf.css.hr_letter')
</head>

@php
    $settings = getSettings();
@endphp

<body>


    {{-- <htmlpagefooter name="page-footer">
        
    </htmlpagefooter> --}}

    {{-- <div class="page-break"></div> --}}
    <div class="page-header">
        <div class="pdf-title">
            <div class="line">
                <span class="bold">
                    {{ $settings['app_name_long'] }}
                </span>
            </div>
            <div class="line">
                Tel: {{ $settings['company_phone'] }}
            </div>
            <div class="line">
                <a href="mailto:{{ $settings['company_email'] }}">{{ $settings['company_email'] }}</a>
            </div>
        </div>
        <div class="logo">
            <img class="img"
                src="{{$settings['logo']}}"
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
                <div class="label-page">
                    خطاب موجه لجهة 
                    (
                    <span class="main-color">
                        البنك التجاري الدولي CIB
                    </span>
                    )
                </div>
            </h2>

            <div class="subtitle">
                تحية طيبة وبعد ،،،
            </div>

            <div class="section-content">
                <div class="line">
                    <b>تشهد شركة / </b> {{ $settings['app_name_long_arabic'] . ' ' . $settings['app_name_long'] }}.
                </div>
                <div class="line">
                    <b>ويمثلها قانونا الأستاذ / </b> محمد أبو العلا صديق.
                </div>
                <div class="line">
                    <b>سجل تجارى رقم / </b> 213558.
                </div>
                <div class="line">
                    <b>ومقرها الرئيسى / </b> 32 برج المروة - مصطفى النحاس - مدينة نصر - القاهرة.
                </div>
                <div class="line">
                    <b>نعلم سيادتكم بأن السيد / </b> خالد محمد شرف الدين إبراهيم.
                </div>
                <div class="line">
                    <b>يحمل بطاقة برقم / </b> 29708030103434.
                </div>
                <div class="line">
                    <b>يعمل لدينا تحت المسمى الوظيفي / </b> Full stack web developer.
                </div>
                <div class="line">
                    <b>بمرتب / </b> ستة آلاف جنيه مصرى - (6000).
                </div>
                <div class="line">
                    <b>وذلك اعتبارا من / </b> 
                    <span class="main-color">01 / 01 / 2020</span>
                    حتى تاريخه هذا.
                </div>
                <div class="line">
                    <b>وتمت الموافقة له من قبل الإدارة على هذا البيان من تاريخ / </b>
                    <span class="main-color">06 / 04 / 2020</span>
                    حتى 
                    <span class="main-color">30 / 04 / 2020</span>
                    .
                </div>
                <div class="line">
                    <b>وقد تم إصدار هذا البيان بناء على طلب المذكور دون أدنى مسئولية على الشركة.</b>
                </div>
            </div>


            <div class="subtitle mt-60">
                وتفضلوا بقبوله بوافر الاحترام والتقدير ...
            </div>




            <footer class="footer">
                <div class="signature-footer">
                    <div class="signature">
                        <div class="title">توقيع المدير العام</div>
                        <div class="place">..........................................</div>
                    </div>
                </div>
            </footer>


        </div>
    </section>
    <!-- ===================================================================================================== -->

</body>
</html>
