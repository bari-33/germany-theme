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
    .css {
        margin-left: 65%;
        display: none;
    }

</style>
@section('content')

    <!-- Validation -->
    <h1>{{ __('locale.Update Order') }}</h1>
    @if (session('alert'))
        <div class="demo-spacing-0">
            <div class="alert alert-success" role="alert">
                <div class="alert-body"><strong>{{ session('alert') }}</strong></div>
            </div>
        </div>
    @endif
    <section class="bs-validation">



    <!-- MODAL COMES HERE -->

    <div class="modal fade" id="trialDocumentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Upload Documents (Trial)</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                    <form method="post" action="{{url('trialdocuments/'.$order->id)}}" enctype="multipart/form-data"class="dropzone" id="trial">
                        @csrf

                        <div class="card">
                            <div class="card-content">
                               <input type="file" name="trialdocuments" class="dropify"  data-max-file-size="1M" />

                            </div>

                        </div>
                        <button class="float-right btn btn-primary" type="submit" >save</button>
                    </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                <th>Name</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach($order->trialdocuments as $document)
                                <tr>
                                    <td>{{$document->name}}</td>
                                    <td><button class="btn btn-light deleteTrialDocument" id="" data-id="{{$document->id}}">Delete</button></td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                    <div style="margin-left: 45%">
                        <button type="button" class="btn btn-primary" id="trialDocumentsSave" data-dismiss="modal" style="border-radius: 20px;">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="finishedDocumentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Upload Documents (Finished)</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{url('finisheddocuments/'.$order->id)}}" enctype="multipart/form-data"
                                  class="dropzone" id="finished">
                                @csrf

                                <div class="card">
                                    <div class="card-content">
                                       <input type="file" name="finisheddocuments" class="dropify"  data-max-file-size="1M" />

                                    </div>

                                </div>
                                <button class="float-right btn btn-primary" type="submit" >save</button>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                <th>Name</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach($order->finisheddocuments as $document)
                                    <tr>
                                        <td>{{$document->name}}</td>
                                        <td><button class="btn btn-light deleteFinishedDocument"  data-id="{{$document->id}}">Delete</button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                    <div style="margin-left: 45%">
                        <button type="button" class="btn btn-primary" id="finishedDocumentsSave" data-dismiss="modal" style="border-radius: 20px;">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- EMPLOYEE INSERTION AND DELETION MODAL  -->

    <div class="modal fade" id="EmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Assign Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Add</th>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                        <?php

                        $users = explode(",",$employee->order_id);
                        foreach ($users as $key => $value) {
                           if ($value!=$order->id) {
                           ?>
                        <tr>


                        <td>{{$employee->name}} <sub>{{$employee->userdetail->deutch_language}},{{$employee->userdetail->english_language}},{{$employee->userdetail->spanish_language}},{{$employee->userdetail->french_language}}</sub></td>
                            <td><button class="btn btn-light btn-sm addEmployee" data-id="{{$employee->id}}" data-name="{{$order->id}}">+</button></td>
                        </tr>
                        <?php
                           }
                        }
                        ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                    <div style="margin-left: 45%">
                        <button type="button" class="btn btn-primary" id="addEmployeeSave" data-dismiss="modal" style="border-radius: 20px;">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="RemoveEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Remove Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Add</th>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                        <?php

                        $users = explode(",",$employee->order_id);
                        foreach ($users as $key => $value) {
                           if ($value==$order->id) {
                           ?>
                            <tr>
                                <td>{{$employee->name}} <sub>{{$employee->userdetail->deutch_language}},{{$employee->userdetail->english_language}},{{$employee->userdetail->spanish_language}},{{$employee->userdetail->french_language}}</sub></td>
                                <td><button class="btn btn-light btn-sm removeEmployee" data-id="{{$employee->id}}" data-name="{{$order->id}}">-</button></td>
                            </tr>
                            <?php
                           }
                        }
                            ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between" style="background-color: #7e57c2b5;color: #FFF;">
                    <div style="margin-left: 45%">
                        <button type="button" class="btn btn-primary" id="removeEmployeeSave" data-dismiss="modal" style="border-radius: 20px;">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="card" style="border-left:1px solid black;">
                <div class="card-body">
                    <form name="form" action="{{url("updateorder/".$order->id)}}" method="POST" enctype="multipart/form-data">
                        {{-- @method('PATCH') --}}
                        @csrf

                        <div class="row pb-3" style="border-bottom: 1px solid lightgrey">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>{{ __('locale.order number') }}: </h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>{{$order->id}}</h5>
                                    </div>

                                    <div class="col-md-12">
                                        <p class="text-muted">Bezahlung über PayPal(3qwejx4444)<br>Paid on August 25, 2019 at 2:25 pm.</p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>{{ __('locale.Creation Date') }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>{{ __('locale.Status') }}</h5>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y')}}" readonly/>/
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($order->created_at)->format('H:i')}}" readonly/>

                                    </div>

                                    <div class="offset-md-1 col-md-5">
                                        <select name="order_status" id="order_status" class="form-control">
                                            <option value="3" @if($order->order_status==3) selected @endif>{{ __('locale.On hold') }}</option>
                                            <option value="4" @if($order->order_status==4) selected @endif>{{ __('locale.Done') }}</option>
                                            <option value="2" @if($order->order_status==2) selected @endif>{{ __('locale.In Progress') }}</option>
                                            <option value="-1" @if($order->order_status==-1) selected @endif>{{ __('locale.Outstanding payment') }}</option>
                                            <option value="1" @if($order->order_status==1) selected @endif>{{ __('locale.Canceled') }}</option>
                                            <option value="-2" @if($order->order_status==-2) selected @endif>{{ __('locale.Refunded') }}</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>{{ __('locale.Date of invoice') }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>{{ __('locale.Bills') }}</h5>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y')}}" readonly/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($order->created_at)->format('H:i')}}" readonly/>

                                    </div>

                                    <div class="offset-md-1 col-md-5">
                                        <a  type= "button" class="btn btn-primary" id="invoiceDownload">
                                            {{ __('locale.Bills') }} <i class="fe-download"></i>
                                        </a>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>{{ __('locale.production date') }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Express Service</h5>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($order->completion_date)->format('d.m.Y')}}" readonly/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($order->completion_date)->format('H:i')}}" readonly/>

                                    </div>

                                    <div class="offset-md-1 col-md-5">
                                        <input type="text" class="form-control" id="expressInput" value="Express 24 h" readonly/>
                                        <span  @if($order->express!='0,00')class="badge badge-success" @else class="badge badge-secondary" @endif id="expressBadge">24</span>

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>{{ __('locale.Billing address') }}</h4>
                                    </div>
                                </div>
                                <div class="row mt-3 ml-2">
                                    <div class="col-md-12">
                                        <address>
                                            {{$order->user->name}} <br>
                                            {{-- {{$order->user->userdetails->street_no}} {{$order->user->clientdetail->house_no}}, <br>
                                            {{$order->user->clientdetail->zip_code}} {{$order->user->clientdetail->city}} --}}
                                        </address>
                                        <p><b>E-Mail-Adresse:</b><br>{{$order->user->email}}</p>
                                        {{-- <p><b>Telefon:</b><br>{{$order->user->clientdetail->mobile}}</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('locale.Update') }}</button>
                            </div>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>



    <div class="row mt-2">
        <div class="col-12">
            <div class="card" style="border-top:1px solid black;border-left:1px solid black; ">
                <div class="card-body">

                    <div class="row pb-2" style="border-bottom: 1px solid lightgrey">
                        <div class="col-md-2">
                            <img src="{{url('images/products/'.$order->pdetail->product_image)}}" style="width:35%;" alt="" >

                        </div>
                        <div class="col-md-4" style="margin-left: -10%">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="h4" style="color: #00A6C7">{{$order->product}}</p>
                                </div>
                                <div class="col-md-12">
                                    <span class="badge badge-primary">{{$order->product_language}}</span>
                                    <span class="badge badge-info">Website</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <h5>Beschreibung</h5>
                        </div>
                        <div class="col-md-2">
                            <h5>Mitarbeiter</h5>
                        </div>
                        <div class="col-md-2">
                            <h5> Vorlage </h5>
                        </div>
                        <div class="col-md-2">
                            <h5>Website</h5>
                        </div>
                        <div class="col-md-4">
                            <h5>Upload</h5>
                        </div>
                    <div class="col-md-2">
                        {!!  $order->pdetail->product_description !!}
                    </div>
                        <div class="col-md-2">
                            <div>
                                @foreach($employees as $employee)
                                <?php

                                    $users = explode(",",$employee->order_id);
                                    foreach ($users as $key => $value) {
                                    if ($value==$order->id) {
                                    ?>
                                <img src="{{ url('images/profiles/'.$employee->profile_picture) }}" style="width:30%;" alt="user-image" class="rounded-circle">
                                     <?php
                                    }
                                }
                                     ?>
                                    @endforeach
                            </div>

                            <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#EmployeeModal">+</button>
                            <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#RemoveEmployeeModal">-</button>
                        </div>
                        <div class="col-md-2">
                            <img src="{{url('images/designs/primary/'.$order->design->primary_image)}}" style="width:100%;margin: 0" class="img-thumbnail" >
                        </div>
                        <div class="col-md-2">
                            <img src="{{url('images/websites/primary/'.$order->website->primary_image)}}" style="width:100%;margin: 0" class="img-thumbnail" >
                        </div>
                        <div class="col-md-2">
                            <ol style="height: 50%; overflow: auto">
                               @foreach($order->trialdocuments as $document)
                               <li><a {{--href="{{ url('public/files/trialdocuments/'.$document->name)}}"--}} target="_blank" download="{{ $document->name }}">{{ $document->name }}</a></li>
                              @endforeach
                            </ol>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#trialDocumentsModal">
                                    UPLOAD <i class="fe-upload"></i>
                                </button>
                        </div>
                        <div class="col-md-2">
                            <ol style="height: 50%;overflow: auto">
                                @foreach($order->finisheddocuments as $document)
                                    <li><a {{--href="{{ url('public/files/finisheddocuments/'.$document->name)}}"--}} target="_blank" download="{{ $document->name }}">{{ $document->name }}</a></li>
                                @endforeach
                            </ol>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#finishedDocumentsModal">
                                    UPLOAD <i class="fe-upload"></i>
                                </button>
                        </div>
                    </div>
            </div><!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>





    <div class="row mt-2">
        <div class="col-12">
            <div class="card" style="border-left:1px solid black; ">
                <div class="card-body">

                    <div class="row pb-2" style="border-bottom: 1px solid lightgrey">
                        <div class="col-md-12">
                            <h4>Preisübersicht</h4>
                        </div>
                    </div>

                <table class="table pb-2" style="border-bottom: 1px solid lightgrey">
                    <thead style="border-top:0px ">
                    <th>Position</th>
                    <th>Kosten</th>
                    <th>Anzahl</th>
                    <th>MwSt. DE</th>
                    <th>Gesamt</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Komplette Bewerbung</td>
                        <td>{{  $vat['product_price'] }} €</td>
                        <td>x1</td>
                        <td>{{  $vat['complete_application'] }} €</td>
                        <td>{{  $vat['product_price'] }} €</td>
                    </tr>
                    <tr>
                        <td>Bewerbungshomepage</td>
                        <td>{{  $vat['website_price'] }} €</td>
                        <td>x1</td>
                        <td>{{  $vat['application_homepage'] }} €</td>
                        <td>{{  $vat['website_price'] }} €</td>
                    </tr>
                    <tr>
                        <td>Design</td>
                        <td>{{  $vat['design_price'] }} €</td>
                        <td>x1</td>
                        <td>{{  $vat['design'] }} €</td>
                        <td>{{  $vat['design_price'] }} €</td>
                    </tr>
                    <tr>
                        <td>Express Bearbeitung</td>
                        <td>{{  $order->express }} €</td>
                        <td>x1</td>
                        <td>{{  $vat['express_processing'] }} €</td>
                        <td>{{  $order->express }} €</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>19% Mwst. DE:</td>
                        <td>{{  $vat['total'] }} €</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td><b>GESAMTSUMME:</b></td>
                        <td><b>{{  $order->total_price }} €</b></td>
                    </tr>
                    </tbody>
                </table>


                    <div class="row mt-1">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" style="border-radius: 25px !important; ">Speichern</button>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>



    <div class="row mt-2">
        <div class="col-12">
            <div class="card" style="border-left:1px solid black; ">
                <div class="card-body">

                    <div class="row pb-2" style="border-bottom: 1px solid lightgrey">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <p class="h4">Stellenanzeige</p>
                            </div>
                            <div class="col-md-12 mt-3">
                                <p class="h5">Link</p>
                                <p><a href="{{$order->orderdetail->job}}">{{$order->orderdetail->job}}</a></p>
                            </div>
                            <div class="col-md-12 mt-2">
                                <p class="h5">Dateien</p>
                                <div style="padding: 2%">
                                    <p><button class="btn btn-sm btn-light"><i class="fe-download"></i></button><a href="{{ url('public/files/job/'.$order->orderdetail->job_file)}}" target="_blank" download="{{$order->orderdetail->job_file}}">{{$order->orderdetail->job_file}}</a></p>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <p class="h5">Beschreibung</p>
                               {!! $order->orderdetail->job_description !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <p class="h4">Unterlagen</p>

                            </div>
                            <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                @foreach($order->documents as $document)
                                    <tr>
                                        <td>{{ $document->name  }}</td>
                                        <td><a href="{{ url('public/files/document/'.$document->name)}}" target="_blank" download="{{$document->name}}">Downloaden</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>


                    </div>
                    <div class="row mt-3">
                        @if($order->orderdetail->motivation_description!='-1')
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <p class="h4">Motivation</p>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="p-2">
                               {!! $order->orderdetail->motivation_description !!}
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Gehaltsvorstellung</span>
                                        </div>
                                        <input type="text" id="salary" class="form-control" value="{{$order->orderdetail->motivation_salary}}" readonly>

                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Einstiegsdatum</span>
                                        </div>
                                        <input type="text" id="entry_date" class="form-control" value="{{$order->orderdetail->motivation_entry_date}}" readonly>

                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif

                            @if($order->orderdetail->qualifications!='-1')

                            <div class="col-md-6">
                            <div class="col-md-12">
                                <p class="h4">Qualifikationen</p>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="p-2">
                                    {!! $order->orderdetail->qualifications !!}
                                </div>
                            </div>
                        </div>
                                @endif

                    </div>
                </div><!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="card" style="border-left:1px solid black; ">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ url('saveNotes/'.$order->id) }}" method="POST">
                                @csrf

                            <div class="row">

                                <div class="col-md-12 form-group mb-3">
                                    <label for="biographical_information">
                                        <h5>{{ __('locale.Notes && Info') }}</h5>
                                    </label>
                                    <textarea class="ckeditor form-control" name="notes"  id="note" required>{{ $order->orderdetail->notes }}</textarea>
                                </div>
                            </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light float-right">{{ __('locale.Update') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </section>
    <!-- /Validation -->
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $( document ).ready(function() {
 $('#invoiceDownload').on('click',function (e) {
            e.preventDefault();
            window.open('{{url('invoicepdf/'.$order->id)}}', '_blank');

        });

        $('.addEmployee').on('click',function(e) {
            e.preventDefault();
         var id =   $(this).attr('data-id');
         var order =   $(this).attr('data-name');
            $(this).text('Added').attr('disabled',true);
            $.ajax({
                type: 'GET',
                url: '/dropupdate/' + id + '/' + order,
                success: function(data) {
                    // console.log(data);
                    // location.reload();

                }
            });

        });
        $('#addEmployeeSave').on('click',function (e) {
            e.preventDefault();
             location.reload();

        });


        $('.removeEmployee').on('click',function (e) {
            e.preventDefault();
            var id =   $(this).attr('data-id');
         var order =   $(this).attr('data-name');
            $(this).text('Remove').attr('disabled',true);
            $.ajax({
                type: 'GET',
                url: '/unassingemploy/' + id + '/' + order,
                success: function(data) {
                    // console.log(data);
                    // location.reload();

                }
            });
        });


        $('#removeEmployeeSave').on('click',function (e) {
            e.preventDefault();
             location.reload();

        });

        $('.deleteTrialDocument').on('click',function (e) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                url: '/deleteTrialDocument/' + id ,
                success: function(data) {
                    location.reload();

                }
            });

        });

        $('.deleteFinishedDocument').on('click',function (e) {
            var id = $(this).attr('data-id');
            alert(id)
            $.ajax({
                type: 'GET',
                url: '/deleteFinishedDocument/' + id ,
                success: function(data) {
                    location.reload();

                }
            });

        });
    });


    </script>
