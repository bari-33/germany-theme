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

        /* .dropdown-content a:hover {background-color: #ddd;} */

        .dropdown:hover .dropdown-content {
            display: block;
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
                    <h4 class="ml-2 mt-1"><i class="fa fa-filter" aria-hidden="true"></i>{{ __('locale.Filters') }}
                    </h4>
                    <div class="col-md-12">
                        <a href="{{ 'add_order' }}" type="button" class="float-right btn btn-success"><i
                                class="fa fa-plus" aria-hidden="true"></i>{{ __('locale.Add New Order') }}</a>
                        <div class="mt-5">
                            <br><br>
                            <center>
                                <form action="{{ url('searchorder') }}" method="POST">
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

                                    <form method="post" action="{{ url('searchorder') }}">
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


                                    <form method="post" action="{{ url('searchorder') }}">
                                        @csrf
                                        @php $date = date('Y-m-d',strtotime('-90 days')); @endphp
                                        <input type="hidden" name="action" value="custom_date">
                                        <input type="hidden" id="date_from" required name="date_from" class="form-control"
                                            placeholder="Van" style="margin-bottom: 10px" value="{{ $date }}">

                                        <input type="hidden" id="date_to" required name="date_to" class="form-control"
                                            style="margin-bottom: 10px" placeholder="Bis" value="{{ date('Y-m-d') }}">

                                        <button type="submit"
                                            style="background-color: transparent;color: black;text-align: left;"
                                            class="btn btn-block"> {{ __('locale.Last 90 Days') }}</button>
                                    </form>



                                    <form method="post" action="{{ url('searchorder') }}">
                                        @csrf
                                        @php $year = date('Y')-2; @endphp
                                        <input type="hidden" name="action" value="custom_date">
                                        <input type="hidden" id="date_from" required name="date_from" class="form-control"
                                            placeholder="Van" style="margin-bottom: 10px"
                                            value="{{ $year }}-01-01">

                                        <input type="hidden" id="date_to" required name="date_to" class="form-control"
                                            style="margin-bottom: 10px" placeholder="Bis"
                                            value="{{ $year }}-12-31">

                                        <button type="submit"
                                            style="background-color: transparent;color: black;text-align: left;"
                                            class="btn btn-block">{{ date('Y') - 2 }}</button>
                                    </form>

                                    <form method="post" action="{{ url('searchorder') }}">
                                        @csrf
                                        @php $year = date('Y')-1; @endphp
                                        <input type="hidden" name="action" value="custom_date">
                                        <input type="hidden" id="date_from" required name="date_from" class="form-control"
                                            placeholder="Van" style="margin-bottom: 10px"
                                            value="{{ $year }}-01-01">

                                        <input type="hidden" id="date_to" required name="date_to" class="form-control"
                                            style="margin-bottom: 10px" placeholder="Bis"
                                            value="{{ $year }}-12-31">

                                        <button type="submit"
                                            style="background-color: transparent;color: black;text-align: left;"
                                            class="btn btn-block">{{ date('Y') - 1 }}</button>
                                    </form>

                                    <hr>

                                    <form method="post" action="{{ url('searchorder') }}">
                                        @csrf
                                        <input type="hidden" name="action" value="custom_date">
                                        <input type="date" id="date_from" required name="date_from" class="form-control"
                                            placeholder="Van" style="margin-bottom: 10px">

                                        <input type="date" id="date_to" required name="date_to" class="form-control"
                                            style="margin-bottom: 10px" placeholder="Bis">

                                        <button type="submit" style="background-color: silver"
                                            class="btn btn-block">{{ __('locale.Send') }}</button>
                                    </form>

                                </div>

                        </div>
                        </center>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
        </div>
        <!-- Basic table -->
        <div class="card">
            <div class="px-3 pt-3 pb-3">
                <div class="table-wrapper">
                    <table class="datatables table mb-0" style="color: #000;">
                            <thead>
                                <tr>
                                    <th class="ml-5"><input class="form-check-input" id="checkAll"
                                        type="checkbox">
                                    <label class="form-check-label" for="checkbox" class=" label-table"></label>
                                </th>
                                    <th>{{ __('locale.ID') }}</th>
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
                                        <td> <input class="form-check-input" type="checkbox" id="checkbox1">
                                            <label class="form-check-label" for="checkbox1"
                                                class="label-table"></label>
                                        </td>
                                        <td><a href="" class="text-body font-weight-bold">{{ $order->id }}</a></td>
                                        <td>
                                            @foreach ($ClientDetail as $client)
                                            @foreach ($users as $user)


                                            <?php
                                            // echo '<pre>'; print_r($client); echo '</pre>'; die;
                                            // if ($client->user_id == $o->id) {
                                                echo $client->first_name." ".$client->last_name;

                                            // }
                                            ?>
                                            @endforeach
                                      @endforeach
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