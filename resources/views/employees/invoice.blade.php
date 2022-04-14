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



@endsection

@section('content')
    <!-- Basic table -->
    <h1>{{ __('locale.Bills') }}</h1>
    <section id="basic-datatable">


        <div class="row">
            <div class="col-md-12">

                <div class="card ">

                    <div class="px-4 pt-4 pb-4">

                        <div class="table-wrapper">
                            <div class="card" style="overflow-x:auto;">
                            <table class="datatables table mb-0" style="color: #000;">
                                <thead>
                                    <tr>
                                        <th class="ml-5"><input class="form-check-input" id="checkAll"
                                                type="checkbox">
                                            <label class="form-check-label" for="checkbox" class=" label-table"></label>
                                        </th>
                                        <th>{{ __('locale.ID') }}</th>
                                        <th>{{ __('locale.Employee') }}</th>
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
                                    @foreach($orders as $order)
                                    <?php
                                    $data = explode(',', $order->user_id);
                                     foreach ($data as $key => $value) {
                                    ?>
                                    @if ($value==$user->id)
                                    <tr>
                                       <td> <input class="form-check-input" type="checkbox" id="checkbox1">
                                            <label class="form-check-label" for="checkbox1" class="label-table"></label>
                                        </td>
                                        <td><a href="{{ url('editorder/'.$order->id) }}" class="text-body font-weight-bold">{{ $order->id }}</a></td>
                                        <td>
                                            <div>

                                                <img src="{!! asset('images/profiles/user.png') !!}" id="dropdown1" alt="user-image"
                                                class="rounded-circle image" width="30px" height="30px;">


                                            </div>
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
                                        <td>
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
                                                @if($order->express=='0,00')<span class="badge badge-secondary">
                                                @else<span class="badge badge-success">@endif
                                                        24h</span>

                                            </p>
                                        </td>
                                        <td>

                                            <a href="{{ url('invoicepdf/'.$order->id) }}"
                                                class=""><i
                                                    class="fa fa-file-text text-primary mr-1" aria-hidden="true"
                                                    style="font-size: 1.5em;"></i></a>

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
            </div>
        </div>
    </section>
    <!--/ Basic table -->
    <!-- Complex Headers -->
    <!--/ Multilingual -->
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endsection
