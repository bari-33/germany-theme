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
    <div class="row invoice-preview">
        <div class="col-xl-9 col-md-8 col-12">
            <div class="card invoice-preview-card">
              <div class="card-body invoice-padding pb-0">
                <!-- Header starts -->
                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                  <div>
                    <div class="logo-wrapper">
                      <h3 class="text-primary invoice-logo">RECHNUNG</h3>
                    </div>
                    <p class="card-text mb-25">Bewerbung.one|Nordkanalstr.52,20097 Hamburg</p>
                    {{-- <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                    <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p> --}}
                  </div>
                  <div class="mt-md-0 mt-2">
                    <h4 class="invoice-title">
                        Rechnug
                      <span class="invoice-number">#{{$items['order_id']}}</span>
                    </h4>
                    <div class="invoice-date-wrapper">
                      <p class="invoice-date-title">Bestelldatum:</p>
                      <p class="invoice-date">{{ \Carbon\Carbon::parse($items['order_created_at'])->format('d,m Y')}}</p>
                    </div>
                    <div class="invoice-date-wrapper">
                      <p class="invoice-date-title">Fertigstellung:</p>
                      <p class="invoice-date">{{ \Carbon\Carbon::parse($items['order_completion_date'])->format('d,m Y')}}</p>
                    </div>
                  </div>
                </div>
                <!-- Header ends -->
              </div>

              <hr class="invoice-spacing" />

              <!-- Address and Contact starts -->
              <div class="card-body invoice-padding pt-0">
                <div class="row invoice-spacing">
                  <div class="col-xl-8 p-0">
                    <h6 class="mb-2">Invoice To:</h6>
                    <h6 class="mb-25">{{$items['user_name']}}</h6>
                    {{-- <p class="card-text mb-25">Shelby Company Limited</p> --}}
                    <p class="card-text mb-25"> {{$items['street_no']}}, {{$items['house_no']}}</p>
                    <p class="card-text mb-25">{{ $items['mobile'] }}</p>
                    <p class="card-text mb-0">{{ $items['email'] }} </p>
                  </div>
                  <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                    <h6 class="mb-2">Payment Details:</h6>
                    <table>
                      <tbody>
                        <tr>
                          {{-- <td class="pe-1">Total Due:</td>
                          <td><span class="fw-bold">$12,110.55</span></td> --}}
                        </tr>
                        <tr>
                          <td class="pe-1">Name der Bank</td>
                          <td>Postbank</td>
                        </tr>
                        <tr>
                          <td class="pe-1">Namer der Firma:</td>
                          <td>Graviando OHG</td>
                        </tr>
                        <tr>
                          <td class="pe-1">IBAN:</td>
                          <td>DEB2440100460413924468</td>
                        </tr>
                        {{-- <tr>
                          <td class="pe-1">SWIFT code:</td>
                          <td>BR91905</td>
                        </tr> --}}
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Address and Contact ends -->

              <!-- Invoice Description starts -->
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      {{-- <th class="py-1">Nr</th> --}}
                      <th>Bezeichnung</th>
                      <th>Menge</th>
                      <th class="text-right">Preis</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        {{-- <td>1</td> --}}
                        <td>
                            <p style="margin-bottom: 1px;color:black;font-size: 1.2em">{{$items['product_name']}}</p>
                            <p style="font-size: 0.8em" class="text-muted">{{$items['product_language']}}</p>
                        </td>
                        <td >{{number_format((float)$items['product_price'], 2, '.', '')}} €</td>
                        <td class="text-right">{{number_format((float)$items['product_price'], 2, '.', '')}} €</td>
                    </tr>
                    @if($items['express']!=0)
                        <tr>
                            {{-- <td>2</td> --}}
                            <td>
                                <p style="margin-bottom: 1px;color:black;font-size: 1.2em">Express 24</p>
                                <p style="font-size: 0.8em" class="text-muted">Express 24h service</p>
                            </td>
                            <td>{{number_format((float)$items['express'], 2, '.', '')}} €</td>
                            <td class="text-right">{{number_format((float)$items['express'], 2, '.', '')}} €</td>
                        </tr>
                    @endif
                    <tr>
                        {{-- <td> @if($items['express']!=0)3 @else 2 @endif</td> --}}
                        <td>
                            <p style="margin-bottom: 1px;color:black;font-size: 1.2em">{{$items['design_name']}}</p>
                            <p style="font-size: 0.8em" class="text-muted">{{$items['design_category']}}</p>
                        </td>
                        <td>{{number_format((float)$items['design_price'], 2, '.', '')}} €</td>
                        <td class="text-right">{{number_format((float)$items['design_price'], 2, '.', '')}} €</td>
                    </tr>
                    <tr>
                        {{-- <td>3</td> --}}
                        <td>
                            <p style="margin-bottom: 1px;color:black;font-size: 1.2em">{{$items['website_name']}}</p>
                            <p style="font-size: 0.8em" class="text-muted">{{$items['website_category']}}</p>
                        </td>
                        <td>{{number_format((float)$items['website_price'], 2, '.', '')}} €</td>
                        <td class="text-right">{{number_format((float)$items['website_price'], 2, '.', '')}} €</td>
                    </tr>
                    </tbody>
                </table>
              </div>

              <div class="card-body invoice-padding pb-0">
                <div class="row invoice-sales-total-wrapper">
                  <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                  </div>
                  <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                    <div class="invoice-total-wrapper">
                        <div class="row">
                            <div class="col-md-7">
                                <p class="invoice-total-title">Zwischensumme:</p>
                            </div>
                            <div class="col-md-5">
                                <p class="invoice-total-amount" style="font-weight:bolder">{{number_format((float)$items['total_price'], 2, '.', '')}} €</p>
                            </div>
                        </div>
                      {{-- <div class="invoice-total-item">
                        <p class="invoice-total-title">Discount:</p>
                        <p class="invoice-total-amount">$28</p>
                      </div> --}}
                      <div class="row">
                        <div class="col-md-7">
                            <p class="invoice-total-title">19% Umsatzsteuer:</p>
                        </div>
                        <div class="col-md-5">
                            <p class="invoice-total-amount" style="font-weight:bolder">{{number_format((float)$items['tax'], 2, '.', '')}} €</p>
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-md-7">
                            <p class="invoice-total-title">Gesamt:</p>
                        </div>
                        <div class="col-md-5">
                            <p class="invoice-total-amount" style="font-weight:bolder">
                                <?php $total = (int)$items['total_price'] + (int)$items['tax']; ?>
                                {{number_format((float)$total, 2, '.', '')}} €
                            </p>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Invoice Description ends -->

              <hr class="invoice-spacing" />

              <!-- Invoice Note starts -->
              <div class="card-body invoice-padding pt-0">
                <div class="row">
                  <div class="col-12">
                    <span class="fw-bold">Note:</span>
                    <span
                      >It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                      projects. Thank You!</span
                    >
                  </div>
                </div>
              </div>
              <!-- Invoice Note ends -->
            </div>
          </div>
          <!-- /Invoice -->
           <!-- Invoice Actions -->
    <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
        <div class="card">
          <div class="card-body">
            <button class="btn btn-primary w-100 mb-75" data-bs-toggle="modal" data-bs-target="#send-invoice-sidebar">
              Send Invoice
            </button>
            <a href="{{url('invoicepdf/'.$items['order_id'])}}"><button class="btn btn-outline-secondary w-100 btn-download-invoice mb-75">Downloade</button></a>
            {{-- <button class="btn btn-outline-secondary w-100 btn-download-invoice mb-75">Download</button> --}}
            <a class="btn btn-outline-secondary w-100 mb-75" href="{{url('invoicepdf/'.$items['order_id'])}}"> Rechnung drucken </a>
            <a class="btn btn-outline-secondary w-100 mb-75" href="javascript:void(0)"> Edit </a>
            <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#add-payment-sidebar">
              Add Payment
            </button>
          </div>
        </div>
      </div>
      <!-- /Invoice Actions -->
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
