
@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  @endsection
  <style type="text/css">
    .card_bg {
        background-color: #f8ceec;
        background-image: linear-gradient(315deg, #9e9bd0 0%, #595592 74%);
        color: white;
    }

    .card_bg_color {
        color: white !important;
    }

    html,
    body {
        height: 60vh;
    }

    .card-header {
        max-height: 15vh;
    }

    .card-body {
        max-height: 60vh;
    }

</style>
@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">

    <!-- Greetings Card starts -->
    <div class="col-xl-12 col-md-6 col-12">
        <div class="card card-congratulation-medal">
            <div class="card-body card_bg">
                <i class="fa fa-info-circle text-light float-right" data-toggle="tooltip" data-placement="bottom"
                    title="" data-original-title="More Info"></i>
                <h5 class="text-light"> {{ __('locale.Orders') }}</h5>
                <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color">
                        {{$order}} </span> <i class="fa fa-shopping-cart text-light"
                        style="float: right"></i></h2>
                <p class="mt-5 card_bg_color">

                        <span style="background-color: #eaa20e;padding: 3px;">0%</span>
                  {{ __('locale.From the previous month') }}
                </p>
            </div>
        </div>
    </div>

 <div class="col-lg-12 col-12">
        <div class="card " style="overflow-x:auto;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('locale.ID') }}</th>
                                <th>{{ __('locale.Status') }}</th>
                                <th>{{ __('locale.completion') }}</th>
                                <th>{{ __('locale.Products') }}</th>
                                <th>{{ __('locale.Price') }}</th>
                                <th>{{ __('locale.Paid') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($orders as $order)
                            <tr>

                                <td><a href="" class="text-body font-weight-bold">{{$loop->iteration}}</a></td>
                                <td >
                                    @if($order->order_status==0)
                                    <div class="alert alert-secondary text-center" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">On-Hold
                                    </div>
                                        @endif
                                        @if($order->order_status==2)
                                            <div class="alert alert-info text-center" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">In Running
                                            </div>
                                        @endif
                                        @if($order->order_status==3)
                                            <div class="alert alert-warning text-center" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">In check
                                            </div>
                                        @endif
                                        @if($order->order_status==4)
                                            <div class="alert alert-success text-center" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">Completed
                                            </div>
                                        @endif
                                        @if($order->order_status==-1)
                                            <div class="alert alert-primary text-center" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">Activated
                                            </div>
                                        @endif
                                        @if($order->order_status==1)
                                            <div class="alert alert-danger" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">Cancled
                                            </div>
                                        @endif

                                </td>
                                <td>
                                    <div class="alert alert-secondary" role="alert" style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">{{ \Carbon\Carbon::parse($order->completion_date)->format('l, d,F Y')}}</div>
                                </td>
                                <td>
                                    <p>{{$order->pdetail->product_title}}</p>
                                    <p>
                                      @if($order->product_language=='English')<span class="badge badge-primary">@endif
                                            @if($order->product_language=='German')<span class="badge badge-info">@endif
                                                @if($order->product_language=='French')<span class="badge badge-danger">@endif
                                                    @if($order->product_language=='Spanish')<span class="badge badge-secondary">@endif
                                                        {{$order->product_language}}</span>
                                    </p>
                                </td>
                                <td>
                                    {{$order->total_price}} €
                                </td>
                                <td>
                                    @if($order->payment_status==0)
                                        <span class="badge badge-danger">Unpaid</span>
                                    @endif
                                        @if($order->payment_status==1)
                                        <span class="badge badge-success">paid</span>
                                        @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  <!--/ List DataTable -->
</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/app-invoice-list.js')) }}"></script>
@endsection
