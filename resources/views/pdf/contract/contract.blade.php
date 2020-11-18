<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Contract {{ '#0000' . $contract->id }} </title>
    {!! Html::style('admin/css/pdf/contract.css') !!}
</head>

@php
    $settings = getSettings();
@endphp

<body>

    {{-- <htmlpageheader name="page-header">

    </htmlpageheader> --}}

    {{--  <htmlpagefooter name="page-footer">

    </htmlpagefooter>  --}}

    {{-- <div class="page-break"></div> --}}
    {{--  <div class="page-header">
        <div class="pdf-title">
            <h1 class="title" style="unicode-bidi: plaintext">
                عقد إتفاق مبدئى
            </h1>
        </div>
        <div class="logo">
            <img class="img"
                src="{{ url('/') . '/' . $settings['logo'] }}"
                style="height: 60px; float: left;"
            >
        </div>
    </div>  --}}

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
                src="{{ url('/') . '/' . $settings['logo'] }}"
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
                <b class="label-page">Contract</b> CONT/{{date('Y') . '/' . '0000' . $contract->id}}
            </h2>
            <!-- ========================================================================== -->
            <div class="header-content">
                <div class="line">
                    <div class="date-into f-right">
                        إنه فى يوم
                        <b>{{ $name_days[date('w', strtotime($contract->created_at))] }}</b>
                        الموافق
                        <b>{{ date('d-m-Y', strtotime($contract->created_at)) }}</b>
                        م
                        ،
                        قد تم الإتفاق بين كل من:-
                    </div>
                    <!-- ======================================== -->
                </div>
                <!-- ======================================== -->
                <div class="wrapper-header-content">
                    <div class="first-part">
                        <div class="line">
                            <div class="part-title">
                                <span class="text bold">الطرف الأول</span>
                            </div>
                        </div>
                        <!-- ======================================== -->
                        <div class="wrapper-part">
                            <div class="line">
                                السادة /
                                <b>{{ $settings['app_name_long_arabic'] }}</b>.
                            </div>
                            <!-- ======================================== -->
                            <div class="line">
                                ويمثلها فى هذا العقد السيد /
                                <b>{{ $contract->personalSales->name_ar }}</b>.
                            </div>
                            <!-- ======================================== -->
                            <div class="line">
                                بصفته /
                                <b>{{ $contract->personalSales->jobTitle->name }}</b>.
                            </div>
                            <!-- ======================================== -->
                            <div class="line">
                                الرقم القومى /
                                <b>{{ $contract->personalSales->id_cart }}</b>.
                            </div>
                            <!-- ======================================== -->
                            <div class="line">
                                العنوان /
                                <b>{{ $contract->personalSales->address }}</b>.
                            </div>
                            <!-- ======================================== -->
                            <div class="line">
                                الجنسية /
                                <b>مصرى</b>.
                            </div>
                            <!-- ======================================== -->
                        </div>
                        <!-- ======================================== -->
                    </div>

                    <div class="second-part">
                        <div class="line">
                            <div class="part-title">
                                <span class="text bold">الطرف الثانى</span>
                            </div>
                        </div>
                        <!-- ======================================== -->
                        <div class="wrapper-part">
                            <div class="line">
                                السادة /
                                <b>{{ $contract->lead->company_name }}</b>.
                            </div>
                            <!-- ======================================== -->
                            <div class="line">
                                ويمثلها فى هذا العقد السيد /
                                <b>{{ $contract->lead->name }}</b>.
                            </div>
                            <!-- ======================================== -->
                            <div class="line">
                                بصفته /
                                <b>{{ $contract->job_title_lead }}</b>.
                            </div>
                            <!-- ======================================== -->
                            <div class="line">
                                الرقم القومى /
                                <b>{{ $contract->lead->id_cart }}</b>.
                            </div>
                            <!-- ======================================== -->
                            <div class="line">
                               العنوان /
                                <b>{{ $contract->lead->company_address }}</b>.
                            </div>
                            <!-- ======================================== -->
                            <div class="line">
                                الجنسية /
                                <b>مصرى</b>.
                            </div>
                            <!-- ======================================== -->
                        </div>
                    </div>
                    <!-- ======================================== -->
                </div>
                <!-- ======================================== -->
            </div>
            <!-- ========================================================================== -->

            <div class="introduction">
                <div class="line title">
                    <div class="text-center title-center">
                        <span class="text bold">تمهيد</span>
                    </div>
                </div>
                <!-- ======================================== -->
                <div class="line">
                    حيث أن الطرف الثانى يمتلك:
                    شركة
                    <b>{{ $contract->lead->company_name }}</b>
                    المختصة بمجال
                    <b>{{ $contract->lead->company_scope }}</b>.
                </div>
                <!-- ======================================== -->
                <div class="line">
                    ويرغب فى تسويق مشروعه على مواقع التواصل الإجتماعى وحيث أن الطرف الأول شركة متخصصة فى هذا المجال وتمتلك من الخبرات والأدوات
                    ما يؤهلها للقيام بهذا العمل فقد إلتقت إرداة الطرفين معا وبعد أن أقر كلٌ منهما بأهليتهما للتعاقد إتفقا على مايلى:
                </div>
                <!-- ======================================== -->
                <div class="line">
                    ويكون نظام المحاسبة وفقاَ للجدول التالى:-
                </div>
                <!-- ======================================== -->
            </div>
            <!-- ========================================================================== -->

            <!-- ======================================== -->
            <div class="services">
                <div class="custom-table"
                    style="background-image: url(' {{$settings['logo'] }}');
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
                        @foreach ($contract->services as $service)
                            <div class="row {{ !$loop->last ? 'active' : '' }}">
                                <div class="side bold">{{ $service->originalServices->name }}</div>
                                <div class="side">{{ $service->originalServices->description }}</div>
                                <div class="side price"><span class="amount">{{ $service->amount }}</span> EGP</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- ======================================== -->
                <div class="payments">
                    <div class="wrapper-payments">
                        <div class="row row-total-amount">
                            <div class="side title">Total</div>
                            <div class="side"><span class="price">{{ $contract->total_amount }}</span> EGP</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ========================================================================== -->

            <div class="contract-info">
                <div class="line">
                   حيث أنه يبدأ  فى /
                    <span class="bold main-color">{{ date('d-m-Y', strtotime($contract->start_date)) }}</span>
                    ، وينتهى فى /
                    <span class="bold main-color">{{ date('d-m-Y', strtotime($contract->start_date . ' + '. $contract->duration .' month - 1 day')) }}</span>
                    ،
                    ومدة التجديد كل /
                    <span class="bold main-color">
                        {{ $contract->duration > 1 ? $contract->duration : '' }}
                        {{ $contract->duration > 10 || $contract->duration < 2 ? 'شهر' : 'شهور' }}
                    </span>.
                </div>
                <!-- ======================================== -->
            </div>
            <!-- ========================================================================== -->

            {{--  @if($contract->services->count() > 3)
            @endif  --}}
            <div class="page-break"></div>

            <div class="terms">
                <div class="line">
                    <div class="title-center">
                        <span class="text bold">
                            بموجب هذا العقد إتفقنا على مايلى:-
                        </span>
                    </div>
                </div>
                <!-- ======================================== -->
                <div class="line">
                    <span class="line-number">بند 1</span> -
                    يعد التمهيد السابق جزء لا يتجزأ من هذا العقد ومكملاً له.
                </div>
                <!-- ======================================== -->
                <div class="line">
                    <span class="line-number">بند 2</span> -
                    يلتزم الطرف الأول بعمل الحملة التسويقية الخاصة بمشروع الطرف الثاني المذكور في صدر هذا العقد على أن تكون الحملة
                    على مواقع التواصل الإجتماعى كما هو متفق عليه من بداية تاريخ الحملة التسويقية حتى نهايتها مقابل المبلغ المادي المتفق عليه
                    في هذا العقد.
                </div>
                <!-- ======================================== -->
                <div class="line">
                    <span class="line-number">بند 3</span> -
                    إتفق الطرفان على أن يدفع الطرف الثاني للطرف الأول تكلفة الحملة المذكورة في هذا العقد كدفعة واحدة أو كدفعات
                    كما هو متفق عليه في هذا العقد وإذا تأخر الطرف الثاني في سداد الدفعات المتفق عليها لمدة أسبوعين على الاكثر من تاريخ
                    إستحقاقها يحق للطرف الاول حرية إستكمال أو توقف الحملة.
                </div>
                <!-- ======================================== -->
                <div class="line">
                    <span class="line-number">بند 4</span> -
                    إتفق الطرفان على بعض الشروط والإمتيازات التي يقدمها الطرف الأول للطرف الثاني والمذكورة في البند التمهيدي ويلتزم
                    بها كل طرف تجاه الأخر خلال مدة الحملة.
                </div>
                <!-- ======================================== -->
                <div class="line">
                    <span class="line-number">بند 5</span> -
                    يقر الطرف الثاني بأنه المسئول مسئولية كاملة ومنفردة بمحتوى وجودة المنتجات التي تباع من خلال مشروعة سواء في تاريخ
                    الإنتاج أو بلد المنشأ أو مكوناتها أو جودتها وسلامتها ومدى صلاحية إستخدامها للغرض المصنعة من أجله وعن كل ما يتعلق
                    بالخدمات المقدمة للعملاء والتعاقدات المبرمة بين الطرف الثاني وعملائه ولا يسأل الطرف الأول عن أي ضرر عمدي أو غير عمدي
                    ينتج لأي شخص جراء إستخدامه هذه المنتجات في الغرض المصنعة لأجله أو في الخدمة المقدمة إليه من الطرف الثاني.
                </div>
                <!-- ======================================== -->
                <div class="line">
                    <span class="line-number">بند 6</span> -
                    في حالة توقف الحملة لأي سبب خارج عن إرادة الطرف الأول كقطع خدمة الإنترنت بشكل عام في جمهورية مصر العربية
                    أو ما شابه يلتزم الطرف الأول بإستكمال ما تبقى من مدة الحملة فور زوال هذا المانع أو رد مبلغ مساوي لنسبة ما تبقى من
                    الحملة إذا كان المانع دائم.
                </div>
                <!-- ======================================== -->
                <div class="line">
                    <span class="line-number">بند 7</span> -
                    في حالة رغبة الطرفين معا في تجديد هذا العقد يتم تحرير عقد جديد بشروط جديدة مرضية لهما يتم الإتفاق عليها وقت
                    تجديدة.
                </div>
                <!-- ======================================== -->
                <div class="line">
                    <span class="line-number">بند 8</span> -
                    لا يحق لاي طرفا من الأطرف فسخ العقد من تلقاء نفسه دون الرجوع للطرف الأخر الإبعد تسوية كافة الإلتزامات المستحقة
                    للطرف الأخر.
                </div>
                <!-- ======================================== -->
                <div class="line">
                    <span class="line-number">بند 9</span> -
                    لا يسمح بأي تعديل على هذا العقد سواء بالإضافة أو الشطب أو الكشط الإيموافقة الطرفيين وتوقيعهم بجانب هذا التعديل.
                </div>
                <!-- ======================================== -->
                <div class="line">
                    <span class="line-number">بند 10</span> -
                    في حالة حدوث أي خلاف بين الطرفين تكون محكمة القاهرة الإبتدائية في المختصة بالفصل في النزاع.
                </div>
                <!-- ======================================== -->
                <div class="line">
                    <span class="line-number">بند 11</span> -
                    تحرر هذا العقد من نسختين بيد كل طرف نسخة للعمل بها عند اللزوم.
                </div>
                <!-- ======================================== -->
                <div class="line">
                    <span class="line-number">بند 12</span> -
                    تكون المراسلات والمخاطبات الخاصه بتنفيذ هذا العقد على العنوان الموضح بدباجه هذا العقد وفي حاله تغيير عنوان احد الطرفين يتعين اخطار الطرف الاخر بالعنوان الجديد بخطاب مسجل مصحوب بعلم الوصول والا يعد  العنوان الموضح بالعقد هو العنوان الصحيح وينتج اثاره القانونيه.
                </div>
                <!-- ======================================== -->
                @forelse ($contract->terms()->get() as $key => $term)
                    <div class="line">
                        <span class="line-number">{{ 'بند ' . ($key + 13) }}</span> -
                        {{ $term->content }}
                    </div>
                    <!-- ======================================== -->
                    @empty
                @endforelse
            </div>
            <!-- ========================================================================== -->

        </div>
    </section>
    <!-- ===================================================================================================== -->
    <footer class="footer">
        <div class="signature f-right">
            <div class="title"><b>توقيع الطرف الأول</b></div>
            <div class="signature-place">.................................................</div>
        </div>

        <div class="signature f-left">
            <div class="title"><b>توقيع الطرف الثانى</b></div>
            <div class="signature-place">.................................................</div>
        </div>
    </footer>
    <!-- ===================================================================================================== -->
</body>

</html>
