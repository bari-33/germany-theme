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
    <h1>{{ __('locale.Orders') }}</h1>
    <section id="basic-datatable">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="modal fade" id="trialDocumentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Downloaden Trial Version</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <table class="table">
                                        <tbody id="trialcontent">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                                    <div style="margin-left: 40%">
                                        <button type="button" class="btn btn-success" data-dismiss="modal"  style="border-radius: 20px;">OK</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="finishedDocumentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Downloaden Finsihed Version</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <table class="table">
                                        <tbody id="finishedcontent">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                                    <div style="margin-left: 40%">
                                        <button type="button" class="btn btn-success" data-dismiss="modal"  style="border-radius: 20px;">OK</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
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
                                        <th>{{ __('locale.Status') }}</th>
                                        <th>{{ __('locale.completion') }}</th>
                                        <th>{{ __('locale.Products') }}</th>
                                        <th>{{ __('locale.Price') }}</th>
                                        <th>{{ __('locale.Paid') }}</th>
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
                                    <td><a href="" class="text-body font-weight-bold">{{$loop->iteration}}</a> </td>
                                    <td>
                                        @if($order->order_status==0)
                                        <div class="alert alert-secondary" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">On-Hold
                                        </div>
                                            @endif
                                            @if($order->order_status==2)
                                                <div class="alert alert-info" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">In Running
                                                </div>
                                            @endif
                                            @if($order->order_status==3)
                                                <div class="alert alert-warning" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">In check
                                                </div>
                                            @endif
                                            @if($order->order_status==4)
                                                <div class="alert alert-success" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">Completed
                                                </div>
                                            @endif
                                            @if($order->order_status==-1)
                                                <div class="alert alert-primary" role="alert" style="border-radius: 20px;padding-top: 5%;padding-bottom: 5%">Activated
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
                                    <td>

                                        <a target="_blank" href="{{url('invoices/'.$order->id)}}"><button type="button" class="btn btn-sm btn-light" id="invoiceDownload" data-id="{{$order->id}}"><i class="fa fa-file-text text-primary mr-1" aria-hidden="true"
                                            style="font-size: 1.5em;"></i></button></a>
                                        @if ($order->order_status==-1)


                                        <button type="button" data-toggle="modal" data-target="#trialDocumentsModal" id="trialDocuments" data-id="{{$order->id}}" class="btn btn-sm btn-light" @if($order->trialdocuments()->count()==0) disabled @endif><i class="fa fa-upload"></i></button>
                                        <button type="button" data-toggle="modal" data-target="#finishedDocumentsModal" id="finishedDocuments" data-id="{{$order->id}}" class="btn btn-sm btn-primary" @if($order->finisheddocuments()->count()==0 || $order->payment_status==0) disabled @endif><i class="fa fa-upload"></i></button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $('#trialDocuments').on('click',function () {
            id=$(this).attr('data-id');
            $.ajax({
                type : 'get',
                url  : 'getTrialDocuments/'+id,
                success: function(res){
                    var APP_URL =  '{{ env("APP_URL") }}';
                    console.log(APP_URL);
                    var tsr='';
                    for(i=0;i<res.length;i++) {
                      tsr+= '<tr>'+
                            '<td><a href="'+APP_URL+'public/files/trialdocuments/'+res[i].name+'" download="'+res[i].name+'">'+res[i].name+'</a></td>'
                            +'</tr>';
                    }
                   console.log(tsr);
                    $('#trialcontent').html(tsr);


                },
                error: function(res){
                    console.log('Failed');
                    console.log(res);
                }
            });
        });

        $('#finishedDocuments').on('click',function () {
            id=$(this).attr('data-id');

            $.ajax({
                type : 'get',
                url  : 'getFinishedDocuments/'+id,
                success: function(res){
                    var tsr='';
                    for(i=0;i<res.length;i++) {

                        tsr+= '<tr>'+
                            '<td><a href="'+APP_URL+'public/files/finisheddocuments/'+res[i].name+'" download="'+res[i].name+'">'+res[i].name+'</a></td>'
                            // '<td><a href='+'"'+window.location.origin+'/bewwebung3/public/files/finished documents/'+res[i].name+'" download="'+res[i].name+'">'+res[i].name+'</a></td>'
                            +'</tr>';

                    }


                    $('#finishedcontent').html(tsr);

                },
                error: function(res){
                    console.log('Failed');
                    console.log(res);
                }
            });
        });
    });

</script>
