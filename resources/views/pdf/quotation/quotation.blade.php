<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Quotation {{ '#0000' . $quotation->id }} </title>
    {!! Html::style('admin/css/pdf/invoice.css') !!}
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
                <b class="label-page">Quotation</b> QUO/{{date('Y') . '/' . '0000' . $quotation->id}}
            </h2>

            <div class="dates">
                <div class="date">
                    <div class="header">Quotation Date</div>
                    <div class="value">{{ date('Y/m/d') }}</div>
                </div>

                <div class="date">
                    <div class="header">Reference</div>
                    <div class="value">QUO/{{ date('Y') . '/' . '0000' . $quotation->id }}</div>
                </div>


                <div class="date">
                    <div class="header">Client name</div>
                    <div class="value">{{ $quotation['lead']['name'] }}</div>
                </div>

                <div class="date">
                    <div class="header">Client phone</div>
                    <div class="value">{{ $quotation['lead']['phone'] }}</div>
                </div>

                <div class="date">
                    <div class="header">Personal sales</div>
                    <div class="value">{{ $quotation['personalSales']['name'] }}</div>
                </div>

                @if($quotation->lead->company_address != null)
                    <div class="date address">
                        <div class="header">Company address</div>
                        <div class="value">{{ $quotation['lead']['company_address'] }}</div>
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
                        @foreach ($quotation->services as $service)
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
                        {{--  <div class="row row-services-amount">
                            <div class="side title">Subtotal</div>
                            <div class="side"><span class="price">{{ $quotation->services_amount }}</span> EGP</div>
                        </div>
                        <div class="row row-tax-amount">
                            <div class="side title">Taxes</div>
                            <div class="side">
                                <div><span class="tax">{{ getSettings('taxes') }}%</span> <span class="price">{{ ($quotation->services_amount * (getSettings('taxes') / 100)) }}</span> EGP</div>
                            </div>
                        </div>  --}}
                        <div class="row row-total-amount">
                            <div class="side title">Total</div>
                            <div class="side"><span class="price">{{ $quotation->total_amount }}</span> EGP</div>
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
