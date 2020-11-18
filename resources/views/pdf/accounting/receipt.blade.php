<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Receipt {{ '#0000' . $payment->id }} </title>
    @include('pdf.css.invoice')
    @include('pdf.css.receipt')
</head>

<body>

    <!-- ===================================================================================================== -->
    <div class="page-header">
        <div class="pdf-title">
            <div class="line">
                <span class="bold">
                    {{ getSettings('app_name_long') }}
                </span>
            </div>
            <div class="line">
                Tel: {{ getSettings('company_phone') }}
            </div>
            <div class="line">
                <a href="mailto:{{ getSettings('company_email') }}">{{ getSettings('company_email') }}</a>
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


    <!-- ===================================================================================================== -->
    <section class="wrapper-content">
        <div class="content">
            <!-- ========================================================================== -->
            <h2 class="page-title text-center">
                <span class="text">إيصال استلام نقدية</span>
                <div class="border"></div>
            </h2>
            <div class="receipt-id">
                {{ '#0000' . $payment->id }}
            </div>

            <div class="receipt-lines"
                style="background-image: url(' {{$settings['logo'] }}');
                    background-repeat: no-repeat;
                    background-image-opacity: 0.08;
                    background-position: center center;
                    background-size: 70%;
                ">
                <div class="line border">
                    <span class="title">التاريخ / </span>
                    <span class="value"> <span dir="ltr">{{ $payment->date }}</span>.</span>
                </div>
                <div class="line border">
                    <span class="title">استلمنا من السيد / السيدة / </span>
                    <span class="value"> {{ $lead->name }}.</span>
                </div>
                <div class="line{{ $payment->description != null ? ' border' : '' }}">
                    <span class="title">مبلغ وقدره / </span>
                    <span class="value"> {{ $payment->amount }} جنية مصرى. </span>
                </div>
                @if ($payment->description != null)
                <div class="line">
                    <span class="title">وذلك عن / </span>
                    <span class="value"> {{ $payment->description }}.</span>
                </div>
                @endif
            </div>

            <div class="signatures">

                <div class="signature">
                    <div class="title"><b>توقيع المحاسب</b></div>
                    <div class="signature-place">.................................................</div>
                </div>

                <div class="signature">
                    <div class="title"><b>توقيع الإدارة المالية</b></div>
                    <div class="signature-place">.................................................</div>
                </div>

            </div>

        </div>
    </section>
    <!-- ===================================================================================================== -->


    <!-- ===================================================================================================== -->
    <div class="separator-margin-40 border-center"></div>
    <!-- ===================================================================================================== -->


    <!-- ===================================================================================================== -->
    <div class="page-header">
        <div class="pdf-title">
            <div class="line">
                <span class="bold">
                    {{ getSettings('app_name_long') }}
                </span>
            </div>
            <div class="line">
                Tel: {{ getSettings('company_phone') }}
            </div>
            <div class="line">
                <a href="mailto:{{ getSettings('company_email') }}">{{ getSettings('company_email') }}</a>
            </div>
        </div>
        <div class="logo">
            <img class="img"
                src="{{ url('/') . '/' . getSettings('logo') }}"
                style="height: 50px; float: left;"
            >
        </div>
    </div>
    <!-- ===================================================================================================== -->


    <!-- ===================================================================================================== -->
    <section class="wrapper-content">
        <div class="content">
            <!-- ========================================================================== -->
            <h2 class="page-title text-center">
                <span class="text">إيصال استلام نقدية</span>
                <div class="border"></div>
            </h2>
            <div class="receipt-id">
                {{ '#0000' . $payment->id }}
            </div>

            <div class="receipt-lines"
                style="background-image: url('{{ url('/') . '/' . getSettings('logo') }}');
                    background-repeat: no-repeat;
                    background-image-opacity: 0.08;
                    background-position: center center;
                    background-size: 70%;
            ">
                <div class="line border">
                    <span class="title">التاريخ / </span>
                    <span class="value"> <span dir="ltr">{{ $payment->date }}</span>.</span>
                </div>
                <div class="line border">
                    <span class="title">استلمنا من السيد / السيدة / </span>
                    <span class="value"> {{ $lead->name }}.</span>
                </div>
                <div class="line{{ $payment->description != null ? ' border' : '' }}">
                    <span class="title">مبلغ وقدره / </span>
                    <span class="value"> {{ $payment->amount }} جنية مصرى. </span>
                </div>
                @if ($payment->description != null)
                <div class="line">
                    <span class="title">وذلك عن / </span>
                    <span class="value"> {{ $payment->description }}.</span>
                </div>
                @endif
            </div>

            <div class="signatures">

                <div class="signature">
                    <div class="title"><b>توقيع المحاسب</b></div>
                    <div class="signature-place">.................................................</div>
                </div>

                <div class="signature">
                    <div class="title"><b>توقيع الإدارة المالية</b></div>
                    <div class="signature-place">.................................................</div>
                </div>

            </div>

        </div>
    </section>
    <!-- ===================================================================================================== -->


</body>
</html>
