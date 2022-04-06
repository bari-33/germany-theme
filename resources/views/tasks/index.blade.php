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
    <h1>{{ __('locale.Tasks') }}</h1>
    @if (session('alert'))
        <div class="demo-spacing-0">
            <div class="alert alert-success" role="alert">
                <div class="alert-body"><strong>{{ session('alert') }}</strong></div>
            </div>
        </div>
    @endif
    <section class="bs-validation">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="app-fixed-search d-flex align-items-center">
                            <div class="d-flex align-content-center justify-content-between w-100">
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="search"
                                                class="text-muted"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="search" autocomplete="off" value=""
                                        placeholder="Search task" />
                                </div>
                            </div>

                        </div>

                            @foreach ($orders as $order)



                            <div class="container mt-4" id="allsearch">
                                <div>
                                    @if ($order->order_status == '3')
                                    <?php

                                    $product_description = explode('<li>' , $order->pdetail->product_description);

                                //    $data = ($product_description[0]);

                                     echo '<pre>'; print_r($data); echo '</pre>'; die;
                                    ?>
                                    <h3>{{ $order->pdetail->product_title }}</h3>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">
                                    @foreach ($product_description as $description)

                                    <div class="row">
                                      <input class="check" id="checkbox1" type="checkbox"
                                       value="{{ $order->id }}" data-id="12" data-name ="2">&nbsp;&nbsp;
                                      <h5>{!!$description!!}</h5>
                                    <hr style="border: 0.3px solid lightgrey;width: 100%;">
                                    </div>

                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            @endforeach

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val();
            $("#allsearch  div").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });

        });

    });
</script>
