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
        /* display: none; */
    }

</style>
@section('content')
    <!-- Validation -->
    @foreach ($user as $users)
        <h1>{{ __('locale.Update User') }}</h1>
        @if (session('alert'))
            <div class="demo-spacing-0">
                <div class="alert alert-success" role="alert">
                    <div class="alert-body"><strong>{{ session('alert') }}</strong></div>
                </div>
            </div>
        @endif
        @if (session('update'))
        <div class="demo-spacing-0">
          <div class="alert alert-success" role="alert">
            <div class="alert-body"><strong>{{(session('update'))}}</strong></div>
          </div>
        </div>
      @endif
        <section class="bs-validation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title mb-3">
                                <h2>{{ __('locale.Name') }}</h2>
                                <hr style="border-bottom: 1px solid black">
                            </div>
                            <form action="{{ url('update/' . $users->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="action" value='new'>
                                <div class="row">
                                    <div class="col-md-8 row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="fname">
                                                <h5>{{ __('locale.First Name') }}</h5>
                                            </label>
                                            <input class="form-control " id="first_name" type="text" required="required"
                                                name="first_name" value="{{ $users->userdetail->first_name }}"
                                                placeholder="{{ __('locale.First Name') }}" />
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="lname">
                                                <h5>{{ __('locale.Last Name') }}</h5>
                                            </label>
                                            <input class="form-control" id="last_name" name="last_name" type="text"
                                                value="{{ $users->userdetail->last_name }}"
                                                placeholder="{{ __('locale.Last Name') }}" />
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="lname">
                                                <h5>{{ __('locale.Username') }}</h5>
                                            </label>
                                            <input type="text" id="basic-default-email1" class="form-control"
                                                name="username" value="{{ $users->userdetail->username }}"
                                                placeholder="{{ __('locale.Username') }}" required />
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="email">
                                                <h5>{{ __('locale.Email Adress') }}</h5>
                                            </label>
                                            <input class="form-control" id="email" name="email"
                                                value="{{ $users->email }}" required="required" type="email"
                                                placeholder="{{ __('locale.Email Adress') }}" />
                                            @if (\Session::has('message'))
                                                <div class="alert alert-danger">

                                                    <strong>{!! \Session::get('message') !!}</strong>

                                                </div>
                                            @endif
                                            <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="password">
                                                <h5>{{ __('locale.Password') }}</h5>
                                            </label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                id="password" placeholder="{{ __('locale.Password') }}" >
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label for="cnfrm_password">
                                                <h5>{{ __('locale.Confrim Password') }}</h5>
                                            </label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password_confirmation" id="password_confirmation"
                                                placeholder="{{ __('locale.Confrim Password') }}" >
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <a class="css" id="img" onclick="remove(this)"><i
                                                        class="fa fa-times" aria-hidden="true"
                                                        style="font-size: 1em;"></i></a>
                                                <div class="card-content">
                                                    <img id="preview_img"
                                                        src="{{ asset('images/profiles/' . $users->profile_picture) }}"
                                                        class="" width="200" height="150" />
                                                    <input type="file" name="profile_picture"
                                                        value="{{ $users->profile_picture }}" onchange="loadPreview(this);"
                                                        class="dropify" id="aa" data-max-file-size="1M" />
                                                    <p class="text-muted text-center mt-2 mb-0"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-title mb-3">
                                    <h2>{{ __('locale.Contact Info') }}</h2>
                                    <hr style="border-bottom: 1px solid black">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="Telephone">
                                            <h5>{{ __('locale.Telephone') }}</h5>
                                        </label>
                                        <input type="number" class="form-control" name="telephone" id="telephone"
                                            value="{{ $users->userdetail->telephone }}"
                                            placeholder="{{ __('locale.Telephone') }}">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="Website">
                                            <h5>{{ __('locale.Website') }}</h5>
                                        </label>
                                        <input type="url" class="form-control" name="website" id="website"
                                            value="{{ $users->userdetail->website }}"
                                            placeholder="{{ __('locale.Website') }}">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="facebook">
                                            <h5>{{ __('locale.Facebook') }}</h5>
                                        </label>
                                        <input type="url" class="form-control" name="facebook" id="facebook"
                                            value="{{ $users->userdetail->facebook }}"
                                            placeholder="{{ __('locale.Facebook') }}">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="Instagram">
                                            <h5>{{ __('locale.Instagram') }}</h5>
                                        </label>
                                        <input type="url" class="form-control" name="instagram" id="instagram"
                                            value="{{ $users->userdetail->instagram }}"
                                            placeholder="{{ __('locale.Instagram') }}">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="role">
                                            <h5>{{ __('locale.Role') }}</h5>
                                        </label>
                                        <select name="role" class="form-control" required>

                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $users->roles()->first()->id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-title mb-3">
                                    <h2>{{ __('locale.Position') }}</h2>
                                    <hr style="border-bottom: 1px solid black">
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-1" style="color: black;">
                                        <h2>{{ __('locale.Texter') }}</h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-check-inline">

                                            <label class="form-check-label" for="check1">
                                                <input type="checkbox" name="deutch" value="1" class="form-check-input"
                                                    {{ $users->userdetail->deutch == '1' ? 'checked' : '' }} id="language">
                                                {{ __('locale.German') }}
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label" for="check1">
                                                <input type="checkbox" name="english" value="1" class="form-check-input"
                                                    {{ $users->userdetail->english == '1' ? 'checked' : '' }} id="language">
                                                {{ __('locale.English') }}
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label" for="check1">
                                                <input type="checkbox" name="spanish" value="1" class="form-check-input"
                                                    {{ $users->userdetail->spanish == '1' ? 'checked' : '' }} id="language">
                                                {{ __('locale.Spanish') }}
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label" for="check1">
                                                <input type="checkbox" name="french" value="1" class="form-check-input"
                                                    {{ $users->userdetail->french == '1' ? 'checked' : '' }} id="language">
                                                {{ __('locale.French') }}
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-1" style="color: black;">
                                        <h2>{{ __('locale.Designer') }}</h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-check-inline">

                                            <div class="form-check-inline">

                                                <label class="form-check-label" for="check1">
                                                    <input type="checkbox" name="web_designer" value="1"
                                                        {{ $users->userdetail->web_designer == '1' ? 'checked' : '' }}
                                                        class="form-check-input" id="web_designer">
                                                    {{ __('locale.Web Designer') }}
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label" for="check1">
                                                    <input type="checkbox" name="graphic_designer" value="1"
                                                        {{ $users->userdetail->graphic_designer == '1' ? 'checked' : '' }}
                                                        class="form-check-input" id="language">
                                                    {{ __('locale.Designers') }}
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label" for="media_designer">
                                                    <input type="checkbox" name="media_designer" value="1"
                                                        {{ $users->userdetail->media_designer == '1' ? 'checked' : '' }}
                                                        class="form-check-input" id="media_designer">
                                                    {{ __('locale.Media Designer') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-title mb-3">
                                    <h2>{{ __('locale.About the user') }}</h2>
                                    <hr style="border-bottom: 1px solid black">
                                </div>
                                <div class="row">

                                    <div class="col-md-12 form-group mb-3">
                                        <label for="biographical_information">
                                            <h5>{{ __('locale.Biographical information') }}</h5>
                                        </label>
                                        <textarea class="form-control" name="biographical_information" id="biographical_information"
                                            placeholder="Biographical Information">{{ $users->userdetail->biographical_information }}
                                    </textarea>
                                    </div>
                                </div>
                                @if($users->roles()->first()->slug=="employee")
                                <div class="card-title mb-3">
                                    <h2>{{ __('locale.Billing Address') }}</h2>
                                    <hr style="border-bottom: 1px solid black">
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="Name of the company">
                                            <h5>{{ __('locale.Name of the company') }}</h5>
                                        </label>
                                        <input type="text" class="form-control" name="company"
                                        value="{{$users->userdetail->company}}"
                                            placeholder="{{ __('locale.Name of the company') }}">
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="Street name and number">
                                            <h5>{{ __('locale.Street name and number') }}</h5>
                                        </label>
                                        <input type="text" class="form-control" name="street_no"
                                            value="{{ $users->userdetail->street_no }}"
                                            placeholder="{{ __('locale.Street name and number') }}">
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="House no">
                                            <h5>{{ __('locale.House no') }}</h5>
                                        </label>
                                        <input type="text" class="form-control" name="house_no"
                                            value="{{ $users->userdetail->house_no }}"
                                            placeholder="{{ __('locale.House no') }}">
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="Additional information">
                                            <h5>{{ __('locale.Additional information') }}</h5>
                                        </label>
                                        <input type="text" class="form-control" name="additional_info"
                                            value="{{ $users->userdetail->additional_info }}"
                                            placeholder="{{ __('locale.Additional information') }}">
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="Postal code">
                                            <h5>{{ __('locale.Postal code') }}</h5>
                                        </label>
                                        <input type="number" class="form-control" name="zip_code"
                                            value="{{ $users->userdetail->zip_code }}"
                                            placeholder="{{ __('locale.Postal code') }}">
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="City">
                                            <h5>{{ __('locale.City') }}</h5>
                                        </label>
                                        <input type="text" class="form-control" name="city"
                                            value="{{ $users->userdetail->city }}"
                                            placeholder="{{ __('locale.City') }}">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="Land">
                                            <h5>{{ __('locale.Land') }}</h5>
                                        </label>
                                        <input type="text" class="form-control" name="country"
                                            value="{{ $users->userdetail->country }}"
                                            placeholder="{{ __('locale.Land') }}">
                                    </div>
                                </div>
                                <div class="card-title mb-3">
                                    <h2>{{ __('locale.Withdrawal Information') }}</h2>
                                    <hr style="border-bottom: 1px solid black">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="Name of the bank">
                                            <h5>{{ __('locale.Name of the bank') }}</h5>
                                        </label>
                                        <input type="text" class="form-control" name="bank_name"
                                        value="{{$users->userdetail->bank_name}}"
                                            placeholder="{{ __('locale.Name of the bank') }}">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="IBAN">
                                            <h5>{{ __('locale.IBAN') }}</h5>
                                        </label>
                                        <input type="text" class="form-control" name="iban"
                                        value="{{$users->userdetail->iban}}"
                                            placeholder="{{ __('locale.IBAN') }}">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="BC">
                                            <h5>{{ __('locale.BC') }}</h5>
                                        </label>
                                        <input type="text" class="form-control" name="bc"
                                        value="{{$users->userdetail->bc}}"
                                            placeholder="{{ __('locale.BC') }}">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="Paypal">
                                            <h5>{{ __('locale.Paypal') }}</h5>
                                        </label>
                                        <input type="text" class="form-control" name="paypal"
                                        value="{{$users->userdetail->paypal}}"
                                            placeholder="{{ __('locale.Paypal') }}">
                                    </div>
                                </div>
                                <div class="card-title mb-3">
                                    <h2>{{ __('locale.Earning') }}</h2>
                                    <hr style="border-bottom: 1px solid black">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="billing">
                                        <h5>{{ __('locale.Billing') }}</h5>
                                      </label>
                                        <select name="billing" class="form-control" required>
                                            <option value="">no-role</option>
                                            <option value="1" @if($users->userdetail->billing==1) selected @endif>percentage</option>
                                           <option value="2" @if($users->userdetail->billing==2) selected @endif>fixed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="billing">
                                        <h5>{{ __('locale.Amount') }}</h5>
                                      </label>
                                        <input type="text"  class="form-control" name="amount" value="{{$users->userdetail->amount}}" placeholder="{{ __('locale.Amount') }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-1" style="color: black;">
                                        <h2>{{ __('locale.Products') }}</h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-check-inline">

                                            <div class="form-check-inline">

                                                <label class="form-check-label" for="check1">
                                                    <input type="checkbox" name="resume" value="Resume" class="form-check-input" id="resume" @if($users->userdetail()->first()->employeeproducts()->where('product','resume')->exists()) checked @endif>
                                                    {{ __('locale.Resume') }}
                                                </label>
                                            </div>
                                            <div class="form-check-inline">

                                                <label class="form-check-label" for="check1">
                                                    <input type="checkbox" name="website" value="website" class="form-check-input" id="website" {{$users->userdetail->graphic_designer=="1"?'checked':''}}>
                                                    {{ __('locale.Website') }}
                                                </label>
                                            </div>
                                            <div class="form-check-inline">

                                                <label class="form-check-label" for="check1">
                                                    <input type="checkbox" name="package" value="package" class="form-check-input" id="package" {{$users->userdetail->media_designer=="1"?'checked':''}}>
                                                    {{ __('locale.Package') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-12 mt-5 ">
                                    <input type="submit" name="submit" value="{{ __('locale.Update') }}"
                                        class="float-right btn btn-primary" />
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
    @endforeach

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
<script>
    function loadPreview(input, id) {
        id = id || '#preview_img';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }


        $("#img").show();
    }

    function remove(elem) {
        let imginput = $(elem).parent('div').children('div').html(
            '<img id="preview_img" src="{{ asset('images/profiles/profile.png') }}"class="" width="200" height="150" /><input type="file" name="profile_picture"onchange="loadPreview(this);" class="dropify" id="aa" data-max-file-size="1M" /><p class="text-muted text-center mt-2 mb-0"></p>'
            );

        $("#img").hide();


    }


    $("#password").change(function() {
        if (!$("#password").val()) {

        } else {
            $("#password_confirmation").prop('required', true);

        }
    });
</script>
