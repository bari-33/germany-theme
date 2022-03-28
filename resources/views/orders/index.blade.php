<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bewerbung.one</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/logo.png') }}">
    <link href="{{ url('css/orders.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @include('panels/styles')
    @include('panels/styles')
    <style>
        .bg-bdy {
            background: url('{!! asset('images/logo/login-bg-01.png') !!}') center top no-repeat;
            background-size: 100%;
        }


        .bg-end-bdy {
            background: url('{!! asset('images/logo/2.png') !!}') center top no-repeat;
            background-size: 100%;
            position: fixed;
            bottom: 0;
            height: 50%;
            width: 100%;
            z-index: -9999999999
        }

        .brdr-tp-col {

            box-shadow: 0px -7px 0px 0px #7e57c2b5 !important;
            padding: 0px;
            border-radius: 9px;


        }

        .brdr-tp-sh {
            /* box-shadow: 0px -7px 0px 0px #7e57c2b5 !important;
        border-radius: 6px !important;
*/
            -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
        }

        .products-index:hover {
            box-shadow: 0 0 5px rgba(0, 145, 200, 0.5);
            cursor: pointer;

        }

        .btn-popular {
            font-size: 81%;
            font-family: sans-serif;
            border-radius: 20px;
            padding: 2px 7px 2px 7px;
            border: none;
            background: #00bcd4;

        }

        .flag-img:hover {
            box-shadow: 0px 0px 2px 2px;
        }

        .selected_flag {
            box-shadow: 0px 0px 2px 2px;
        }

    </style>
</head>

<body class="bg-bdy" style="margin: 0 auto">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11">
                <h2 class="text-uppercase logo ml-5 mt-5">
                    <a href="{{ url('orders') }}">
                        <img src="{{ url('images/logo/logo.png') }}" alt="">
                    </a>

                </h2>
                <!--/Logo_Bar-->
            </div>
        </div>
    </div>

    <!-- Start Content-->
    <div class="container">
        <div class="row mt-2 mb-5">
            <div class=" offset-sm-2 offset-md-2 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="text-center">
                    <h4>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Kostenlose und unverbindliche Registrierung</font>
                        </font>
                    </h4>
                </div>
                <ul class="numbers-section">
                    <li class="numbers">
                        <div class="steps">
                            <h3>1</h3>
                        </div>
                        <div class="caption_flag">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Product Wahlen</font>
                            </font>
                        </div>
                    </li>


                    <li class="numbers">
                        <div class="steps">
                            <h3>2</h3>
                        </div>
                        <div class="caption_flag">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Daten eingeben</font>
                            </font>
                        </div>
                    </li>


                    <li class="numbers">
                        <div class="steps">
                            <h3>3</h3>
                        </div>
                        <div class="caption_flag">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Registrierung fertig</font>
                            </font>
                        </div>
                    </li>

                </ul>
                <div class="text-center">
                    <h4 style="vertical-align: inherit;">Wähle eine Sprache für deine Bewerbung aus</h4>
                </div>
                <div class="flags-container">
                    <div class="flags">
                        <div class="outer-border" id="uk">
                            <img class="flag-img english-flag" src="{!! asset('images/flags/uk.png') !!}" alt="flag_pic">
                        </div>

                        <div class="flag-hover English">
                            ENGLISH
                        </div>
                    </div>
                    <div class="flags">
                        <div class="outer-border" id="gr">
                            <img class="flag-img german-flag" src="{!! asset('images/flags/germany.png') !!}" alt="flag_pic">
                        </div>

                        <div class="flag-hover Spanish">
                            GERMAN
                        </div>
                    </div>
                    <div class="flags">
                        <div class="outer-border" id="sp">
                            <img class="flag-img spanish-flag" src="{!! asset('images/flags/spain.png') !!}" alt="flag_pic">
                        </div>

                        <div class="flag-hover German">
                            SPANISH
                        </div>
                    </div>
                    <div class="flags">
                        <div class="outer-border" id="fr">
                            <img class="flag-img french-flag" src="{!! asset('images/flags/france.png') !!}" alt="flag_pic">
                        </div>


                        <div class="flag-hover French">
                            French
                        </div>
                    </div>

                </div>
                <div class="text-center">
                    <h4 style="vertical-align: inherit;" id="selected_flag"></h4>
                </div>

            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-4 {{ $product->language }} mb-5 products-index brdr-tp-col"
                    style="margin-right:10px ">
                    <a href="{{ url('create/' . $product->id) }}">
                        <div class="card-box brdr-tp-sh bg-white">
                            <div class="row pb-2">
                                <div class="col-md-3">
                                    <img class="mt-2"
                                        src="{{ url('images/products/' . $product->product_image) }}" style="width:55%;"
                                        alt="">
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <p class="h4">{{ $product->product_title }}
                                            </p>
                                        </div>

                                        <div class="col-md-12">
                                            <p class="h3 mr-3" style="display: inline-block; font-size: 122%">
                                                <span id="product-price-text">{{ $product->regular_price }}</span> €</p>
                                            <button class="btn btn-md btn-primary btn-popular"
                                                @if ($product->getOriginal('popular') == 1) ) style="border-radius: 22px" @else style="visibility: hidden" @endif><i
                                                    class="fa fa-star"></i>Sehr berühmt</button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="container">
                                    <div class="col-md-12">
                                        <hr>
                                        <p class="h4">{{ $product->product_subtitle }}</p>
                                        <div style="max-height: 90px;overflow-y: auto">{!! $product->product_description !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-box-->

                    </a>
                </div>
            @endforeach
        </div>


    </div>

    <div class="bg-end-bdy"></div>


</body>
{{-- include default scripts --}}
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/ui/prism.min.js')) }}"></script>
@yield('vendor-script')
{{-- Theme Scripts --}}
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

</html>
<script>
    $( document).ready(function() {
        $('#uk').on('click',function () {
            $('.English').show();
            $('.Spanish').hide();
            $('.German').hide();
            $('.French').hide();
            $('#selected_flag').html('English');
            $('.english-flag').addClass('selected_flag');
            $('.german-flag').removeClass('selected_flag');
            $('.spanish-flag').removeClass('selected_flag');
            $('.french-flag').removeClass('selected_flag');

        });
        $('#gr').on('click',function () {
            $('.English').hide();
            $('.Spanish').hide();
            $('.French').hide();
            $('.German').show();
             $('#selected_flag').html('German');
             $('.english-flag').removeClass('selected_flag');
            $('.german-flag').addClass('selected_flag');
            $('.spanish-flag').removeClass('selected_flag');
            $('.french-flag').removeClass('selected_flag');



        });
        $('#sp').on('click',function () {
            $('.English').hide();
            $('.German').hide();
            $('.French').hide();
            $('.Spanish').show();
             $('#selected_flag').html('Spanish');
             $('.english-flag').removeClass('selected_flag');
            $('.german-flag').removeClass('selected_flag');
            $('.spanish-flag').addClass('selected_flag');
            $('.french-flag').removeClass('selected_flag');



        });
        $('#fr').on('click',function () {
            $('.English').hide();
            $('.German').hide();
            $('.French').show();
            $('.Spanish').hide();
             $('#selected_flag').html('French');
             $('.english-flag').removeClass('selected_flag');
            $('.german-flag').removeClass('selected_flag');
            $('.spanish-flag').removeClass('selected_flag');
            $('.french-flag').addClass('selected_flag');



        });
    });
</script>
