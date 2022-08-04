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
    <h1>{{ __('locale.List Websites') }}</h1>
    <section id="basic-datatable">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="col-md-12">
                        <center>
                        <div class="row">
                            <div class="col-md-9" style="text-align: left">
                                <form action="{{ url('searchwebsite') }}" method="POST">
                                    @csrf
                                    <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                        name="action" value="all" class="btn btn-primary">{{ __('locale.All') }} |
                                        {{ session('count') }} </button>
                                    <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                        name="action" value="published"
                                        class="btn btn-primary">{{ __('locale.Published') }} |
                                        {{ session('published') }} </button>
                                    <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                        name="action" value="draft" class="btn btn-primary">{{ __('locale.Draft') }} |
                                        {{ session('draft') }} </button>
                                    <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                        name="action" value="deleted" class="btn btn-primary">{{ __('locale.Deleted') }}
                                        |
                                        {{ session('deleted') }} </button>
                                    <div class="dropdown"
                                        style="display: inline;background-color: #3b3f77;border-radius: 25px;border-color: white;">
                                        <button style="background-color: #3b3f77;border-color: white;" type="button"
                                            class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            {{ __('locale.Category') }}
                                        </button>
                                </form>
                                <div class="dropdown-menu">

                                    @foreach ($product_categories as $category)
                                        <a class="dropdown-item category_list" data-id="{{ $category->id }}"
                                            href="#">{{ $category->name }} ({{ $category->count }})</a>
                                    @endforeach
                                    <form action="{{ url('searchwebCategory') }}" id="category_form" name="form"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="category" id="selected_category">
                                        <input type="hidden" name="action" value="category">
                                        <input type="submit" style="display: none;" name="submit_category"
                                            id="submit_category">
                                    </form>

                                </div>
                            </div>
                        </div>
                            <div class="col-md-3">
                                <a href="{{ 'add_website' }}" type="button" class="float-right btn btn-success"><i
                                    class="fa fa-plus" aria-hidden="true"></i>{{ __('locale.Add New Website') }}</a>
                            </div>
                        </div>
                        </center>
                    </div>
                </div>
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
                                        <th>{{ __('locale.Product id') }}</th>
                                        <th>{{ __('locale.Title') }}</th>
                                        <th>{{ __('locale.Primary Image') }}</th>
                                        <th>{{ __('locale.Secound image') }}</th>
                                        <th>{{ __('locale.Price') }}</th>
                                        <th>{{ __('locale.Colour') }}</th>
                                        <th class="bg-danger text-light">{{ __('locale.Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($websites as $website)
                                        <tr>
                                            <td> <input class="form-check-input" type="checkbox" id="checkbox1">
                                                <label class="form-check-label" for="checkbox1"
                                                    class="label-table"></label>
                                            </td>
                                            <td>{{$website->id}}</td>
                                            <td>{{$website->website_title}}</td>
                                            <td><img src="{!! asset('images/websites/primary/' . $website->primary_image) !!}" width="150" height="150"
                                                class="img-thumbnail"></td>
                                            <td><img src="{!! asset('images/websites/secondary/' . $website->secondary_image) !!}" width="150" height="150"
                                                class="img-thumbnail"></td>
                                            <td>{{$website->regular_price}}</td>
                                            <td>{{$website->product_category}}</td>
                                            @if ($trash == false)
                                                <td>
                                                    <a href="{{url('editwebsite/'.$website->id)}}"><i class="fa fa-pencil-square-o text-primary mr-1"
                                                            aria-hidden="true" style="font-size: 1.5em;"></i></a>
                                                    <a href="{{url('destroywebsit/'.$website->id)}}" class="delete-confirm "><i class="fa fa-trash-o text-danger"
                                                            aria-hidden="true" style="font-size: 1.5em;"></i></a>
                                                </td>
                                            @endif
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
