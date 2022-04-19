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
        <div class="row">
            <div class="col-xl-6 col-md-6 col-12">
                <div class="card card-congratulation-medal">
                    <div class="card-body card_bg">
                        <i class="fa fa-info-circle text-light float-right" data-toggle="tooltip" data-placement="bottom"
                            title="" data-original-title="More Info"></i>
                        <h5 class="text-light"> {{ __('locale.Orders') }}</h5>
                        <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color">
                                {{ $order_count }} </span> <i class="fa fa-shopping-cart text-light"
                                style="float: right"></i></h2>
                        <p class="mt-5 card_bg_color">

                            <span style="background-color: #eaa20e;padding: 3px;">0%</span>
                            {{ __('locale.From the previous month') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-12">
                <div class="card card-congratulation-medal">
                    <div class="card-body card_bg">
                        <i class="fa fa-info-circle text-light float-right" data-toggle="tooltip" data-placement="bottom"
                            title="" data-original-title="More Info"></i>
                        <h5 class="text-light"> {{ __('locale.REVENUE') }}</h5>
                        <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color">
                                {{ $revenue }} </span> <i class="fa fa-money text-light" style="float: right"></i>
                        </h2>
                        <p class="mt-5 card_bg_color">
                            @if ($order_r > 0)
                                <span style="background-color: #50a5e8;padding: 3px;">{{ $order_r }}%</span>
                            @elseif($order_r < 0)
                                <span style="background-color: #e25757;padding: 3px;">{{ $order_r }}%</span>
                            @elseif($order_r == 0)
                                <span style="background-color: #eaa20e;padding: 3px;">{{ $order_r }}%</span>
                            @endif {{ __('locale.From the previous month') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row match-height">
            <div class="col-lg-12 col-12">
                <div class="card " style="overflow-x:auto;">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('locale.ID') }}</th>
                                        <th>{{ __('locale.Products') }}</th>
                                        <th>{{ __('locale.completion') }}</th>
                                        <th>{{ __('locale.Data') }}</th>
                                        <th>{{ __('locale.Express') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders1 as $order)
                                        <?php
                                $data = explode(',', $order->user_id);
                                 foreach ($data as $key => $value) {
                                ?>
                                        @if ($value == $employee->id)
                                            <tr>

                                                <td><a href="{{ url('editorder/' . $order->id) }}"
                                                        class="text-body font-weight-bold">{{ $order->id }}</a></td>
                                                <td>
                                                    <p>{{ $order->pdetail->product_title }}</p>
                                                    <p>
                                                        @if ($order->product_language == 'English')
                                                            <span class="badge badge-primary">
                                                        @endif
                                                        @if ($order->product_language == 'German')
                                                            <span class="badge badge-info">
                                                        @endif
                                                        @if ($order->product_language == 'French')
                                                            <span class="badge badge-danger">
                                                        @endif
                                                        @if ($order->product_language == 'Spanish')
                                                            <span class="badge badge-secondary">
                                                        @endif
                                                        {{ $order->product_language }}</span>

                                                    </p>
                                                </td>
                                                <td>
                                                    @if ($order->order_status == 1)
                                                        <div class="alert alert-danger" role="alert"
                                                            style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                            {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                                        </div>
                                                    @elseif($order->order_status == 2)
                                                        <div class="alert alert-info" role="alert"
                                                            style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                            {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                                        </div>
                                                    @elseif($order->order_status == 3)
                                                        <div class="alert alert-warning" role="alert"
                                                            style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                            {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                                        </div>
                                                    @elseif($order->order_status == 4)
                                                        <div class="alert alert-success" role="alert"
                                                            style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                            {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                                        </div>
                                                    @elseif($order->order_status == -1)
                                                        <div class="alert alert-primary" role="alert"
                                                            style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                            {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="date">
                                                    @if ($order->order_status == 0)
                                                        <p>
                                                        <div class="avatar bg-light-danger">
                                                            <div class="avatar-content"><i class="fa fa-times"></i></div>
                                                        </div>
                                                        </p>
                                                    @else
                                                        <p>
                                                        <div class="avatar bg-light-success">
                                                            <div class="avatar-content"><i class="fa fa-check"></i></div>
                                                        </div>
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <p>
                                                        @if ($order->express == '0,00')
                                                            <span class="badge badge-secondary">
                                                            @else<span class="badge badge-success">
                                                        @endif
                                                        24h</span>

                                                    </p>
                                                </td>
                                            </tr>
                                        @endif
                                        <?php
                                     }
                                ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="card card-browser-states">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('locale.Inbox') }}</h4>
                        <img class="font-medium-3 cursor-pointer"
                            src="{{ url('images/profiles/' . Auth::user()->profile_picture) }}" class="rounded-circle"
                            alt="" style=" width:10%;">
                    </div>
                    <hr>



                    <div class="card-body">
                        <div style="overflow-y: scroll;" class="mh-100">

                                    <div class="browser-states">
                                        <div class="inbox-item" onclick="inbox_item()" style="border:0;cursor: pointer"
                                        data-id="">
                                        <div class="media">
                                            {{-- <img src="{{ url('images/profiles/' . $employee->profile_picture) }}"
                                                class="rounded mr-1" height="30" alt="" /> --}}
                                            <h6 class="align-self-center mb-0"></h6>
                                        </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p class="font-weight-bold text-body-heading mr-1"
                                                id="inbox-item-date"
                                                style="font-size: 140%;color:gray"><span class="badge badge-success"
                                                    id="inbox-item-count"></span>
                                            </p>
                                        </div>
                                    </div>

                            {{-- @endforeach --}}
                            {{-- @endif --}}
                        </div>
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
