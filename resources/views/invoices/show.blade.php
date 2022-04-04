@extends('layouts/contentLayoutMaster')

@section('title', 'Benutzer hinzufügen')

@section('vendor-style')
    {{-- Vendor Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
<style>
    .css{
        margin-left: 65%;
        display: none;
    }
</style>
@section('content')
    <!-- Validation -->
    <h1>{{ __('locale.Invoice Preview') }}</h1>
  @if (session('alert'))
  <div class="demo-spacing-0">
    <div class="alert alert-success" role="alert">
      <div class="alert-body"><strong>{{(session('alert'))}}</strong></div>
    </div>
  </div>
@endif
    <section class="bs-validation">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box" id="invoice">
                                    <!-- Logo & title -->
                                    <div class="clearfix">
                                                <div class="row ml-2 pb-3" style="border-bottom: 0.5px solid lightgrey">
                                                    <div class="col-md-10">
                                                        <h2>RECHNUNG</h2>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <h2># <span class="text-muted">{{$items['order_id']}}</span></h2>
                                                    </div>
                                                </div>
                                            <div class="row mt-1">
                                            <div class="col-md-6 mr-4 ml-1" >

                                                <div class="row mt-2 mb-2">
                                                    <div class="col-md-12" >
                                                        <p class="p-1" style="background-color: darkblue"><b style="color: lightgrey">STATUS:</b> @if($items['order_status']==1||$items['order_status']==2||$items['order_status']==3) <span style="color:#ecd399;" >Zahlung ausstehend </span> @elseif($items['order_status']==4) <span style="color:lightblue;" >Rechnung wurde bezahlt </span> @elseif($items['order_status']==-1) <span style="color:pink;" >Storniert/Abgebrochen </span> @elseif($items['order_status']==-2) <span style="color:lightgreen;" > zurückerstatten </span> @else <span style="color:red;" > noch nicht veröffentlicht </span> @endif</p>

                                                    </div>
                                                </div>
                                                <div class="row ml-1">
                                                    <div class="col-md-4">
                                                        <div class="row" style="border-right: 0.5px solid lightgrey">
                                                            <div class="col-md-12">
                                                                <h5>Bestellnummer</h5>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <p>{{$items['order_id']}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row" style="border-right: 0.5px solid lightgrey">
                                                            <div class="col-md-12">
                                                                <h5>Bestelldatum</h5>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <p>{{ \Carbon\Carbon::parse($items['order_created_at'])->format('d,m Y')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5>Fertigstellung</h5>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <p>{{ \Carbon\Carbon::parse($items['order_completion_date'])->format('d,m Y')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-5" style="border-left:1px solid lightgrey ">

                                                <div class="row mt-1">
                                                    <div class="offset-md-1 col-md-7">
                                                        <p class="h4"><u>RECHNUNG AN</u></p>
                                                        <address class="text-muted">
                                                            {{$items['user_name']}}<br>
                                                            {{$items['street_no']}}, {{$items['house_no']}}<br>
                                                            {{$items['zip_code']}}, {{$items['city']}}<br><br>
                                                            <abbr title="Email">Email:</abbr> {{ $items['email'] }} <br>
                                                            <abbr title="Phone">Phone:</abbr> {{ $items['mobile'] }}

                                                        </address>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>




                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table table-centered mt-1">
                                                        <thead style="background-color: #ececec">
                                                        <tr ><th>Nr</th>
                                                            <th>Produkt</th>
                                                            <th style="width: 10%" class="text-right">Preis</th>
                                                        </tr></thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>
                                                                <p style="margin-bottom: 1px;color:black;font-size: 1.2em">{{$items['product_name']}}</p>
                                                                <p style="font-size: 0.8em" class="text-muted">{{$items['product_language']}}</p>
                                                            </td>
                                                            <td class="text-right">{{number_format((float)$items['product_price'], 2, '.', '')}} €</td>
                                                        </tr>
                                                        @if($items['express']!=0)
                                                            <tr>
                                                                <td>2</td>
                                                                <td>
                                                                    <p style="margin-bottom: 1px;color:black;font-size: 1.2em">Express 24</p>
                                                                    <p style="font-size: 0.8em" class="text-muted">Express 24h service</p>
                                                                </td>
                                                                <td class="text-right">{{number_format((float)$items['express'], 2, '.', '')}} €</td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td> @if($items['express']!=0)3 @else 2 @endif</td>
                                                            <td>
                                                                <p style="margin-bottom: 1px;color:black;font-size: 1.2em">{{$items['design_name']}}</p>
                                                                <p style="font-size: 0.8em" class="text-muted">{{$items['design_category']}}</p>
                                                            </td>
                                                            <td class="text-right">{{number_format((float)$items['design_price'], 2, '.', '')}} €</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>
                                                                <p style="margin-bottom: 1px;color:black;font-size: 1.2em">{{$items['website_name']}}</p>
                                                                <p style="font-size: 0.8em" class="text-muted">{{$items['website_category']}}</p>
                                                            </td>
                                                            <td class="text-right">{{number_format((float)$items['website_price'], 2, '.', '')}} €</td>
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
                                                    <p> {{number_format((float)$items['total_price'], 2, '.', '')}} €</p>
                                                    <p> {{number_format((float)$items['tax'], 2, '.', '')}} €</p>

                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="offset-sm-7 col-sm-3" style="font-size: 1.2em;color:black">
                                                <div class="float-right">
                                                    <h3>Gesamt:</h3>

                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <?php $total = (int)$items['total_price'] + (int)$items['tax']; ?>
                                                <h3>{{number_format((float)$total, 2, '.', '')}} €</h3>
                                            </div>
                                        </div>
                                        <!-- end row -->

                                        <div class="row mt-4 mb-5 ml-5">
                                            <div class="offset-sm-7 col-sm-5">
                                                <a href="{{url('invoicepdf/'.$items['order_id'])}}"><button class="btn btn-primary">Downloade</button></a>
                                                <a href="{{url('invoicepdf/'.$items['order_id'])}}"><button class="btn btn-primary">Rechnung drucken</button></a>
                    {{--                            <a href="#"><button class="btn btn-primary">Send Invoice</button></a>--}}
                                            </div>
                                        </div>


                                    </div>




                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div>
                </div>

            </div>
        </div>

    </section>
    <!-- /Validation -->
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
@endsection
