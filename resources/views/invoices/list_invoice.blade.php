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
        .checkbox{
            display: none;
        }
         td.checkboxdisplay:hover input{
            display: block;
        }
        #allSelector{
            display: none;
        }
        th.allcheckboxex:hover #allSelector{
            display:block;
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
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

            /* notify */

    #notificationBarBottom {
    position: fixed;
    z-index: 101;
    bottom: 10;
    left: 30%;
    right:10% ;
    transform: translateY(calc(100% + 10px));
    background: #dbe7db;
    color: #000000;
    text-align: center;
    line-height: 2.5;
    box-shadow: 0 0 5px black;
}
@keyframes slideUp {
    0% { transform: translateY(100% + 10px); }
    100% { transform: translateY(0); }
}
#notificationBarBottom {
    animation: slideUp 1s ease forwards;
}
#close {
  display: none;
}

/* added to show how to hide with a click */
@keyframes slideDown {
    0% { transform: translateY(0); }
    100% { transform: translateY(100% + 10px); }
}
#notificationBarBottom.hideMe {
    animation: slideDown 2.5s ease forwards;
}

        /* .dropdown-content a:hover {background-color: #ddd;} */

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .icon {
            width: 34px;
            height: 24px;
            /* stroke: currentColor;
          stroke-width: 2; */

        }

        /* .dropdown:hover .dropbtn {background-color: #3e8e41;} */
    </style>
@endsection

@section('content')
@section('content')
    <!-- Basic table -->
    <h1>{{ __('locale.List Bills') }}</h1>
    <section id="basic-datatable">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <div class="row">
                                    <div class="col-md-9" style="margin-top: 10px">
                                        <form action="{{ url('searchinvoice') }}" method="POST">
                                            @csrf
                                            <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                                name="action" value="all" class="btn btn-primary">{{ __('locale.All') }} |
                                                {{ session('all') }} </button>
                                            <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                                name="action" value="progress"
                                                class="btn btn-primary">{{ __('locale.In Progress') }} |
                                                {{ session('progress') }} </button>
                                            <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                                name="action" value="waiting" class="btn btn-primary">{{ __('locale.On hold') }}
                                                |
                                                {{ session('waiting') }} </button>
                                            <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                                name="action" value="completed" class="btn btn-primary">{{ __('locale.Done') }}
                                                |
                                                {{ session('completed') }} </button>
                                            <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                                name="action" value="cancelled"
                                                class="btn btn-primary">{{ __('locale.Canceled') }}
                                                |
                                                {{ session('cancelled') }} </button>
                                            <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                                name="action" value="deleted" class="btn btn-primary">{{ __('locale.Deleted') }}
                                                |
                                                {{ session('deleted') }} </button>
                                            <div class="dropdown"
                                                style="display: inline;background-color: #3b3f77;border-radius: 25px;border-color: white;">
                                                <button style="background-color: #3b3f77;border-color: white;" type="button"
                                                    class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    {{ __('locale.Last 30 Days') }}
                                                </button>
                                        </form>
                                        <div class="dropdown-menu">
                                            <form method="post" action="{{ url('searchinvoice') }}">
                                                @csrf
                                                @php $date = date('Y-m-d',strtotime('-30 days')); @endphp
                                                <input type="hidden" name="action" value="custom_date">
                                                <input type="hidden" id="date_from" required name="date_from" class="form-control"
                                                    placeholder="Van" style="margin-bottom: 10px" value="{{ $date }}">

                                                <input type="hidden" id="date_to" required name="date_to" class="form-control"
                                                    style="margin-bottom: 10px" placeholder="Bis" value="{{ date('Y-m-d') }}">

                                                <button type="submit"
                                                    style="background-color: transparent;color: black;text-align: left;"
                                                    class="btn btn-block"> {{ __('locale.Last 30 Days') }}</button>
                                            </form>
                                            <form method="post" action="{{ url('searchinvoice') }}">
                                                @csrf
                                                @php $date = date('Y-m-d',strtotime('-90 days')); @endphp
                                                <input type="hidden" name="action" value="custom_date">
                                                <input type="hidden" id="date_from" required name="date_from" class="form-control"
                                                    placeholder="Van" style="margin-bottom: 10px" value="{{ $date }}">

                                                <input type="hidden" id="date_to" required name="date_to"
                                                    class="form-control" style="margin-bottom: 10px" placeholder="Bis"
                                                    value="{{ date('Y-m-d') }}">

                                                <button type="submit"
                                                    style="background-color: transparent;color: black;text-align: left;"
                                                    class="btn btn-block"> {{ __('locale.Last 90 Days') }}</button>
                                            </form>
                                            <form method="post" action="{{ url('searchinvoice') }}">
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

                                            <form method="post" action="{{ url('searchinvoice') }}">
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
                                            <form method="post" action="{{ url('searchinvoice') }}">
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
                                        <a href="{{ 'add_order' }}" type="button" class="float-right btn btn-success mr-2 mt-1"><i
                                            class="fa fa-plus" aria-hidden="true"></i>{{ __('locale.Add New Order') }}</a>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Basic table -->
        <div class="card">
            <input type="hidden" id="order" name="check">
            <form action="{{ url('allinvoice') }}" method="POST">
                @csrf
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
                                        <button class="dropdown-toggle btn btn-dark" type="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">Order Buttons
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                            <button class="col-md-12 multiSelector"
                                                style="border: none;background-color: rgb(255, 255, 255);"
                                                type="submit">Delete</button><br>
                                            <button class="col-md-12 multiSelector" style="border: none;background-color: #fff;"
                                                type="submit">Download all</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-top: 7.5px">
                                 <button class="btn btn-sm btn-danger" id="hideorderbutton"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 pt-3 pb-3">
                <div class="table-wrapper">
                    <table class="table-responsive datatables table mb-0" style="color: #000;">
                        <thead>
                            <tr>
                                <th class="ml-5 allcheckboxex">
                                    <input class="form-check-input" id="allSelector" type="checkbox" onclick="checkboxs()">
                                    {{-- <label class="form-check-label" for="checkbox" class=" label-table"></label> --}}
                                </th>
                                <th>{{ __('locale.ID') }}</th>
                                <th><i data-feather="trending-up"></i></th>
                                <th>{{ __('locale.Name') }}</th>
                                <th>{{ __('locale.Order Status') }}</th>
                                <th>{{ __('locale.Date') }}</th>
                                <th>{{ __('locale.Products') }}</th>
                                <th>{{ __('locale.Price') }}</th>
                                <th class="bg-danger text-light">{{ __('locale.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="checkboxdisplay">
                                         <input name="selector[]" id="checkboxdisplay" class=" checkbox form-check-input" type="checkbox" value="{{ $order->id }}">
                                        <label class="form-check-label" for="checkbox1" class="label-table"></label>
                                    </td>
                                    <td><a href="{{ url('invoices/' . $order->id) }}" class="text-body font-weight-bold">#{{ $order->id }}</a>
                                    </td>
                                    <?php
                                    if($order->payment_status == 1)
                                    {
                                        $divclass = "bg-light-success";
                                        $iconclass = "fa fa-check";
                                    }
                                    elseif ($order->payment_status == 0) {
                                        $divclass = "bg-light-warning";
                                        $iconclass = "fas fa-save";
                                    }
                                    elseif ($order->payment_status == -1) {
                                        $divclass = "bg-light-danger";
                                        $iconclass = "fa fa-pie-chart";
                                    }
                                    ?>
                                    <td>
                                        <div class="avatar <?php echo $divclass?>">
                                            <div class="avatar-content"><i class="<?php echo $iconclass?>"></i></div>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach ($ClientDetail as $client)
                                            <?php
                                            if ($client->order_id == $order->id) {
                                            ?>
                                            <div class="d-flex justify-content-left align-items-center">
                                                <div class="avatar-wrapper">
                                                    <div class="avatar  me-1"><img
                                                            src="{{ asset('images/profiles/' . $client->profile_picture) }}"
                                                            alt="Avatar" height="32" width="32"></div>
                                                </div>
                                                <div class="d-flex flex-column"><a href="app-user-view-account.html"
                                                        class="user_name text-truncate text-body"><span class="fw-bolder">
                                                            {{ $client->first_name }}</span></a><small
                                                        class="emp_post text-muted">{{ $client->email }}</small></div>
                                            </div>

                                            <?php
                                            }
                                            ?>
                                        @endforeach
                                    </td>

                                    <td>
                                        @if ($order->order_status == 0)
                                            <div class="text-center">
                                                <i class=' icon text-secondary' data-feather='circle'></i>
                                            </div>
                                        @elseif($order->order_status == 2)
                                            <div class="text-center">
                                                <i class=' icon text-info' data-feather='arrow-right-circle'></i>
                                            </div>
                                        @elseif($order->order_status == 3)
                                            <div class="text-center">
                                                <i class=' icon text-warning' data-feather='rotate-ccw'></i>
                                            </div>
                                        @elseif($order->order_status == 4)
                                            <div class="text-center">
                                                <i class=' icon text-success' data-feather='stop-circle'></i>
                                            </div>
                                        @elseif($order->order_status == -1)
                                            <div class="text-center">
                                                <i class='icon text-primary' data-feather='check-circle'></i>
                                            </div>
                                        @elseif($order->order_status == 1)
                                            <div class="text-center">
                                                <i class='icon text-danger' data-feather='alert-circle'></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="alert alert-danger text-center" role="alert"
                                            style="border-radius: 20px;padding-top: 2%;padding-bottom: 2%">
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('l, d, F Y') }}
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
                                    <td>
                                        @if ($order->payment_status == 1)
                                            <span class="badge bg-light-success"> {{ $order->total_price }} €</span>
                                        @endif
                                        @if ($order->payment_status == 0)
                                            <span> {{ $order->total_price }} €</span>
                                        @endif
                                        @if ($order->payment_status == -1)
                                            <span class="badge bg-light-danger"> {{ $order->total_price }} €</span>
                                        @endif
                                    </td>


                                    <td style="display:flex;align-items:center; margin-top:24px ">
                                        <a href="{{ url('invoices/' . $order->id) }}" class=""><i
                                                class='text-dark' data-feather='send'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ url('invoices/' . $order->id) }}" class=""><i
                                                class='text-dark' data-feather='eye'></i></a>
                                        <div class="dropdown">
                                            <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather='more-vertical'></i> </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href={{ url('invoicepdf/' . $order->id) }} class="dropdown-item">Download</a>
                                                <a href="javascript:void(0)" class="dropdown-item">Edit</a>
                                                <a href="javascript:void(0)" class="delete-confirm dropdown-item">Delete</a>
                                                <a href="javascript:void(0)" class="dropdown-item">Duplicate</a>

                                            </div>
                                        </div>
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
    {{-- <script src="{{ asset(mix('js/scripts/tables/table-datatables-basic.js')) }}"></script> --}}
    <script src="{{ asset('js/scripts/tables/table-datatables-basic.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

@endsection
<script>
     function checkboxs() {

if ($("#allSelector").is(':checked')) {
    $('input:checkbox').each(function() {
        $(this).attr("checked", status);
    });
    $('#allSelector').css('display','block');
    var $boxes = $('input[id=checkboxdisplay]:checked');
    $('.checkbox').css('display','block');
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
    $('.checkbox').css('display','none');
    $('td.checkboxdisplay').hover(
        function(){
            $('.checkbox').css('display','block');
        },
        function(){
            $('.checkbox').css('display','none');
        }
    );
}


}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.multiSelector').click(function(e) {

                $('#order').val($('.checkbox:checked').map(function() {
                    return this.value;
                }).get().join(','));
                if ($('#order').val() == '') {
                    alert('No row selected!');
                    return false;
                }
            });
    });
     $(document).on('click','#hideorderbutton',function(e){
            e.preventDefault();
            $('#notificationBarBottom').addClass('hideMe');
            $('.checkbox').css('display','none');
                $('td.checkboxdisplay').hover(
                    function(){
                        $('.checkbox').css('display','block');
                    },
                    function(){
                        $('.checkbox').css('display','none');
                    }
                );

                $('#allSelector').css('display','none');
                $('th.allcheckboxex').hover(
                    function(){
                        $('#allSelector').css('display','block');
                    },
                    function(){
                        $('#allSelector').css('display','none');
                    }
                );
                $('.totalselected').text(0);
                $('input:checkbox').each(function() {
                    $(this).removeAttr("checked", status);
                });
                $("#allSelector").prop("checked", false);
                // $("#allSelector").removeAttr("checked", status);
        })
      $(document).on('click','.checkbox',function(){
            var $boxes = $('input[id=checkboxdisplay]:checked');
            if (this.checked) {
                $('.checkbox').css('display','block');
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

            }
            else{
                if($boxes.length == 0)
                {
                $('.checkbox').css('display','none');
                $('td.checkboxdisplay').hover(
                    function(){
                        $('.checkbox').css('display','block');
                    },
                    function(){
                        $('.checkbox').css('display','none');
                    }
                );
                $('#notificationBarBottom').addClass('hideMe');
                $('.totalselected').text($boxes.length);
                }
                else{
                $('.checkbox').css('display','block');
                $('#notificationBarBottom').removeClass('hideMe');
                $('.totalselected').text($boxes.length);
                }
            }
        });
</script>
