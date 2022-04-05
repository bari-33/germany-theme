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

@section('content')
    <!-- Validation -->
    <h1>{{ __('locale.change-password') }}</h1>
    @if (session('success'))
    <div class="demo-spacing-0">
      <div class="alert alert-success" role="alert">
        <div class="alert-body"><strong>{{(session('success'))}}</strong></div>
      </div>
    </div>
  @endif
    <section class="bs-validation">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    @foreach ($user as $users)

                    <form action="{{ url('chngpassword/'.$users->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 form-group mb-3">
                                <label for="password">
                                    <h5>{{ __('locale.Old Password') }}</h5>
                                </label>
                                <input type="password" class="form-control"
                                    name="oldPassword" id="oldPassword" placeholder="{{ __('locale.Old Password') }}"
                                    required>
                                    @if (session('alert'))
                                        <span class="text-danger">{{(session('alert'))}}</span>
                                  @endif
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="password">
                                    <h5>{{ __('locale.Password') }}</h5>
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="{{ __('locale.Password') }}" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="cnfrm_password">
                                    <h5>{{ __('locale.Confrim Password') }}</h5>
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password_confirmation" id="password_confirmation"
                                    placeholder="{{ __('locale.Confrim Password') }}" required="required">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <input type="submit" name="submit" value="{{ __('locale.change-password') }}"
                                    class="float-right btn btn-danger" />
                            </div>
                        </div>
                    </div>
                    </form>
                    @endforeach

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
