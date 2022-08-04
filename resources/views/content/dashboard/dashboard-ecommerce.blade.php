@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Ecommerce')
<meta name="_token" content="{{ csrf_token() }}" />
@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
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

    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">

        <div class="row match-height">
            <!-- Medal Card -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card card-congratulation-medal">
                    <div class="card-body card_bg">
                        <i class="fa fa-info-circle text-light float-right" data-toggle="tooltip" data-placement="bottom"
                            title="" data-original-title="More Info"></i>
                        <h5 class="text-light"> {{ __('locale.Orders') }}</h5>
                        <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color">
                                {{ $orders_count }} </span> <i class="fa fa-shopping-cart text-light"
                                style="float: right"></i></h2>
                        <p class="mt-5 card_bg_color">
                            @if ($order_p > 0)
                                <span style="background-color: #50a5e8;padding: 3px;">{{ $order_p }}%</span>
                            @elseif($order_p < 0)
                                <span style="background-color: #e25757;padding: 3px;">{{ $order_p }}%</span>
                            @elseif($order_p == 0)
                                <span style="background-color: #eaa20e;padding: 3px;">{{ $order_p }}%</span>
                            @endif {{ __('locale.From the previous month') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
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
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card card-congratulation-medal">
                    <div class="card-body card_bg">
                        <i class="fa fa-info-circle text-light float-right" data-toggle="tooltip" data-placement="bottom"
                            title="" data-original-title="More Info"></i>
                        <h5 class="text-light"> {{ __('locale.DAILY AVERAGE') }}</h5>
                        <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color">
                                {{ $cdaily_avg }} </span> <i class="fa fa-bar-chart text-light" style="float: right"></i>
                        </h2>
                        <p class="mt-5 card_bg_color">
                            @if ($avg_p > 0)
                                <span style="background-color: #50a5e8;padding: 3px;">{{ $avg_p }}%</span>
                            @elseif($avg_p < 0)
                                <span style="background-color: #e25757;padding: 3px;">{{ $avg_p }}%</span>
                            @elseif($avg_p == 0)
                                <span style="background-color: #eaa20e;padding: 3px;">{{ $avg_p }}%</span>
                            @endif {{ __('locale.From the previous month') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card card-congratulation-medal">
                    <div class="card-body card_bg">
                        <i class="fa fa-info-circle text-light float-right" data-toggle="tooltip" data-placement="bottom"
                            title="" data-original-title="More Info"></i>
                        <h5 class="text-light"> {{ __('locale.Products') }}</h5>
                        <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color">
                                {{ $products }} </span> <i class="fa fa-suitcase text-light" style="float: right"></i>
                        </h2>
                        <p class="mt-5 card_bg_color">
                            @if ($prod_p > 0)
                                <span style="background-color: #50a5e8;padding: 3px;">{{ $prod_p }}%</span>
                            @elseif($prod_p < 0)
                                <span style="background-color: #e25757;padding: 3px;">{{ $prod_p }}%</span>
                            @elseif($prod_p == 0)
                                <span style="background-color: #eaa20e;padding: 3px;">{{ $prod_p }}%</span>
                            @endif {{ __('locale.From the previous month') }}
                        </p>
                    </div>
                </div>
            </div>
            <!-- Statistics Card -->
            <div class="col-xl-12 col-md-6 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">Statistics</h4>
                        <div class="d-flex align-items-center">
                            {{-- <p class="card-text font-small-2 mr-25 mb-0">Updated 1 month ago</p> --}}
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="media">
                                    <div class="avatar bg-light-primary mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="trending-up" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $cdaily_avg }}€</h4>
                                        <p class="card-text font-small-3 mb-0">Sales</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="media">
                                    <div class="avatar bg-light-info mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="user" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $customers }}</h4>
                                        <p class="card-text font-small-3 mb-0">Customers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="media">
                                    <div class="avatar bg-light-danger mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="box" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0"> {{ $products }}</h4>
                                        <p class="card-text font-small-3 mb-0">Products</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="media">
                                    <div class="avatar bg-light-success mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="dollar-sign" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $revenue }}</h4>
                                        <p class="card-text font-small-3 mb-0">Revenue</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--/ Statistics Card -->
            <div class="row match-height">
                <div class="col-lg-12 col-12">
                    <div class="row match-height">
                        <!-- Bar Chart - Orders -->
                        <div class="col-lg-6 col-md-3 col-6">
                            <div class="card">
                                <div class="card-body pb-50">
                                    <h6>Orders</h6>
                                    <h2 class="font-weight-bolder mb-1">{{ $orders_count }}</h2>
                                    <div id="statistics-order-chart"></div>
                                </div>
                            </div>
                        </div>
                        <!--/ Bar Chart - Orders -->

                        <!-- Line Chart - Profit -->
                        <div class="col-lg-6 col-md-3 col-6">
                            <div class="card card-tiny-line-stats">
                                <div class="card-body pb-50">
                                    <h6>Profit</h6>
                                    <h2 class="font-weight-bolder mb-1">6,24k</h2>
                                    <div id="statistics-profit-chart"></div>
                                </div>
                            </div>
                        </div>
                        <!--/ Line Chart - Profit -->

                        <!-- Earnings Card -->
                        <div class="col-lg-12 col-md-6 col-12">
                            <div class="card earnings-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 class="card-title mb-1">Earnings</h4>
                                            <div class="font-small-2">This Month</div>
                                            <h5 class="mb-1">$4055.56</h5>
                                            <p class="card-text text-muted font-small-2">
                                                <span class="font-weight-bolder">68.2%</span><span> more earnings than last
                                                    month.</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <div id="earnings-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Earnings Card -->
                    </div>
                </div>
            </div>
                <!-- Revenue Report Card -->
                <div class="row match-height">
                    <!-- Company Table Card -->
                    <div class="col-lg-12 col-12">
                        <div class="card " style="overflow-x:auto;">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table" id="mytable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('locale.ID') }}</th>
                                                <th>{{ __('locale.Employee') }}</th>
                                                <th>{{ __('locale.Products') }}</th>
                                                <th>{{ __('locale.completion') }}</th>
                                                <th>{{ __('locale.Price') }}</th>
                                                <th>{{ __('locale.Data') }}</th>
                                                <th>{{ __('locale.Express') }}</th>
                                                <th class="bg-danger text-light">{{ __('locale.Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td><a href="{{ url('invoices/' . $order->id) }}"
                                                            class="text-body font-weight-bold">{{ $order->id }}</a>
                                                    </td>
                                                    <td class="dropimg">
                                                        <?php
                        $order_ids=array();

                        foreach ($dropdown as $key => $drop){
                            $order_id_exploded=explode(",",$drop->order_id);
                            $status_id_exploded=explode(",",$drop->assing_status);
                            foreach ($order_id_exploded as $key => $value) {

                                $order_ids[]=$value;


                            }


                        }


                     if (in_array($order->id,$order_ids)) {

                        if (!empty($dropdown)){

                         foreach ($dropdown as $key1 => $drop1){
                            $order_id_exploded=explode(",",$drop1->order_id);
                            $status_id_exploded=explode(",",$drop1->assing_status);
                         foreach ($order_id_exploded as $key => $drop){
                             if ($drop == $order->id) {

                             ?>

                                                        <div class="hov">
                                                            <div class="dropdown">
                                                                <button id="orignalimg" class="dropdown-toggle"
                                                                    style="background-color: transparent;border: none;margin-left: 50%;margin-right: 50%;"
                                                                    type="button" id="dropdownMenuButton"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <img src="{!! asset('images/profiles/' . $drop1->profile_picture) !!}" id=""
                                                                        alt="user-image" class="rounded-circle image"
                                                                        width="30px" height="30px;" style="display: flex;">
                                                                </button>
                                                                <?php

                            unset($dropdown->$key);
                             }

                            }
                         }
                        }
                     }else {

                    ?>
                                                                <div class="hov">
                                                                    <div class="dropdown">
                                                                        <button id="orignalimg" class="dropdown-toggle"
                                                                            style="background-color: transparent;border: none;margin-left: 50%;margin-right: 50%;"
                                                                            type="button" id="dropdownMenuButton"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                            <img src="{!! asset('images/profiles/user.png') !!}"
                                                                                id="dropdown1" alt="user-image"
                                                                                class="rounded-circle image" width="30px"
                                                                                height="30px;">
                                                                        </button>

                                                                        <?php
                                        }

                                         ?>
                                                                        <div class="dropdown">
                                                                            <div class="dropdown-menu" id="myDropdown"
                                                                                aria-labelledby="dropdownMenuButton"
                                                                                style=" width: 350px !important;">
                                                                                @foreach ($employees as $key4 => $employe)
                                                                                    <?php
                                                        $order_id_exploded=explode(",",$employe->order_id);

                                                        foreach ($order_id_exploded as $key5 => $value) {

                                                    if($value==$order->id){

                                                        ?>
                                                                                    <div class="container">
                                                                                        <a type="button"
                                                                                            onclick="down({{ $employe->id }},{{ $order->id }},this)"
                                                                                            id="demo">
                                                                                            <div class="avatar">
                                                                                                <img src="{{ url('images/profiles/' . $employe->profile_picture) }}"
                                                                                                    alt="avatar" width="32"
                                                                                                    height="32">
                                                                                            </div>
                                                                                            @php
                                                                                                echo $employe->name . '&nbsp&nbsp&nbsp&nbsp' . $employe->userdetail->deutch_language, $employe->userdetail->english_language, $employe->userdetail->spanish_language, $employe->userdetail->french_language, $employe->userdetail->web_language, $employe->userdetail->Graphic_language, $employe->userdetail->Media_language;

                                                                                            @endphp





                                                                                        </a>
                                                                                        <span type="button"
                                                                                            class="float-right"
                                                                                            onclick="unassing({{ $employe->id }},{{ $order->id }})">
                                                                                            <div
                                                                                                class="avatar bg-light-danger">
                                                                                                <div
                                                                                                    class="avatar-content">
                                                                                                    <i
                                                                                                        class="fa fa-times"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                        </span>
                                                                                        <hr>
                                                                                    </div>
                                                                                    <?php

                                                        }
                                                    }

                                                        ?>
                                                                                @endforeach
                                                                                <?php

                                                                                ?>
                                                                                <input class="col-md-12" type="text"
                                                                                    placeholder="Search.."
                                                                                    id="myInput"><br><br>

                                                                                @foreach ($employees as $key4 => $employe)
                                                                                    <?php
                                                    $data=[];
                                                        $order_id_exploded=explode(",",$employe->order_id);

                                                        foreach ($order_id_exploded as $key5 => $value) {
                                                          array_push($data, $value);
                                                        }


                                                            if(in_array($order->id,$data)){


                                                        ?>


                                                                                    <?php
                                                   }else {

                                                   ?>
                                                                                    <div class="container">
                                                                                        <a type="button"
                                                                                            onclick="down({{ $employe->id }},{{ $order->id }},this)"
                                                                                            id="demo">
                                                                                            <div class="avatar">
                                                                                                <img src="{{ url('images/profiles/' . $employe->profile_picture) }}"
                                                                                                    alt="avatar" width="32"
                                                                                                    height="32">
                                                                                            </div>
                                                                                            @php
                                                                                                echo $employe->name . '&nbsp&nbsp&nbsp&nbsp' . $employe->userdetail->deutch_language, $employe->userdetail->english_language, $employe->userdetail->spanish_language, $employe->userdetail->french_language, $employe->userdetail->web_language, $employe->userdetail->Graphic_language, $employe->userdetail->Media_language;

                                                                                            @endphp
                                                                                        </a>
                                                                                        <span type="button"
                                                                                            class="float-right"
                                                                                            onclick="unassing({{ $employe->id }},{{ $order->id }})">
                                                                                            <div
                                                                                                class="avatar bg-light-danger">
                                                                                                <div
                                                                                                    class="avatar-content">
                                                                                                    <i
                                                                                                        class="fa fa-times"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                        </span>
                                                                                        <hr>
                                                                                    </div>
                                                                                    <?php
                                                   }
                                                ?>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                    </td>

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
                                                    <td class="completion_date">
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
                                                    <td class="paid">
                                                        @if ($order->payment_status == 1)
                                                            <span class="badge badge-success"> {{ $order->total_price }}
                                                                €</span>
                                                        @endif
                                                        @if ($order->payment_status == 0)
                                                            <span class="badge badge-dark"> {{ $order->total_price }}
                                                                €</span>
                                                        @endif
                                                        @if ($order->payment_status == -1)
                                                            <span class="badge badge-danger"> {{ $order->total_price }}
                                                                €</span>
                                                        @endif
                                                    </td>
                                                    <td class="date">
                                                        @if ($order->order_status == 0)
                                                            <p>
                                                            <div class="avatar bg-light-danger">
                                                                <div class="avatar-content"><i class="fa fa-times"></i>
                                                                </div>
                                                            </div>
                                                            </p>
                                                        @else
                                                            <p>
                                                            <div class="avatar bg-light-success">
                                                                <div class="avatar-content"><i class="fa fa-check"></i>
                                                                </div>
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
                                                    <td>
                                                        <a href="{{ url('invoicepdf/' . $order->id) }}"
                                                            class=""><i
                                                                class="fa fa-file-text text-primary mr-1"
                                                                aria-hidden="true" style="font-size: 1.5em;"></i></a>
                                                        <a href="{{ url('editorder/' . $order->id) }}"
                                                            class=""><i
                                                                class="fa fa-pencil-square-o text-primary mr-1"
                                                                aria-hidden="true" style="font-size: 1.5em;"></i></a>

                                                        <a href="{{ url('deleteorder/' . $order->id) }}"
                                                            class="delete-confirm "><i class="fa fa-trash-o text-danger"
                                                                aria-hidden="true" style="font-size: 1.5em;"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Company Table Card -->
                    <!-- Browser States Card -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-browser-states">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('locale.Inbox') }}</h4>
                                <img class="font-medium-3 cursor-pointer"
                                    src="{{ url('images/profiles/' . Auth::user()->profile_picture) }}"
                                    class="rounded-circle" alt="" style=" width:10%;">
                            </div>
                            <hr>


                            <div style="max-height: 250px;overflow-y: auto">
                                <div class="card-body">

                                    @if (!empty($employees))
                                        @foreach ($employees as $employee)
                                            <div class="browser-states">
                                                <div class="inbox-item" onclick="inbox_item({{ $employee->id }})"
                                                    style="border:0;cursor: pointer" data-id="">
                                                    <div class="media">
                                                        <img src="{{ url('images/profiles/' . $employee->profile_picture) }}"
                                                            class="rounded mr-1" height="30" alt="" />
                                                        <h6 class="align-self-center mb-0">{{ $employee->name }}</h6>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <p class="font-weight-bold text-body-heading mr-1"
                                                        id="inbox-item-date{{ $employee->id }}"
                                                        style="font-size: 140%;color:gray"><span
                                                            class="badge badge-success"
                                                            id="inbox-item-count{{ $employee->id }}">{{ $employee->count }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-browser-states">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('locale.Chat') }}</h4>
                                {{-- <img  class="font-medium-3 cursor-pointer" src="{{url('images/profiles/'.Auth::user()->profile_picture)}}" class="rounded-circle" alt="" style=" width:10%;"> --}}
                            </div>
                            <hr style="color: black;">
                            <div style="max-height: 250px;overflow-y: auto">
                                <div class="card-body">

                                    <div class="chat-conversation">
                                        <ul class="conversation-list slimscroll" style="max-height: 315px;">
                                            <li class="row">
                                                @if (!empty($employee))
                                                    <div class="col-md-3"
                                                        style="text-align: center;padding-right: 2px"><img
                                                            src="{{ url('images/profiles/' . $employee->profile_picture) }}"
                                                            style="width:80%" class="rounded-circle" alt="">
                                                        <span style="font-size: 10px">10:00</span>
                                                    </div>
                                                @endif
                                                <div class="col-md-9" style="padding-left:0px;">
                                                    <div
                                                        style="display:inline-block;background-color: #F2F5F7;padding: 8px">
                                                        <span style="display: block;font-weight: bold">Izhar</span>
                                                        <span style="font-size: 10px">Hi this izhar ali</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="row" style="text-align: right">
                                                <div class="col-md-9" style="padding-right:0px;">
                                                    <div
                                                        style="display:inline-block;background-color: #F9DDD7;padding: 8px">
                                                        <span style="display: block;font-weight: bold">Izhar</span>
                                                        <span style="font-size: 10px">Hi this izhar ali</span>
                                                    </div>
                                                </div>
                                                @if (!empty($employee))
                                                    <div class="col-md-3"
                                                        style="text-align: center;padding-left: 2px"><img
                                                            src="{{ url('images/profiles/' . $employee->profile_picture) }}"
                                                            style="width:80%" class="rounded-circle" alt="">
                                                        <span style="font-size: 10px">10:00</span>
                                                        {{-- <input type="text" id="hidden_em" --}}
                                                    </div>
                                                @endif
                                            </li>
                                        </ul>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control chat-input"
                                                    placeholder="Enter your text">
                                                <input type="hidden" id="hidden_em">
                                            </div>
                                            @if (!empty($employee))
                                                <div class="col-auto">
                                                    <button type="submit" id="hidden_em"
                                                        onclick="chat_send({{ $employee->id }})"
                                                        class="btn btn-danger chat-send btn-block waves-effect waves-light"
                                                        disabled>Send</button>
                                                </div>
                                            @else
                                                <div class="col-auto">
                                                    <button type="submit"
                                                        class="btn btn-danger chat-send btn-block waves-effect waves-light"
                                                        disabled>Send</button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-browser-states">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('locale.Tasks') }}</h4>
                                <img class="font-medium-3 cursor-pointer"
                                    src="{{ url('images/profiles/' . Auth::user()->profile_picture) }}"
                                    class="rounded-circle" alt="" style=" width:10%;">
                            </div>
                            <hr>
                            <div style="max-height: 250px;overflow-y: auto">
                                <div class="card-body">


                                    @if (!empty($employees))
                                        @foreach ($employees as $employee)
                                            <div class="browser-states">
                                                <div class="inbox-item" onclick="inbox_item({{ $employee->id }})"
                                                    style="border:0;cursor: pointer" data-id="">
                                                    <div class="media">
                                                        <img src="{{ url('images/profiles/' . $employee->profile_picture) }}"
                                                            class="rounded mr-1" height="30" alt="" />
                                                        <h6 class="align-self-center mb-0">{{ $employee->name }}</h6>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <p class="font-weight-bold text-body-heading mr-1"
                                                        id="inbox-item-date{{ $employee->id }}"
                                                        style="font-size: 140%;color:gray"><span
                                                            class="badge badge-success"
                                                            id="inbox-item-count{{ $employee->id }}">{{ $employee->count }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Transaction Card -->
                </div>
    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>

@endsection
<script>
    function down(id, order, elem) {
        $.ajax({
            type: 'GET',
            url: 'dropupdate/' + id + '/' + order,
            success: function(data) {
                $("#mytable").load("/dashboard #mytable");
                // location.reload();

            }
        });
    }

    function unassing(id, order) {
        $.ajax({
            type: 'GET',
            url: 'unassingemploy/' + id + '/' + order,
            success: function(data) {
                $("#mytable").load("/dashboard #mytable");

            }
        });
    }


    function inbox_item(id) {
        $('#hidden_em').val(id);
        //   var id=$(this).attr('data-id');
        $('.chat-send').attr('disabled', false);
        // id=$(this).attr('data-id');
        $('#inbox-item-count' + id).text('0');
        $('#inbox-item-count' + id).hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }

        });
        jQuery.ajax({
            url: "{{ url('/read') }}",
            method: 'post',
            data: {
                to: id
            },
            success: function(result) {

                console.log(result);

            },
            error: function(result) {

                console.log(result);

            }
        });
        jQuery.ajax({
            url: "{{ url('/getall') }}" + '/' + id,
            method: 'get',
            success: function(result) {
                console.log(result);
                $('.conversation-list').html('');


                for (res in result) {
                    var d = new Date(result[res].created_at);
                    var time = d.getHours() + ':' + d.getMinutes();

                    if (result[res].from == {{ Auth::user()->id }}) {

                        $('.conversation-list').append(
                            ' <li class="row" style="text-align: right"> <div class="col-md-9" style="padding-right:0px;"> <div style="display:inline-block;background-color: #F9DDD7;padding: 8px"> <span style="display: block;font-weight: bold">{{ Auth::user()->name }}</span> <span style="font-size: 10px">' +
                            result[res].messages +
                            '</span> </div> </div> <div class="col-md-3" style="text-align: center;padding-left: 2px"><img src="{{ url('images/profiles/' . Auth::user()->profile_picture) }}" style="width:80%" class="rounded-circle" alt=""> <span style="font-size: 10px">' +
                            time + '</span> </div> </li>');
                    } else {
                        $('.conversation-list').append(
                            '<li class="row"> <div class="col-md-3" style="text-align: center;padding-right: 2px"><img src="{{ url('images/profiles/') }}' +
                            '/' + result[res].from_contact.profile_picture +
                            '"  style="width:80%" class="rounded-circle" alt=""> <span style="font-size: 10px">' +
                            time +
                            '</span> </div> <div class="col-md-9" style="padding-left:0px;"> <div style="display:inline-block;background-color: #F2F5F7;padding: 8px"> <span style="display: block;font-weight: bold">' +
                            result[res].from_contact.name + '</span> <span style="font-size: 10px">' +
                            result[res].messages + '</span> </div> </div> </li>');

                    }

                }
            }
        });
    }

    function chat_send(employee) {
        //    var dt = $(this).val();
        //    alert(dt)
        var date = new Date();
        var time = date.getHours() + ':' + date.getMinutes();
        var message = $('.chat-input').val();
        var id = $('#hidden_em').val();



        $('.chat-input').val('');
        $('.conversation-list').append(
            '<li class="row" style="text-align: right"> <div class="col-md-9" style="padding-right:0px;"> <div style="display:inline-block;background-color: #F9DDD7;padding: 8px"> <span style="display: block;font-weight: bold">{{ Auth::user()->name }}</span> <span style="font-size: 10px">' +
            message +
            '</span> </div> </div> <div class="col-md-3" style="text-align: center;padding-left: 2px"><img src="{{ url('images/profiles/' . Auth::user()->profile_picture) }}" style="width:80%" class="rounded-circle" alt=""> <span style="font-size: 10px">' +
            time + '</span> </div> </li>');
        $('.conversation-list').scrollTop($('.conversation-list')[0].scrollHeight);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/send') }}",
            method: 'post',
            data: {
                message: message,
                to: id,
                from: {{ \Illuminate\Support\Facades\Auth::user()->id }},
                profile_picture: '{{ \Illuminate\Support\Facades\Auth::user()->profile_picture }}',
                name: '{{ \Illuminate\Support\Facades\Auth::user()->name }}'
            },
            success: function(result) {

                console.log(result);

            }
        });
    }
</script>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    var id = 0;
    var pusher = new Pusher('d7767093b596500eb0a2', {

        cluster: 'mt1',
        forceTLS: true
    });
    var channel = pusher.subscribe('my-channel' + {{ Auth::user()->id }});
    channel.bind('my-event', function(data) {
        var date = new Date();
        var time = date.getHours() + ':' + date.getMinutes();
        if (id != null && (id === data.from)) {
            $('.conversation-list').append(
                ' <li class="clearfix odd">\n' +
                '                        <div class="chat-avatar">\n' +
                '                            <img src="{{ url('images/profiles/') }}' + '/' + data
                .profile_picture + '" alt="male">\n' +
                '                            <i>' + time + '</i>\n' +
                '                        </div>\n' +
                '                        <div class="conversation-text">\n' +
                '                            <div class="ctext-wrap">\n' +
                '                                <i>' + data.name + '</i>\n' +
                '                                <p>\n' +
                data.message +
                '                                </p>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </li>'
            );
            $('.conversation-list').scrollTop($('.conversation-list')[0].scrollHeight);

            jQuery.ajax({
                url: "{{ url('/readreceipt') }}",
                method: 'post',
                data: {
                    id: data.id,
                },
                success: function(result) {

                    console.log(result);

                }
            });
        } else {

            //incrementing the message count
            var msg_count = parseInt($('#inbox-item-count' + data.from).text());
            msg_count++;
            $('#inbox-item-count' + data.from).text(msg_count);
            $('#inbox-item-count' + data.from).show();
        }

    });
</script>
{{-- CHAT LOGIC HERE --}}
<script></script>
