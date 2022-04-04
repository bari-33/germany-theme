
@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Ecommerce')

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

    .card_bg{
        background-color: #f8ceec;
        background-image: linear-gradient(315deg, #9e9bd0 0%, #595592 74%);
        color: white;
    }

    .card_bg_color{
        color: white !important;
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
          <i class="fa fa-info-circle text-light float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
          <h5> {{ __('locale.Orders') }}</h5>
          <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color"> {{$orders_count}} </span> <i class="fa fa-shopping-cart text-light"  style="float: right"></i></h2>
          <p class="mt-5 card_bg_color">
            @if($order_p > 0)
            <span style="background-color: #50a5e8;padding: 3px;">{{$order_p}}%</span>
            @elseif($order_p < 0)
            <span style="background-color: #e25757;padding: 3px;">{{$order_p}}%</span>
            @elseif($order_p==0)
            <span style="background-color: #eaa20e;padding: 3px;">{{$order_p}}%</span>
            @endif  {{ __('locale.From the previous month') }}</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card card-congratulation-medal">
          <div class="card-body card_bg">
            <i class="fa fa-info-circle text-light float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
            <h5> {{ __('locale.REVENUE') }}</h5>
            <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color"> {{$revenue}} </span> <i class="fa fa-money text-light"  style="float: right"></i></h2>
            <p class="mt-5 card_bg_color">
                @if($order_r > 0)
                <span style="background-color: #50a5e8;padding: 3px;">{{$order_r}}%</span>
                @elseif($order_r < 0)
                <span style="background-color: #e25757;padding: 3px;">{{$order_r}}%</span>
                @elseif($order_r==0)
                <span style="background-color: #eaa20e;padding: 3px;">{{$order_r}}%</span>
              @endif  {{ __('locale.From the previous month') }}</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 col-12">
        <div class="card card-congratulation-medal">
          <div class="card-body card_bg">
            <i class="fa fa-info-circle text-light float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
            <h5> {{ __('locale.DAILY AVERAGE') }}</h5>
            <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color"> {{$cdaily_avg}} </span> <i class="fa fa-bar-chart text-light"  style="float: right"></i></h2>
            <p class="mt-5 card_bg_color">
                @if($avg_p > 0)
                <span style="background-color: #50a5e8;padding: 3px;">{{$avg_p}}%</span>
                @elseif($avg_p < 0)
                <span style="background-color: #e25757;padding: 3px;">{{$avg_p}}%</span>
                @elseif($avg_p==0)
                <span style="background-color: #eaa20e;padding: 3px;">{{$avg_p}}%</span>
              @endif  {{ __('locale.From the previous month') }}</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 col-12">
        <div class="card card-congratulation-medal">
          <div class="card-body card_bg">
            <i class="fa fa-info-circle text-light float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
            <h5> {{ __('locale.Products') }}</h5>
            <h2 class="text-primary my-3 card_bg_color"><span data-plugin="counterup" class="card_bg_color"> {{$products}} </span> <i class="fa fa-suitcase text-light"  style="float: right"></i></h2>
            <p class="mt-5 card_bg_color">
                @if($prod_p > 0)
                <span style="background-color: #50a5e8;padding: 3px;">{{$prod_p}}%</span>
                @elseif($prod_p < 0)
                <span style="background-color: #e25757;padding: 3px;">{{$prod_p}}%</span>
                @elseif($prod_p==0)
                <span style="background-color: #eaa20e;padding: 3px;">{{$prod_p}}%</span>
              @endif  {{ __('locale.From the previous month') }}</p>
          </div>
        </div>
      </div>
    <!-- Revenue Report Card -->
      <div class="row match-height">
    <!-- Company Table Card -->
    <div class="col-lg-12 col-12">
      <div class="card card-company-table">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table">
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
                    <td><a href="" class="text-body font-weight-bold">{{ $order->id }}</a></td>
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
                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{!! asset('images/profiles/'. $drop1->profile_picture) !!}" id="" alt="user-image"
                                class="rounded-circle image" width="30px" height="30px;" style="display: flex;">
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
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <img src="{!! asset('images/profiles/user.png') !!}" id="dropdown1" alt="user-image"
                                            class="rounded-circle image" width="30px" height="30px;">
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
                                                        <div class="avatar"><img
                                                                src="{{ url('images/profiles/' . $employe->profile_picture) }}"
                                                                alt="avatar" width="32" height="32">
                                                        </div>
                                                        @php
                                                            echo $employe->name . '&nbsp&nbsp&nbsp&nbsp' . $employe->userdetail->deutch_language, $employe->userdetail->english_language, $employe->userdetail->spanish_language, $employe->userdetail->french_language, $employe->userdetail->web_language, $employe->userdetail->Graphic_language, $employe->userdetail->Media_language;

                                                        @endphp





                                                    </a>
                                                    <span type="button" class="float-right"
                                                    onclick="unassing({{ $employe->id }},{{ $order->id }})">
                                                    <div class="avatar bg-light-danger">
                                                        <div class="avatar-content"><i
                                                                class="fa fa-times"
                                                                data-feather="x"></i></div>
                                                    </div></span>
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
                                                placeholder="Search.." id="myInput"><br><br>

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
                                                        <div class="avatar"><img
                                                                src="{{ url('images/profiles/' . $employe->profile_picture) }}"
                                                                alt="avatar" width="32" height="32">
                                                        </div>
                                                        @php
                                                            echo $employe->name . '&nbsp&nbsp&nbsp&nbsp' . $employe->userdetail->deutch_language, $employe->userdetail->english_language, $employe->userdetail->spanish_language, $employe->userdetail->french_language, $employe->userdetail->web_language, $employe->userdetail->Graphic_language, $employe->userdetail->Media_language;

                                                        @endphp
                                                    </a>
                                                    <span type="button" class="float-right"
                                                    onclick="unassing({{ $employe->id }},{{ $order->id }})">
                                                    <div class="avatar bg-light-danger">
                                                        <div class="avatar-content"><i
                                                                class="avatar-icon"
                                                                data-feather="x"></i></div>
                                                    </div></span>
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
                        @if ($order->order_status == 1 )
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
                        @if($order->payment_status==1)
                        <span class="badge badge-success"> {{$order->total_price}} €</span>
                        @endif
                        @if($order->payment_status==0)
                        <span class="badge badge-dark"> {{$order->total_price}} €</span>
                        @endif
                        @if($order->payment_status ==-1)
                        <span class="badge badge-danger"> {{$order->total_price}} €</span>
                        @endif
                    </td>
                    <td class="date">
                        @if ($order->order_status == 0)
                            <p><div class="avatar bg-light-danger">
                                <div class="avatar-content"><i
                                        class="fa fa-times"
                                        ></i></div>
                            </div></p>
                        @else
                            <p><div class="avatar bg-light-success">
                                <div class="avatar-content"><i class="fa fa-check"></i></div>
                              </div></p>
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
                        <a href="{{ url('invoicepdf/'.$order->id) }}"
                            class=""><i
                                class="fa fa-file-text text-primary mr-1" aria-hidden="true"
                                style="font-size: 1.5em;"></i></a>
                        <a href="{{ url('editorder/'.$order->id) }}"
                            class=""><i
                                class="fa fa-pencil-square-o text-primary mr-1" aria-hidden="true"
                                style="font-size: 1.5em;"></i></a>

                         <a href="{{ url('deleteorder/' . $order->id) }}" class="delete-confirm "><i
                                    class="fa fa-trash-o text-danger" aria-hidden="true"
                                    style="font-size: 1.5em;"></i></a>
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

    <!-- Developer Meetup Card -->
    <div class="col-lg-4 col-md-6 col-12">
      <div class="card card-developer-meetup">
        <div class="meetup-img-wrapper rounded-top text-center">
          <img src="{{asset('images/illustration/email.svg')}}" alt="Meeting Pic" height="170" />
        </div>
        <div class="card-body">
          <div class="meetup-header d-flex align-items-center">
            <div class="meetup-day">
              <h6 class="mb-0">THU</h6>
              <h3 class="mb-0">24</h3>
            </div>
            <div class="my-auto">
              <h4 class="card-title mb-25">Developer Meetup</h4>
              <p class="card-text mb-0">Meet world popular developers</p>
            </div>
          </div>
          <div class="media">
            <div class="avatar bg-light-primary rounded mr-1">
              <div class="avatar-content">
                <i data-feather="calendar" class="avatar-icon font-medium-3"></i>
              </div>
            </div>
            <div class="media-body">
              <h6 class="mb-0">Sat, May 25, 2020</h6>
              <small>10:AM to 6:PM</small>
            </div>
          </div>
          <div class="media mt-2">
            <div class="avatar bg-light-primary rounded mr-1">
              <div class="avatar-content">
                <i data-feather="map-pin" class="avatar-icon font-medium-3"></i>
              </div>
            </div>
            <div class="media-body">
              <h6 class="mb-0">Central Park</h6>
              <small>Manhattan, New york City</small>
            </div>
          </div>
          <div class="avatar-group">
            <div
              data-toggle="tooltip"
              data-popup="tooltip-custom"
              data-placement="bottom"
              data-original-title="Billy Hopkins"
              class="avatar pull-up"
            >
              <img src="{{asset('images/portrait/small/avatar-s-9.jpg')}}" alt="Avatar" width="33" height="33" />
            </div>
            <div
              data-toggle="tooltip"
              data-popup="tooltip-custom"
              data-placement="bottom"
              data-original-title="Amy Carson"
              class="avatar pull-up"
            >
              <img src="{{asset('images/portrait/small/avatar-s-6.jpg')}}" alt="Avatar" width="33" height="33" />
            </div>
            <div
              data-toggle="tooltip"
              data-popup="tooltip-custom"
              data-placement="bottom"
              data-original-title="Brandon Miles"
              class="avatar pull-up"
            >
              <img src="{{asset('images/portrait/small/avatar-s-8.jpg')}}" alt="Avatar" width="33" height="33" />
            </div>
            <div
              data-toggle="tooltip"
              data-popup="tooltip-custom"
              data-placement="bottom"
              data-original-title="Daisy Weber"
              class="avatar pull-up"
            >
              <img
                src="{{asset('images/portrait/small/avatar-s-20.jpg')}}"
                alt="Avatar"
                width="33"
                height="33"
              />
            </div>
            <div
              data-toggle="tooltip"
              data-popup="tooltip-custom"
              data-placement="bottom"
              data-original-title="Jenny Looper"
              class="avatar pull-up"
            >
              <img
                src="{{asset('images/portrait/small/avatar-s-20.jpg')}}"
                alt="Avatar"
                width="33"
                height="33"
              />
            </div>
            <h6 class="align-self-center cursor-pointer ml-50 mb-0">+42</h6>
          </div>
        </div>
      </div>
    </div>
    <!--/ Developer Meetup Card -->

    <!-- Browser States Card -->
    <div class="col-lg-4 col-md-6 col-12">
      <div class="card card-browser-states">
        <div class="card-header">
          <div>
            <h4 class="card-title">Browser States</h4>
            <p class="card-text font-small-2">Counter August 2020</p>
          </div>
          <div class="dropdown chart-dropdown">
            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-toggle="dropdown"></i>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
              <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
              <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="browser-states">
            <div class="media">
              <img
                src="{{asset('images/icons/google-chrome.png')}}"
                class="rounded mr-1"
                height="30"
                alt="Google Chrome"
              />
              <h6 class="align-self-center mb-0">Google Chrome</h6>
            </div>
            <div class="d-flex align-items-center">
              <div class="font-weight-bold text-body-heading mr-1">54.4%</div>
              <div id="browser-state-chart-primary"></div>
            </div>
          </div>
          <div class="browser-states">
            <div class="media">
              <img
                src="{{asset('images/icons/mozila-firefox.png')}}"
                class="rounded mr-1"
                height="30"
                alt="Mozila Firefox"
              />
              <h6 class="align-self-center mb-0">Mozila Firefox</h6>
            </div>
            <div class="d-flex align-items-center">
              <div class="font-weight-bold text-body-heading mr-1">6.1%</div>
              <div id="browser-state-chart-warning"></div>
            </div>
          </div>
          <div class="browser-states">
            <div class="media">
              <img
                src="{{asset('images/icons/apple-safari.png')}}"
                class="rounded mr-1"
                height="30"
                alt="Apple Safari"
              />
              <h6 class="align-self-center mb-0">Apple Safari</h6>
            </div>
            <div class="d-flex align-items-center">
              <div class="font-weight-bold text-body-heading mr-1">14.6%</div>
              <div id="browser-state-chart-secondary"></div>
            </div>
          </div>
          <div class="browser-states">
            <div class="media">
              <img
                src="{{asset('images/icons/internet-explorer.png')}}"
                class="rounded mr-1"
                height="30"
                alt="Internet Explorer"
              />
              <h6 class="align-self-center mb-0">Internet Explorer</h6>
            </div>
            <div class="d-flex align-items-center">
              <div class="font-weight-bold text-body-heading mr-1">4.2%</div>
              <div id="browser-state-chart-info"></div>
            </div>
          </div>
          <div class="browser-states">
            <div class="media">
              <img src="{{asset('images/icons/opera.png')}}" class="rounded mr-1" height="30" alt="Opera Mini" />
              <h6 class="align-self-center mb-0">Opera Mini</h6>
            </div>
            <div class="d-flex align-items-center">
              <div class="font-weight-bold text-body-heading mr-1">8.4%</div>
              <div id="browser-state-chart-danger"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Browser States Card -->

    <!-- Goal Overview Card -->
    <div class="col-lg-4 col-md-6 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title">Goal Overview</h4>
          <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
        </div>
        <div class="card-body p-0">
          <div id="goal-overview-radial-bar-chart" class="my-2"></div>
          <div class="row border-top text-center mx-0">
            <div class="col-6 border-right py-1">
              <p class="card-text text-muted mb-0">Completed</p>
              <h3 class="font-weight-bolder mb-0">786,617</h3>
            </div>
            <div class="col-6 py-1">
              <p class="card-text text-muted mb-0">In Progress</p>
              <h3 class="font-weight-bolder mb-0">13,561</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Goal Overview Card -->

    <!-- Transaction Card -->
    <div class="col-lg-4 col-md-6 col-12">
      <div class="card card-transaction">
        <div class="card-header">
          <h4 class="card-title">Transactions</h4>
          <div class="dropdown chart-dropdown">
            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-toggle="dropdown"></i>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
              <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
              <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="transaction-item">
            <div class="media">
              <div class="avatar bg-light-primary rounded">
                <div class="avatar-content">
                  <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                </div>
              </div>
              <div class="media-body">
                <h6 class="transaction-title">Wallet</h6>
                <small>Starbucks</small>
              </div>
            </div>
            <div class="font-weight-bolder text-danger">- $74</div>
          </div>
          <div class="transaction-item">
            <div class="media">
              <div class="avatar bg-light-success rounded">
                <div class="avatar-content">
                  <i data-feather="check" class="avatar-icon font-medium-3"></i>
                </div>
              </div>
              <div class="media-body">
                <h6 class="transaction-title">Bank Transfer</h6>
                <small>Add Money</small>
              </div>
            </div>
            <div class="font-weight-bolder text-success">+ $480</div>
          </div>
          <div class="transaction-item">
            <div class="media">
              <div class="avatar bg-light-danger rounded">
                <div class="avatar-content">
                  <i data-feather="dollar-sign" class="avatar-icon font-medium-3"></i>
                </div>
              </div>
              <div class="media-body">
                <h6 class="transaction-title">Paypal</h6>
                <small>Add Money</small>
              </div>
            </div>
            <div class="font-weight-bolder text-success">+ $590</div>
          </div>
          <div class="transaction-item">
            <div class="media">
              <div class="avatar bg-light-warning rounded">
                <div class="avatar-content">
                  <i data-feather="credit-card" class="avatar-icon font-medium-3"></i>
                </div>
              </div>
              <div class="media-body">
                <h6 class="transaction-title">Mastercard</h6>
                <small>Ordered Food</small>
              </div>
            </div>
            <div class="font-weight-bolder text-danger">- $23</div>
          </div>
          <div class="transaction-item">
            <div class="media">
              <div class="avatar bg-light-info rounded">
                <div class="avatar-content">
                  <i data-feather="trending-up" class="avatar-icon font-medium-3"></i>
                </div>
              </div>
              <div class="media-body">
                <h6 class="transaction-title">Transfer</h6>
                <small>Refund</small>
              </div>
            </div>
            <div class="font-weight-bolder text-success">+ $98</div>
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

function down(id, order,elem) {
            $.ajax({
                type: 'GET',
                url: 'dropupdate/' + id + '/' + order,
                success: function(data) {
                    location.reload();

                }
            });
        }
        function unassing(id, order) {
            $.ajax({
                type: 'GET',
                url: 'unassingemploy/' + id + '/' + order,
                success: function(data) {
                    location.reload();

                }
            });
        }
</script>
