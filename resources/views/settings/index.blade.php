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
    <h1>{{ __('locale.Settings') }}</h1>
    <section class="bs-validation">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="action" value='new'>
                            <div class="row">
                                <div class="col-md-12 row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="fname">
                                            <h5>{{ __('locale.First Name') }}</h5>
                                        </label>
                                        <input class="form-control " id="first_name" type="text" required="required"
                                            name="first_name" placeholder="{{ __('locale.First Name') }}" />
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="lname">
                                            <h5>{{ __('locale.Last Name') }}</h5>
                                        </label>
                                        <input class="form-control" id="last_name" name="last_name" type="text"
                                            placeholder="{{ __('locale.Last Name') }}" />
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="lname">
                                            <h5>{{ __('locale.Username') }}</h5>
                                        </label>
                                        <input type="text" id="basic-default-email1" class="form-control" name="username"
                                            placeholder="{{ __('locale.Username') }}" required />
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="email">
                                            <h5>{{ __('locale.Email Adress') }}</h5>
                                        </label>
                                        <input class="form-control" id="email" name="email" required="required"
                                            type="email" placeholder="{{ __('locale.Email Adress') }}" />
                                    </div>


                                </div>


                        </form>
                    </div>
                </div>
            </div>

        </div>




    </section>
    <!-- /Validation -->
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
@endsection
