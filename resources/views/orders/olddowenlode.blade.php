<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- App css -->

<style>


</style>
</head>

<body>
    {{-- <h1 class="ibrar">fahad hassan</h1> --}}
    <div class="col-12">
        <div class="card-box" id="invoice">
            <!-- Logo & title -->
            <div class="clearfix">
                <div class="row pb-3">
                    <div class="col-md-5 mr-5">
                        <div class="row ml-2 pb-3" style="border-bottom: 0.5px solid lightgrey;width: 50%">
                            <div class="col-md-7">
                                {{-- <img src="{!! asset('public/img/logo/logo.png') !!}" alt="" style="width: 50%"> --}}
                            </div>
                            <div class="col-md-3">
                                <p class="" style="font-size: 0.7em">Sonninstraße 6
                                    20097 Hamburg</p>
                            </div>
                        </div>

                        <div class="row ml-2 mt-2">
                            <div class="col-md-12">
                                <p style="font-size: 3.5em;font-weight: 100;color:black">RECHNUNG</p>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2" style="margin-left: -35px">
                            <div class="col-md-12">
                                <p class="p-1" style="background-color: darkblue;width: 50%"><b
                                        style="color: lightgrey">STATUS:</b>
                                    @if ($items['order_status'] == 1 || $items['order_status'] == 2 || $items['order_status'] == 3)
                                        <span style="color:#ecd399;">Zahlung ausstehend </span>
                                    @elseif($items['order_status'] == 4) <span style="color:lightblue;">Rechnung
                                        wurde bezahlt </span> @elseif($items['order_status'] == -1) <span
                                            style="color:pink;">Storniert/Abgebrochen </span>
                                    @elseif($items['order_status'] == -2) <span style="color:lightgreen;">
                                        zurückerstatten </span> @else <span style="color:red;"> noch nicht
                                            veröffentlicht </span>
                                    @endif
                                </p>

                            </div>
                        </div>

                    </div>
                    <div class="row ml-1">
                        <div class="col-md-4">
                            <div class="row" style="border-right: 0.5px solid lightgrey">
                                <div class="col-md-12">
                                    <h5>Bestellnummer</h5>
                                </div>
                                <div class="col-md-12">
                                    <p>{{ $items['order_id'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row" style="border-right: 0.5px solid lightgrey">
                                <div class="col-md-12">
                                    <h5>Bestelldatum</h5>
                                </div>
                                <div class="col-md-12">
                                    <p>{{ \Carbon\Carbon::parse($items['order_created_at'])->format('d,m Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Fertigstellung</h5>
                                </div>
                                <div class="col-md-12">
                                    <p>{{ \Carbon\Carbon::parse($items['order_completion_date'])->format('d,m Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php
                //   echo '<pre>'; print_r("here"); echo '</pre>'; die;
                ?>
                <div class="col-md-5" style="border-left:1px solid lightgrey ">
                    <div class="row">
                        <div class="offset-md-8 col-md-4" style="margin-left: 100%">
                            <p style="font-size: 1.5em;margin-bottom: 0">#{{ $items['order_id'] }}</p>
                            <span>{{ \Carbon\Carbon::parse($items['order_created_at'])->format('d.m.Y h:m') }}</span>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="offset-md-2 col-md-7">
                            <p class="h4"><u>RECHNUNG AN</u></p>
                            <address class="text-muted">
                                {{ $items['user_name'] }}<br>
                                {{ $items['street_no'] }}, {{ $items['house_no'] }}<br>
                                {{ $items['zip_code'] }}, {{ $items['city'] }}<br><br>
                                <abbr title="Email">Email:</abbr> {{ $items['email'] }} <br>
                                <abbr title="Phone">P:</abbr> {{ $items['mobile'] }}

                            </address>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row" style="min-height:610px">
                <div class="col-md-12">


                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-centered mt-1">
                                    <thead style="background-color: #ececec">
                                        <tr class="highlighted">
                                            <th style="color:#000;">Nr</th>
                                            <th style="color:#000;">Produkt</th>
                                            <th style="width: 10%;color: black" class="text-right">Preis
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <p style="margin-bottom: 1px;color:black;font-size: 1.2em">
                                                    {{ $items['product_name'] }}</p>
                                                <p style="font-size: 0.8em" class="text-muted">
                                                    {{ $items['product_language'] }}</p>
                                            </td>
                                            <td class="text-right">{{ $items['product_price'] }} €</td>
                                        </tr>
                                        @if ($items['express'] != 0)
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    <p style="margin-bottom: 1px;color:black;font-size: 1.2em">
                                                        Express 24</p>
                                                    <p style="font-size: 0.8em" class="text-muted">Express
                                                        24h service</p>
                                                </td>
                                                <td class="text-right">{{ $items['express'] }} €</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>
                                                @if ($items['express'] != 0)
                                                3 @else 2
                                                @endif
                                            </td>
                                            <td>
                                                <p style="margin-bottom: 1px;color:black;font-size: 1.2em">
                                                    {{ $items['design_name'] }}</p>
                                                <p style="font-size: 0.8em" class="text-muted">
                                                    {{ $items['design_category'] }}</p>
                                            </td>
                                            <td class="text-right">{{ $items['design_price'] }} €</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <p style="margin-bottom: 1px;color:black;font-size: 1.2em">
                                                    {{ $items['website_name'] }}</p>
                                                <p style="font-size: 0.8em" class="text-muted">
                                                    {{ $items['website_category'] }}</p>
                                            </td>
                                            <td class="text-right">{{ $items['website_price'] }} €</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row mt-2">
                        <!-- end col -->
                        <div class="offset-sm-8 col-sm-2" style="font-size: 1.2em;color:black">
                            <div class="float-right">
                                <p>Zwischensumme:</p>
                                <p>19% Umsatzsteuer:</p>


                            </div>
                            <div class="clearfix"></div>
                        </div> <!-- end col -->

                        <div class="col-sm-2" style="font-size: 1.2em;">
                            <div class="float-left">
                                <p>{{ $items['total_price'] }} €</p>
                                <p>{{ $items['tax'] }} €</p>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <div class="clearfix">
                                <h3>Vielen Dank!</h3>
                            </div>
                        </div>
                        <div class="offset-sm-2 col-sm-4" style="background-color: darkblue">
                            <h3 style="color:white;text-align:center">Gesamt: {{ $items['total_price'] }} €
                            </h3>
                        </div>
                    </div>
                    <!-- end row -->


                </div>
            </div>

            <div class="row" style="margin-top:150px">
                <div class="col-md-5">
                    <div class="row" style="color: black">
                        <div class="col-sm-12">
                            <table>
                                <tr>
                                    <td align="right" style="padding: 5px 45px"><b>Name der Bank</b></td>
                                    <td>Postbank</td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding: 5px 45px"><b>Namer der Firma:</b></td>
                                    <td>Graviando OHG</td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding: 5px 45px 10px"><b>Verwendungszweck</b>
                                    </td>
                                    <td style="padding-bottom: 10px;color: blueviolet">
                                        #{{ $items['order_id'] }}<span style="color: black">(bitte exakt so
                                            angeben)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding: 5px 45px"><b>IBAN</b></td>
                                    <td>DEB2440100460413924468</td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding: 5px 45px"><b>BIC</b></td>
                                    <td>PBNKDEFF</td>
                                </tr>
                            </table>

                            {{-- <small class="text-muted">
                                All accounts are to be paid within 7 days from receipt of
                                invoice. To be paid by cheque or credit card or direct payment
                                online. If account is not paid within 7 days the credits details
                                supplied as confirmation of work undertaken will be charged the
                                agreed quoted fee noted above.
                            </small> --}}

                            <!-- end col -->

                            <div class="clearfix"></div>
                            <!-- end col -->
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <p class="h4" style="color: blueviolet;margin-top: 0"><i
                            class="fas fa-university"></i> Bank</p>
                </div>

                <div class="col-md-5">
                    <p style="color:blueviolet;font-size: 1.2em"><i class="fab fa-paypal"></i><b>PayPal</b></p>
                    <p style="color:black">Rufen Sie folgende Seite auf :</p>
                    <p><a href="https://die.bewerbung.one/paypal/35468">https://die.bewerbung.one/paypal/35468</a>
                    </p>

                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-md-3">
                <p style="margin-bottom: 0;font-weight: bold">Addresse</p>
                <address>
                    Graviando OHG <br>
                    Sonninstraße 6 <br>
                    20097 Hamburg
                </address>
            </div>
            <div class="col-md-3">
                <p style="margin-bottom: 0;font-weight: bold">Kontacte</p>
                <address>
                    040 123 456 654 <br>
                    info@graviando.com <br>
                    www.graviando.com
                </address>
            </div>
            <div class="col-md-3">
                <address>
                    Bank:Postbank <br>
                    Graviando OHG <br>
                    IBAN: DEB2440100460413924468<br>
                    BIC:PBNKDEFF
                </address>
            </div>
            <div class="col-md-3">
                <address>
                    St-Nr:46/624/01612 <br>
                    USt-ID-Nr:DE319824375 <br>
                    HReg Nr:HRA 123458 <br>
                    Amtsgericht:Hamburg
                </address>
            </div>

        </div>


    </div> <!-- end card-box -->
    <!-- end col -->
</div>

</body>

</html>

<!-- end row -->
