@extends('layouts/contentLayoutMaster')

@section('title', 'DataTables')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel=”stylesheet” href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
        .pagination>li>a,
        .pagination>li>span {
            border-radius: 50% !important;
            margin: 0 5px;
        }

        .hov:hover .image {
            opacity: 0.3;
            vertical-align:
        }

        .hov:hover .middle {
            opacity: 1;
        }

        #myDropdown {
            width: 250px !important;
        }

        /* style="display: block;right:-200%;position:absolute;top:-86%" */
        #table_image {
            /* display: inline-block;
                right: -186%;
                position: absolute;
                top: -86%; */
            margin-right: -10px;
        }

        .default-avatar,
        .member-overlap-item {
            height: 30px;
            width: 30px;
        }

        .member-overlap-item {
            margin-right: -10px;
            border: 2px solid #fff;
        }
    </style>
    <style>
        .dropbtn {
            /* background-color: #04AA6D; */
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            /* background-color: #f1f1f1; */
            min-width: 160px;
            /* box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2); */
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            /* padding: 12px 16px; */
            text-decoration: none;
            display: block;
        }

        /* notify */

        #notificationBarBottom {
            position: fixed;
            z-index: 101;
            bottom: 10;
            left: 30%;
            right: 10%;
            transform: translateY(calc(100% + 10px));
            background: #dbe7db;
            color: #000000;
            text-align: center;
            line-height: 2.5;
            box-shadow: 0 0 5px black;
        }

        @keyframes slideUp {
            0% {
                transform: translateY(100% + 10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        #notificationBarBottom {
            animation: slideUp 1s ease forwards;
        }

        #close {
            display: none;
        }

        /* added to show how to hide with a click */
        @keyframes slideDown {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(100% + 10px);
            }
        }

        #notificationBarBottom.hideMe {
            animation: slideDown 2.5s ease forwards;
        }

        /* .dropdown-content a:hover {background-color: #ddd;} */

        .dropdown:hover .dropdown-content {
            display: block;
        }

        #allSelector {
            display: none;
        }

        th.allcheckboxex:hover #allSelector {
            display: block;
        }

        .checkbox {
            display: none;
        }

        td.checkboxdisplay:hover input {
            display: block;
        }

        /* .dropdown:hover .dropbtn {background-color: #3e8e41;} */
    </style>
@endsection

@section('content')
@section('content')
    <!-- Basic table -->
    <h1>{{ __('locale.List Orders') }}</h1>
    <section id="basic-datatable">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <center style="margin-top:13px;margin-right:112px"> --}}
                            <center style="margin-top:10px">
                                <div class="row">
                                    <div class="col-md-9">
                                        <form action="{{ url('searchorder') }}" method="POST">
                                            @csrf
                                            <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                                name="action" value="all" class="btn btn-primary">{{ __('locale.All') }}
                                                |
                                                {{ session('all') }} </button>
                                            <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                                name="action" value="progress"
                                                class="btn btn-primary">{{ __('locale.In Progress') }} |
                                                {{ session('progress') }} </button>
                                            <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                                name="action" value="waiting"
                                                class="btn btn-primary">{{ __('locale.On hold') }}
                                                |
                                                {{ session('waiting') }} </button>
                                            <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                                name="action" value="completed"
                                                class="btn btn-primary">{{ __('locale.Done') }}
                                                |
                                                {{ session('completed') }} </button>
                                            <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                                name="action" value="cancelled"
                                                class="btn btn-primary">{{ __('locale.Canceled') }}
                                                |
                                                {{ session('cancelled') }} </button>
                                            <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                                name="action" value="deleted"
                                                class="btn btn-primary">{{ __('locale.Deleted') }}
                                                |
                                                {{ session('deleted') }} </button>
                                            <div class="dropdown"
                                                style="display: inline;background-color: #3b3f77;border-radius: 25px;border-color: white;">
                                                <button style="background-color: #3b3f77;border-color: white;"
                                                    type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    {{ __('locale.Last 30 Days') }}
                                                </button>
                                        </form>
                                        <div class="dropdown-menu">

                                            <form method="post" action="{{ url('searchorder') }}">
                                                @csrf
                                                @php $date = date('Y-m-d',strtotime('-30 days')); @endphp
                                                <input type="hidden" name="action" value="custom_date">
                                                <input type="hidden" id="date_from" required name="date_from"
                                                    class="form-control" placeholder="Van" style="margin-bottom: 10px"
                                                    value="{{ $date }}">

                                                <input type="hidden" id="date_to" required name="date_to"
                                                    class="form-control" style="margin-bottom: 10px" placeholder="Bis"
                                                    value="{{ date('Y-m-d') }}">

                                                <button type="submit"
                                                    style="background-color: transparent;color: black;text-align: left;"
                                                    class="btn btn-block"> {{ __('locale.Last 30 Days') }}</button>
                                            </form>


                                            <form method="post" action="{{ url('searchorder') }}">
                                                @csrf
                                                @php $date = date('Y-m-d',strtotime('-90 days')); @endphp
                                                <input type="hidden" name="action" value="custom_date">
                                                <input type="hidden" id="date_from" required name="date_from"
                                                    class="form-control" placeholder="Van" style="margin-bottom: 10px"
                                                    value="{{ $date }}">

                                                <input type="hidden" id="date_to" required name="date_to"
                                                    class="form-control" style="margin-bottom: 10px" placeholder="Bis"
                                                    value="{{ date('Y-m-d') }}">

                                                <button type="submit"
                                                    style="background-color: transparent;color: black;text-align: left;"
                                                    class="btn btn-block"> {{ __('locale.Last 90 Days') }}</button>
                                            </form>
                                            <form method="post" action="{{ url('searchorder') }}">
                                                @csrf
                                                @php $year = date('Y')-2; @endphp
                                                <input type="hidden" name="action" value="custom_date">
                                                <input type="hidden" id="date_from" required name="date_from"
                                                    class="form-control" placeholder="Van" style="margin-bottom: 10px"
                                                    value="{{ $year }}-01-01">

                                                <input type="hidden" id="date_to" required name="date_to"
                                                    class="form-control" style="margin-bottom: 10px" placeholder="Bis"
                                                    value="{{ $year }}-12-31">

                                                <button type="submit"
                                                    style="background-color: transparent;color: black;text-align: left;"
                                                    class="btn btn-block">{{ date('Y') - 2 }}</button>
                                            </form>

                                            <form method="post" action="{{ url('searchorder') }}">
                                                @csrf
                                                @php $year = date('Y')-1; @endphp
                                                <input type="hidden" name="action" value="custom_date">
                                                <input type="hidden" id="date_from" required name="date_from"
                                                    class="form-control" placeholder="Van" style="margin-bottom: 10px"
                                                    value="{{ $year }}-01-01">

                                                <input type="hidden" id="date_to" required name="date_to"
                                                    class="form-control" style="margin-bottom: 10px" placeholder="Bis"
                                                    value="{{ $year }}-12-31">

                                                <button type="submit"
                                                    style="background-color: transparent;color: black;text-align: left;"
                                                    class="btn btn-block">{{ date('Y') - 1 }}</button>
                                            </form>
                                            <form method="post" action="{{ url('searchorder') }}">
                                                @csrf
                                                <input type="hidden" name="action" value="custom_date">
                                                <input type="date" id="date_from" required name="date_from"
                                                    class="form-control" placeholder="Van" style="margin-bottom: 10px">

                                                <input type="date" id="date_to" required name="date_to"
                                                    class="form-control" style="margin-bottom: 10px" placeholder="Bis">

                                                <button type="submit" style="background-color: silver"
                                                    class="btn btn-block">{{ __('locale.Send') }}</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-3">
                                        <a href="{{ 'add_order' }}" type="button"
                                            class="float-right btn btn-success mr-1"><i class="fa fa-plus"
                                                aria-hidden="true"></i>{{ __('locale.Add New Order') }}</a>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic table -->
        <section id="basic-datatable">

            <div class="row">
                <div class="col-12">

                    <div class="card" style="overflow-x:auto;">
                        <input type="hidden" id="order" name="check">
                        <form action="{{ url('deleteall') }}" method="POST">
                            @csrf
                            {{-- <div class="dropdown">
                                <div class="container mt-3">
                                    <button class="dropdown-toggle btn btn-dark" type="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Orders button
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        <button class="col-md-12 multiSelector"
                                            style="border: none;background-color: rgb(255, 255, 255);"
                                            type="submit">Delete</button><br>
                                        <button class="col-md-12 multiSelector" style="border: none;background-color: #fff;"
                                            type="submit" formaction="{{ url('paid') }}">Mark as paid</button><br>
                                        <button class="col-md-12 multiSelector" style="border: none;background-color: #fff;"
                                            type="submit" formaction="{{ url('allinvoice') }}">Download all</button>
                                        <button class="col-md-12 multiSelector" style="border: none;background-color: #fff;"
                                            type="submit" formaction="{{ url('restore') }}">Restoring</button>


                                    </div>
                                </div>
                            </div> --}}

                            <div id="notificationBarBottom" class="hideMe">
                                <div class="row">
                                    <div class="col-md-6" style="padding: 5px;">
                                        <span>Total Selected : </span><span class="totalselected">0</span>
                                    </div>
                                    <div class="col-md-6" style="padding: 5px;">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="dropdown">
                                                    <div class="container">
                                                        <button class="dropdown-toggle btn btn-dark" type="button"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">Order Buttons
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                            <button class="col-md-12 multiSelector"
                                                                style="border: none;background-color: rgb(255, 255, 255);"
                                                                type="submit">Delete</button><br>
                                                            <button class="col-md-12 multiSelector"
                                                                style="border: none;background-color: #fff;"
                                                                type="submit" formaction="{{ url('paid') }}">Mark as
                                                                paid</button><br>
                                                            <button class="col-md-12 multiSelector"
                                                                style="border: none;background-color: #fff;"
                                                                type="submit"
                                                                formaction="{{ url('allinvoice') }}">Download all</button>
                                                            <button class="col-md-12 multiSelector"
                                                                style="border: none;background-color: #fff;"
                                                                type="submit"
                                                                formaction="{{ url('restore') }}">Restoring</button>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="margin-top: 7.5px">
                                                <button class="btn btn-sm btn-danger" id="hideorderbutton"><i
                                                        class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="datatables table mb-0" id="mytable" style="color: #000;">
                                <div class="container mt-3">
                                    <thead>
                                        <tr>
                                            <th class="allcheckboxex">{{ __('locale.Select All') }}
                                                <input type="checkbox" name="" onclick="checkboxs()"
                                                    id="allSelector">
                                            </th>
                                            <th>{{ __('locale.ID') }}</th>
                                            <th>{{ __('locale.Employee') }}</th>
                                            <th>{{ __('locale.Customers') }}</th>
                                            <th>{{ __('locale.Products') }}</th>
                                            <th>{{ __('locale.completion') }}</th>
                                            <th>{{ __('locale.Price') }}</th>
                                            <th>{{ __('locale.Data') }}</th>
                                            <th>{{ __('locale.Express') }}</th>
                                            <th>{{ __('locale.Status') }}</th>
                                            <th class="bg-danger text-light">{{ __('locale.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $moreimgs = 0;
                                        ?>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="checkboxdisplay"><input name="selector[]" id="checkboxdisplay"
                                                        class="checkbox" type="checkbox" value="{{ $order->id }}" />
                                                </td>
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
                                                    // echo $order->id;
                                                    $i++;
                                                 ?>
                                                    <div class="hov">
                                                        <div class="dropdown" style="display:flex;flex-wrap:nowrap;">
                                                            <button id="orignalimg" class="dropdown-toggle"
                                                                style="background-color: transparent;border: none; margin-right:-10px"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                {{-- <img src="{!! asset('images/profiles/' . $drop1->profile_picture) !!}" id="table_image" alt="user-image"
                                                                    class="rounded-circle image" width="30px" height="30px;"
                                                                    > --}}
                                                                <?php
                                                                    if($i < 4 && $drop == $order->id)
                                                                    {
                                                                    ?>
                                                                <div class="rounded-circle image default-avatar member-overlap-item"
                                                                    style="background: url('{{ asset('images/profiles/' . $drop1->profile_picture) }}') 0 0 no-repeat; background-size: cover;">
                                                                </div>
                                                                <?php
                                                                    }
                                                                    if($i > 3 && $drop == $order->id)
                                                                    {
                                                                        $moreimgs++;
                                                                    ?>
                                                                <div class="rounded-circle image default-avatar member-overlap-item"
                                                                    style="background-color:#9192a1;color:rgb(255, 255, 255)">
                                                                    <span
                                                                        style="font-weight: bold">+{{ $moreimgs }}</span>
                                                                </div>
                                                                <?php
                                                                    }
                                                                    ?>

                                                            </button>
                                                            <?php

                                                unset($dropdown->$key);
                                                 }

                                                }
                                                // echo $i;

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
                                                                        <img src="{!! asset('images/profiles/user.png') !!}" id="dropdown1"
                                                                            alt="user-image" class="rounded-circle image"
                                                                            width="30px" height="30px;">
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
                                                                                                alt="avatar"
                                                                                                width="32"
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
                                                                                            <div class="avatar-content"><i
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
                                                                                        <div class="avatar"><img
                                                                                                src="{{ url('images/profiles/' . $employe->profile_picture) }}"
                                                                                                alt="avatar"
                                                                                                width="32"
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
                                                                                            <div class="avatar-content"><i
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
                                                <td> <p>{{ $order->name}}</p></td>
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
                                                        <div class="alert alert-danger text-center" role="alert"
                                                            style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                            {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                                        </div>
                                                    @elseif($order->order_status == 2)
                                                        <div class="alert alert-info text-center" role="alert"
                                                            style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                            {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                                        </div>
                                                    @elseif($order->order_status == 3)
                                                        <div class="alert alert-warning text-center" role="alert"
                                                            style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                            {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                                        </div>
                                                    @elseif($order->order_status == 4)
                                                        <div class="alert alert-success text-center" role="alert"
                                                            style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                                            {{ \Carbon\Carbon::parse($order->completion_date)->format('l, d, F Y') }}
                                                        </div>
                                                    @elseif($order->order_status == -1)
                                                        <div class="alert alert-primary text-center" role="alert"
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
                                                <td>
                                                    @if ($order->order_status == 0)
                                                        <div class="dropdown">
                                                            <div>
                                                                <a class="dropbtn"><img src="{!! asset('images/status/simpel.png') !!}"
                                                                        alt="user-image" class="rounded-circle image"
                                                                        width="30px" height="30px;"
                                                                        style="display: flex;">
                                                                </a>
                                                            </div>
                                                            <div class="dropdown-content">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Todo"
                                                                            onclick="todo({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px; "><img
                                                                                src="{!! asset('images/status/simpel.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Running"
                                                                            onclick="running({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/running.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Check"
                                                                            onclick="check({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/check.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Finished"
                                                                            onclick="finished({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/todo.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Activated"
                                                                            onclick="activated({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/active.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Canceled"
                                                                            onclick="calcelled({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/cancled.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($order->order_status == 2)
                                                        <div class="dropdown">
                                                            <div>
                                                                <a class="dropbtn"><img src="{!! asset('images/status/running.png') !!}"
                                                                        alt="user-image" class="rounded-circle image"
                                                                        width="30px" height="30px;"
                                                                        style="display: flex;">
                                                                </a>
                                                            </div>
                                                            <div class="dropdown-content">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Todo"
                                                                            onclick="todo({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px; "><img
                                                                                src="{!! asset('images/status/simpel.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Running"
                                                                            onclick="running({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/running.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Check"
                                                                            onclick="check({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/check.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Finished"
                                                                            onclick="finished({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/todo.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Activated"
                                                                            onclick="activated({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/active.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Canceled"
                                                                            onclick="calcelled({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/cancled.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($order->order_status == 3)
                                                        <div class="dropdown">
                                                            <div>
                                                                <a class="dropbtn"><img src="{!! asset('images/status/check.png') !!}"
                                                                        alt="user-image" class="rounded-circle image"
                                                                        width="30px" height="30px;"
                                                                        style="display: flex;">
                                                                </a>
                                                            </div>
                                                            <div class="dropdown-content">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <a type="button" title="title to show"
                                                                            onclick="todo({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px; "><img
                                                                                src="{!! asset('images/status/simpel.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button"
                                                                            onclick="running({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/running.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button"
                                                                            onclick="check({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/check.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button"
                                                                            onclick="finished({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/todo.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button"
                                                                            onclick="activated({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/active.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button"
                                                                            onclick="calcelled({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/cancled.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($order->order_status == 4)
                                                        <div class="dropdown">
                                                            <div>
                                                                <a class="dropbtn"><img src="{!! asset('images/status/todo.png') !!}"
                                                                        alt="user-image" class="rounded-circle image"
                                                                        width="30px" height="30px;"
                                                                        style="display: flex;">
                                                                </a>
                                                            </div>
                                                            <div class="dropdown-content">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Todo"
                                                                            onclick="todo({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px; "><img
                                                                                src="{!! asset('images/status/simpel.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Running"
                                                                            onclick="running({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/running.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Check"
                                                                            onclick="check({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/check.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Finished"
                                                                            onclick="finished({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/todo.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Activated"
                                                                            onclick="activated({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/active.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Canceled"
                                                                            onclick="calcelled({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/cancled.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($order->order_status == -1)
                                                        <div class="dropdown">
                                                            <div>
                                                                <a class="dropbtn"><img src="{!! asset('images/status/active.png') !!}"
                                                                        alt="user-image" class="rounded-circle image"
                                                                        width="30px" height="30px;"
                                                                        style="display: flex;">
                                                                </a>
                                                            </div>
                                                            <div class="dropdown-content">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Todo"
                                                                            onclick="todo({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px; "><img
                                                                                src="{!! asset('images/status/simpel.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Running"
                                                                            onclick="running({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/running.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Check"
                                                                            onclick="check({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/check.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Finished"
                                                                            onclick="finished({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/todo.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Activated"
                                                                            onclick="activated({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/active.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Canceled"
                                                                            onclick="calcelled({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/cancled.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($order->order_status == 1)
                                                        <div class="dropdown">
                                                            <div>
                                                                <a class="dropbtn"><img src="{!! asset('images/status/cancled.png') !!}"
                                                                        alt="user-image" class="rounded-circle image"
                                                                        width="30px" height="30px;"
                                                                        style="display: flex;">
                                                                </a>
                                                            </div>
                                                            <div class="dropdown-content">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Todo"
                                                                            onclick="todo({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px; "><img
                                                                                src="{!! asset('images/status/simpel.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Running"
                                                                            onclick="running({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/running.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Check"
                                                                            onclick="check({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/check.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Finished"
                                                                            onclick="finished({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/todo.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Activated"
                                                                            onclick="activated({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/active.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a type="button" data-toggle="tooltip"
                                                                            data-placement="top" title="Canceled"
                                                                            onclick="calcelled({{ $order->id }}, this)"
                                                                            data-id="{{ $order->id }}"
                                                                            style="border-radius: 15px 15px 15px 15px;"><img
                                                                                src="{!! asset('images/status/cancled.png') !!}"
                                                                                alt="user-image"
                                                                                class="rounded-circle image"
                                                                                width="30px" height="30px;"
                                                                                style="display: flex;"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                </td>
                                                <td>
                                                    <a href="{{ url('invoicepdf/' . $order->id) }}" class=""><i
                                                            class='text-dark' data-feather='file-text'
                                                            style="height: 1.2rem;
                                                        width: 1.2rem;"></i></a>

                                                    <a href="{{ url('editorder/' . $order->id) }}" class=""><i
                                                            class='text-dark' data-feather='edit'
                                                            style="height: 1.2rem;
                                                        width: 1.2rem;"></i></a>

                                                    <a href="{{ url('deleteorder/' . $order->id) }}"
                                                        class="delete-confirm "><i class="text-danger"
                                                            data-feather='trash-2'
                                                            style="height: 1.2rem;
                                                        width: 1.2rem;"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal to add new record -->
        </section>
        <!--/ Basic table -->
        <!--/ Row grouping -->
    @endsection


    @section('vendor-script')
        {{-- vendor files --}}
        <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    @endsection
    @section('page-script')
        {{-- Page js files --}}
        <script src="{{ asset(mix('js/scripts/tables/table-datatables-basic.js')) }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    @endsection

    <script>
        function down(id, order, elem, e) {
            $.ajax({
                type: 'GET',
                url: 'dropupdate/' + id + '/' + order,
                success: function(data) {

                    $("#mytable").load("list_order #mytable");
                }
            });

        }


        function unassing(id, order) {
            $.ajax({
                type: 'GET',
                url: 'unassingemploy/' + id + '/' + order,
                success: function(data) {
                    console.log(data);
                    $("#mytable").load("list_order #mytable");

                }
            });
        }

        function todo(order, elem) {

            $.ajax({
                type: 'GET',
                url: 'todo/' + order,
                success: function(data) {
                    var data = JSON.parse(data);
                    console.log(data);
                    $("#mytable").load("list_order #mytable");

                }
            });

        }


        function check(order, elem) {

            $.ajax({
                type: 'GET',
                url: 'check/' + order,
                success: function(data) {
                    var data = JSON.parse(data);
                    //   console.log(data);
                    $("#mytable").load("list_order #mytable");

                }
            });

        }

        function finished(order, elem) {
            $.ajax({
                type: 'GET',
                url: 'finished/' + order,
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#mytable").load("list_order #mytable");

                }
            });

        }

        function activated(order, elem) {
            $.ajax({
                type: 'GET',
                url: 'activated/' + order,
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#mytable").load("list_order #mytable");

                }
            });

        }

        function calcelled(order, elem) {
            $.ajax({
                type: 'GET',
                url: 'cancelled/' + order,
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#mytable").load("list_order #mytable");

                }
            });

        }

        function running(order, elem) {
            $.ajax({
                type: 'GET',
                url: 'running/' + order,
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#mytable").load("list_order #mytable");

                }
            });

        }

        function checkboxs() {

            if ($("#allSelector").is(':checked')) {
                $('input:checkbox').each(function() {
                    $(this).attr("checked", status);
                });
                $('#allSelector').css('display', 'block');
                var $boxes = $('input[id=checkboxdisplay]:checked');
                $('.checkbox').css('display', 'block');
                $('#notificationBarBottom').removeClass('hideMe');
                $('.totalselected').text($boxes.length);
            }
            if (!$("#allSelector").is(':checked')) {
                $('input:checkbox').each(function() {
                    $(this).removeAttr("checked", status);
                });
                var $boxes = $('input[id=checkboxdisplay]:checked');
                $('#notificationBarBottom').addClass('hideMe');
                $('.totalselected').text($boxes.length);
                $('.checkbox').css('display', 'none');
                $('td.checkboxdisplay').hover(
                    function() {
                        $('.checkbox').css('display', 'block');
                    },
                    function() {
                        $('.checkbox').css('display', 'none');
                    }
                );
            }


        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.multiSelector').click(function(e) {
                $('#order').val($('.checkbox:checked').map(function() {
                    return this.value;
                }).get().join(','));
                if ($('#order').val() == '') {
                    alert('No row selected!');
                    return false;
                }

            });
            // $("#allSelector").click(function() {
            //     $('input:checkbox').not(this).prop('checked', this.checked);
            // });
        });
        $(document).on('click', '#hideorderbutton', function(e) {
            e.preventDefault();
            $('#notificationBarBottom').addClass('hideMe');
            $('.checkbox').css('display', 'none');
            $('td.checkboxdisplay').hover(
                function() {
                    $('.checkbox').css('display', 'block');
                },
                function() {
                    $('.checkbox').css('display', 'none');
                }
            );

            $('#allSelector').css('display', 'none');
            $('th.allcheckboxex').hover(
                function() {
                    $('#allSelector').css('display', 'block');
                },
                function() {
                    $('#allSelector').css('display', 'none');
                }
            );
            $('.totalselected').text(0);
            $('input:checkbox').each(function() {
                $(this).removeAttr("checked", status);
            });
            $("#allSelector").prop("checked", false);
            // $("#allSelector").removeAttr("checked", status);
        })
        $(document).on('click', '.checkbox', function() {

            var $boxes = $('input[id=checkboxdisplay]:checked');
            if (this.checked) {

                $('.checkbox').css('display', 'block');
                $('#notificationBarBottom').removeClass('hideMe');
                $('.totalselected').text($boxes.length);
                $('td.checkboxdisplay').hover(
                        function() {
                            $('.checkbox').css('display', 'block');
                        },
                        function() {
                            $('.checkbox').css('display', 'block');
                        }
                    );

            } else {
                if ($boxes.length == 0) {
                    $('.checkbox').css('display', 'none');
                    $('td.checkboxdisplay').hover(
                        function() {
                            $('.checkbox').css('display', 'block');
                        },
                        function() {
                            $('.checkbox').css('display', 'none');
                        }
                    );
                    $('#notificationBarBottom').addClass('hideMe');
                    $('.totalselected').text($boxes.length);
                } else {
                    alert('here');
                    $('.checkbox').css('display', 'block');
                    $('#notificationBarBottom').removeClass('hideMe');
                    $('.totalselected').text($boxes.length);
                }
            }
        });
    </script>
