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
    <h1>{{ __('locale.List users') }}</h1>
    <section id="basic-datatable">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="col-md-12">
                        <center>
                        <div class="row">
                            <div class="col-md-9" style="text-align:left">
                                <form action="{{ url('search') }}" method="POST">
                                    @csrf
                                    <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                        name="action" value="all" class="btn btn-primary">{{ __('locale.All') }} |
                                        {{ session('all') }} </button>
                                    <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                        name="action" value="admins" class="btn btn-primary">{{ __('locale.Admin') }} |
                                        {{ session('admins') }} </button>
                                    <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                        name="action" value="customers"
                                        class="btn btn-primary">{{ __('locale.Customers') }} |
                                        {{ session('customers') }} </button>
                                    <button style="background-color: #3b3f77;border-color: white;" type="submit"
                                        name="action" value="employees"
                                        class="btn btn-primary">{{ __('locale.employees') }} |
                                        {{ session('employees') }} </button>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ 'adduser' }}" type="button" class="float-right btn btn-success"><i
                                    class="fa fa-plus" aria-hidden="true"></i>{{ __('locale.Add New Users') }}</a>
                            </div>
                        </div>
                    </center>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
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
                                        <th>{{ __('locale.Name') }}</th>
                                        <th>{{ __('locale.Telephone') }}</th>
                                        <th>{{ __('locale.Created on') }}</th>
                                        <th class="bg-danger text-light">{{ __('locale.Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td> <input class="form-check-input" type="checkbox" id="checkbox1">
                                                <label class="form-check-label" for="checkbox1"
                                                    class="label-table"></label>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper">
                                                <div class="avatar  me-1"><img src="{!! asset ('images/profiles')!!}/{{$user->profile_picture}} " alt="Avatar" height="32" width="32"></div></div>
                                                <div class="d-flex flex-column"><a href="app-user-view-account.html" class="user_name text-truncate text-body"><span class="fw-bolder">
                                                {{ $user->name }}</span></a><small class="emp_post text-muted">{{ $user->email }}</small></div></div>
                                            </td>
                                            <td>@if(!empty($user->userdetail->telephone))
                                                {{$user->userdetail->telephone}}
                                            @endif</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td >
                                                <div class="dropdown">
                             <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather='more-vertical'></i>  </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                         <a href="{{ url('edituser/'.$user->id) }}"
                                                        class="dropdown-item"><i
                                                            class="fa fa-pencil-square-o text-primary mr-1" aria-hidden="true"
                                                            style="font-size: 1.5em;"></i>Edit</a>
                                                    <a href="{{ url('delete/' . $user->id) }}" class="delete-confirm dropdown-item"><i
                                                            class="fa fa-trash-o text-danger" aria-hidden="true"
                                                            style="font-size: 1.5em;"></i> Delete</a>

      </div>
    </div>



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
