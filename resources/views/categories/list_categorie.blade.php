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
    <h1>{{ __('locale.List category') }}</h1>
    <section id="basic-datatable">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <center>
                        <div class="col-md-12">
                            <a href="{{ 'add_category' }}" type="button" class="float-left btn btn-success"><i
                                    class="fa fa-plus" aria-hidden="true"></i>{{ __('locale.Add New category') }}</a>
                        </div>
                    </center>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if (session('message'))
                    <div class="demo-spacing-0">
                        <div class="alert alert-success" role="alert">
                            <div class="alert-body"><strong>{{ session('message') }}</strong></div>
                        </div>
                    </div>
                @endif
                <div class="card ">

                    <div class="px-4 pt-4 pb-4">

                        <div class="table-wrapper">
                            <table class="datatables table mb-0" style="color: #000;">
                                <thead>
                                    <tr>
                                        <th class="ml-5"><input class="form-check-input" id="checkAll"
                                                type="checkbox">
                                            <label class="form-check-label" for="checkbox" class=" label-table"></label>
                                        </th>
                                        <th>{{ __('locale.Product Name') }}</th>

                                        <th class="bg-danger text-light">{{ __('locale.Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td> <input class="form-check-input" type="checkbox" id="checkbox1">
                                                <label class="form-check-label" for="checkbox1"
                                                    class="label-table"></label>
                                            </td>
                                            <td>{{ $product->name }}</td>


                                            <td>
                                                <a href="{{ url('editcategory/' . $product->id.'/1') }}"><i
                                                        class="fa fa-pencil-square-o text-primary mr-1" aria-hidden="true"
                                                        style="font-size: 1.5em;"></i></a>
                                                <a href="{{ url('destroy/' . $product->id.'/1') }}" class="delete-confirm "><i
                                                        class="fa fa-trash-o text-danger" aria-hidden="true"
                                                        style="font-size: 1.5em;"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    @foreach ($designs as $design)
                                        <tr>
                                            <td> <input class="form-check-input" type="checkbox" id="checkbox1">
                                                <label class="form-check-label" for="checkbox1"
                                                    class="label-table"></label>
                                            </td>
                                            <td>{{ $design->name }}</td>


                                            <td>
                                                <a href="{{ url('editcategory/' . $design->id.'/2') }}"><i
                                                        class="fa fa-pencil-square-o text-primary mr-1" aria-hidden="true"
                                                        style="font-size: 1.5em;"></i></a>
                                                <a href="{{ url('destroy/' . $design->id.'/2') }}" class="delete-confirm "><i
                                                        class="fa fa-trash-o text-danger" aria-hidden="true"
                                                        style="font-size: 1.5em;"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    @foreach ($websites as $website)
                                        <tr>
                                            <td> <input class="form-check-input" type="checkbox" id="checkbox1">
                                                <label class="form-check-label" for="checkbox1"
                                                    class="label-table"></label>
                                            </td>
                                            <td>{{ $website->name }}</td>


                                            <td>
                                                <a href="{{ url('editcategory/' . $website->id.'/3') }}"><i
                                                        class="fa fa-pencil-square-o text-primary mr-1" aria-hidden="true"
                                                        style="font-size: 1.5em;"></i></a>
                                                <a href="{{ url('destroy/' . $website->id.'/3') }}" class="delete-confirm "><i
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
