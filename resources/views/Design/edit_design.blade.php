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
    <h1>{{ __('locale.Update Designs') }}</h1>
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
                        <form action="{{ url('updatedesign/'.$design->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="action" value='new'>
                            <div class="row">
                                <div class="col-md-12 row">
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="design_title">
                                            <h5>{{ __('locale.Product Name') }}</h5>
                                        </label>
                                        <input class="form-control " id="design_title" type="text" required="required"
                                            name="design_title"value="{{$design->design_title}}" placeholder="{{ __('locale.Product Name') }}" />
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="regular_price">
                                            <h5>{{ __('locale.Regular price') }}</h5>
                                        </label>
                                        <input class="form-control" id="regular_price" name="regular_price" type="text"
                                        value="{{$design->regular_price}}" placeholder="{{ __('locale.Regular price') }}" required />
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="promotional_price">
                                            <h5>{{ __('locale.Promotional price') }}</h5>
                                        </label>
                                        <input type="text" id="promotional_price" class="form-control"
                                            name="promotional_price" value="{{$design->promotional_price}}" placeholder="{{ __('locale.Promotional price') }}"
                                             />
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="category">
                                            <h5>{{ __('locale.Product Category') }}</h5>
                                        </label>
                                        <select name="category" class="form-control" required>
                                            @foreach($design_categories as $category)
                                            <option value="{{$category->id}}" <?php if($design->product_category==$category->name) echo "selected='selected';" ?> >{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="status">
                                            <h5>{{ __('locale.Status') }}</h5>
                                        </label>
                                        <select name="status" class="form-control" required>
                                            <option value="1" {{$design->status==1?'selected':''}}>Online</option>
                                            <option value="0" {{$design->status==0?'selected':''}}>Offline</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group mb-3">
                                        <label for="tax_class">
                                            <h5>{{ __('locale.Tax bracket') }}</h5>
                                        </label>
                                        <select name="tax_class" class="form-control" required>
                                            <option value="0% VAT" {{$design->tax_class=="0% VAT"?'selected':''}}>0% MwSt</option>
                                            <option value="7% VAT" {{$design->tax_class=="7% VAT"?'selected':''}}>7% MwSt</option>
                                            <option value="19% VAT" {{$design->tax_class=="19% VAT"?'selected':''}}>19% MwSt</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div style="padding: 2px;color: black;">
                                        <h4>{{ __('locale.Service') }}</h4>
                                    </div>
                                    <div class="radio form-check-inline">
                                        <input type="radio" value="Letter" name="service" {{$design->service=="Letter"?'checked':''}} required>
                                        <label for="service">{{ __('locale.Letter') }}</label>
                                    </div>
                                    <div class="radio form-check-inline">
                                        <input type="radio" value="Resume" {{$design->service=="Resume"?'checked':''}} name="service">
                                        <label for="service">{{ __('locale.Resume') }}</label>
                                    </div>
                                    <div class="radio form-check-inline">
                                        <input type="radio" value="Motivation" {{$design->service=="Motivation"?'checked':''}} name="service">
                                        <label for="service">{{ __('locale.Motivation') }}</label>
                                    </div>
                                    <div class="radio form-check-inline">
                                        <input type="radio" value="Package" {{$design->service=="Package"?'checked':''}} name="service">
                                        <label for="service"> {{ __('locale.Package') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <label><h3>{{ __('locale.Primary Image') }}</h3></label>
                                            <a class="css" id="img" onclick="remove(this)"><i
                                                    class="fa fa-times" aria-hidden="true"
                                                    style="font-size: 1em;"></i></a>
                                            <div class="card-content">
                                                <img id="preview_img" src="{{ asset('images/designs/primary/' . $design->primary_image) }}"
                                                    class="" width="200" height="150" />
                                                <input type="file" name="primary_image"  onchange="loadPreview(this);"
                                                    class="dropify" id="aa" data-max-file-size="1M" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <label><h3>{{ __('locale.Secound image') }}</h3></label>
                                            <a class="css" id="img1" onclick="remove1(this)"><i
                                                    class="fa fa-times" aria-hidden="true"
                                                    style="font-size: 1em;"></i></a>
                                            <div class="card-content">
                                                <img id="preview_img1" src="{{ asset('images/designs/secondary/' . $design->secondary_image) }}"
                                                    class="" width="200" height="150" />
                                                <input type="file" name="secondary_image"  onchange="loadPreview1(this);"
                                                    class="dropify" id="aa" data-max-file-size="1M" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-5 ">
                                <input type="submit" name="submit" value="{{ __('locale.Update') }}"
                                    class="float-right btn btn-primary" />
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
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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
    function loadPreview1(input, id) {
        id = id || '#preview_img1';
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

        $("#img1").show();
    }

    function remove(elem) {
        let imginput = $(elem).parent('div').children('div').html(
            '<img id="preview_img" src="{{ asset('images/products/product.jpg') }}"class="" width="200" height="150" /><input type="file" name="product_image"onchange="loadPreview(this);" class="dropify" id="aa" data-max-file-size="1M" /><p class="text-muted text-center mt-2 mb-0"></p>'
            );

        $("#img").hide();


    }
    function remove1(elem) {
        let imginput = $(elem).parent('div').children('div').html(
            '<img id="preview_img" src="{{ asset('images/products/product.jpg') }}"class="" width="200" height="150" /><input type="file" name="product_image"onchange="loadPreview(this);" class="dropify" id="aa" data-max-file-size="1M" /><p class="text-muted text-center mt-2 mb-0"></p>'
            );

        $("#img1").hide();


    }



</script>
