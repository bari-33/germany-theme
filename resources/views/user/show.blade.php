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
i.fa {
  display: inline-block;
  border-radius: 60px;
  box-shadow: 0 0 2px blue;
  padding: 0.5em 0.6em;

}

</style>
@section('content')
    <!-- Validation -->
    <h1 class="text-center mt-2">{{ __('locale.Profile') }}</h1>
    <section class="bs-validation">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 mt-1">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-box text-center">
                            <img src="{!! asset('images/profiles/' . $userdetail->profile_picture) !!}"
                                class="rounded-circle avatar-lg img-thumbnail mx-auto d-block " alt="profile-image"
                                width="100" height="100">
                            <div class="text-center mt-2">
                                <h4 class="mb-0">{{ $userdetail->name }}</h4>
                                <p class=" text-danger">@ {{ $userdetail->userdetail->username }}</p>
                            </div>
                            <div class="text-left mt-3">
                                <h4 class="font-13 text-uppercase">
                                    <strong>{{ __('locale.Biographical information') }}:</strong>
                                </h4>
                                <p class="text-center font-13 mb-3">
                                    {{ $userdetail->userdetail->biographical_information }}
                                </p>

                                <p class="mb-2 font-13"><strong>{{ __('locale.Full Name') }}:</strong> <span
                                        class="ml-2">{{ $userdetail->name }}</span></p>
                                <p class="mb-2 font-13"><strong>{{ __('locale.Telephone') }}:</strong><span
                                        class="ml-2">
                                        {{ $userdetail->userdetail->telephone }}
                                    </span></p>
                                <p class="mb-2 font-13"><strong>{{ __('locale.Email') }}:</strong> <span
                                        class="ml-2 ">
                                        {{ $userdetail->email }}
                                    </span></p>
                                <p class="mb-1 font-13"><strong>{{ __('locale.Website') }} :</strong> <span
                                        class="ml-2">
                                        <a
                                            href="{{ $userdetail->userdetail->website }}">{{ $userdetail->userdetail->website }}</a>

                                    </span></p>
                                <p class="mb-1 font-13"><strong>{{ __('locale.Facebook') }} :</strong> <span
                                        class="ml-2">
                                        <a
                                            href="{{ $userdetail->userdetail->facebook }}">{{ $userdetail->userdetail->facebook }}</a>

                                    </span></p>
                                <p class="mb-1 font-13"><strong>{{ __('locale.Instagram') }} :</strong> <span
                                        class="ml-2">
                                        <a
                                            href="{{ $userdetail->userdetail->instagram }}">{{ $userdetail->userdetail->instagram }}</a>

                                    </span></p>

                                <p class="mb-2 font-13"><strong>{{ __('locale.Role') }} :</strong> <span
                                        class="ml-2 ">
                                        {{ $userdetail->roles()->first()->name }}
                                    </span></p>
                                <p class="mb-2 font-13"><strong>{{ __('locale.Texter') }} :</strong> <span
                                        class="ml-2 ">
                                        @if ($userdetail->userdetail->deutch == 1)
                                            {{ __('locale.German') }} ,
                                        @endif
                                        @if ($userdetail->userdetail->english == 1)
                                            {{ __('locale.English') }} ,
                                        @endif
                                        @if ($userdetail->userdetail->spanish == 1)
                                            {{ __('locale.Spanish') }} ,
                                        @endif
                                        @if ($userdetail->userdetail->french == 1)
                                            {{ __('locale.French') }},
                                        @endif
                                    </span></p>
                                <p class="mb-2 font-13"><strong>{{ __('locale.Designer') }} :</strong> <span
                                        class="ml-2 ">
                                        @if ($userdetail->userdetail->web_designer == 1)
                                            {{ __('locale.Web Designer') }},
                                        @endif
                                        @if ($userdetail->userdetail->graphic_designer == 1)
                                            {{ __('locale.Designers') }},
                                        @endif
                                        @if ($userdetail->userdetail->media_designer == 1)
                                            {{ __('locale.Media Designer') }},
                                        @endif
                                    </span></p>
                                <div class="d-flex justify-content-center align-items-center">
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="{{ $userdetail->userdetail->facebook }}"
                                                class="social-list-item text-primary"><i
                                                    class="fa fa-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{ $userdetail->userdetail->instagram }}"
                                                class="social-list-item  text-danger"><i
                                                    class="fa fa-instagram"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{ $userdetail->userdetail->website }}"
                                                class="social-list-item  text-info"><i
                                                    class="fa fa-globe"></i></a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
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
