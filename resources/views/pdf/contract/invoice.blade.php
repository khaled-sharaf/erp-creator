<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice {{ '#0000' . $contract->id }} </title>
    @include('pdf.css.invoice')

</head>

<body>

    {{-- <htmlpageheader name="page-header">

    </htmlpageheader> --}}

    <htmlpagefooter name="page-footer">
        <footer class="footer">
            <div class="address">
                <div class="text">{{ getSettings('company_address') }}</div>
            </div>
        </footer>
    </htmlpagefooter>

    {{-- <div class="page-break"></div> --}}
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
                <b class="label-page">Invoice</b> INV/{{date('Y') . '/' . '0000' . $contract->id}}
            </h2>

            <div class="dates">
                <div class="date">
                    <div class="header">Invoice Date</div>
                    <div class="value">{{ date('Y-m-d') }}</div>
                </div>

                <div class="date">
                    <div class="header">Contracting Date</div>
                    <div class="value">{{ $contract->start_date }}</div>
                </div>

                <div class="date">
                    <div class="header">Reference</div>
                    <div class="value">INV/{{ date('Y') . '/' . '0000' . $contract->id }}</div>
                </div>


                <div class="date">
                    <div class="header">Client name</div>
                    <div class="value">{{ $contract['lead']['name'] }}</div>
                </div>

                <div class="date">
                    <div class="header">Client phone</div>
                    <div class="value">{{ $contract['lead']['phone'] }}</div>
                </div>

                <div class="date">
                    <div class="header">Personal sales</div>
                    <div class="value">{{ $contract['personalSales']['name'] }}</div>
                </div>

                @if($contract->lead->company_address != null)
                    <div class="date address">
                        <div class="header">Company address</div>
                        <div class="value">{{ $contract['lead']['company_address'] }}</div>
                    </div>
                @endif

            </div>


            <div class="services">
                <!-- ======================================== -->
                <div class="custom-table"
                    style="background-image: url('{{ url('/') . '/' . getSettings('logo') }}');
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
                                <div class="side bold">{{ $service['originalServices']['name'] }}</div>
                                <div class="side">{{ $service['originalServices']['description'] }}</div>
                                <div class="side price"><span class="amount">{{ $service['amount'] }}</span> EGP</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- ======================================== -->
                <div class="payments">
                    <div class="wrapper-payments">
                        {{--  <div class="row row-services-amount">
                            <div class="side title">Subtotal</div>
                            <div class="side"><span class="price">{{ $contract->services_amount }}</span> EGP</div>
                        </div>
                        <div class="row row-tax-amount">
                            <div class="side title">Taxes</div>
                            <div class="side">
                                <div><span class="tax">{{ $contract->tax }}%</span> <span class="price">{{ ($contract->services_amount * ($contract->tax / 100)) }}</span> EGP</div>
                            </div>
                        </div>  --}}
                        <div class="row row-total-amount">
                            <div class="side title">Total</div>
                            <div class="side"><span class="price">{{ $contract->total_amount }}</span> EGP</div>
                        </div>

                        {{-- payments paids --}}
                        @foreach ($contract->payments as $payment)
                            <div class="row row-paid-amount">
                                <div class="side title">Paid on {{ $payment->date }}</div>
                                <div class="side"><span class="price">{{ $payment->amount }}</span> EGP</div>
                            </div>
                        @endforeach
                        {{-- ./payments paids --}}

                        <div class="row row-amount-due">
                            <div class="side title">Amount Due</div>
                            <div class="side"><span class="price">{{ $contract->total_amount - $contract->paid_amount }}</span> EGP</div>
                        </div>

                    </div>
                </div>

                <!-- ======================================== -->
            </div>
            <!-- ========================================================================== -->

            <div class="terms">
                <!-- ======================================== -->
                <div class="line">
                    {!! getSettings('invoice_terms') !!}
                </div>
                <!-- ======================================== -->
            </div>
            <!-- ========================================================================== -->

        </div>
    </section>
    <!-- ===================================================================================================== -->

</body>
</html>
