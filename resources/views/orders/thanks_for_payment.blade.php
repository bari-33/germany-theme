<html>
<head>
    <meta charset="utf-8" />
    <title>Bewerbung.one</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Bewerbung.one" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{!! asset('public/img//logo/logo.png') !!}">
    <link href="{!! asset('public/theme/assets/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/theme/assets/css/icons.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/theme/assets/css/app.min.css') !!}" rel="stylesheet" type="text/css" />

    <style>
    .header-img {
        background-image: url('http://localhost:8080/blog/public/img/logo/2.png');
        background-repeat: no-repeat;
        background-position: -1px -331px;


    }
    .brdr-tp {
         box-shadow: 0px -7px 0px 0px #7e57c2b5 !important;
         border-radius: 6px !important;
     }
</style>
</head>
<body>
<div class="container-fluid">
    <div class="row header-img">

   <div class="offset-md-5 col-md-7 mt-3">
       <img src="https://die.bewerbung.one/images/logo.png" alt="">
   </div>

<div class="col-md-6 ">
 <div class="row" style="color: white">
     <div class="offset-md-3 col-md-6 mt-5">
    <h1 style="color: lightgreen">Thank You <i class="fas fa-check"></i></h1>
     </div>
     <div class="offset-md-3 col-md-6">
     <p style="color: white">We will review and confirm your order</p>
     </div>
     <div class="offset-md-3 col-md-3" style="text-align: left;">
    <p>Order Number : </p>
    <p>Order Date : </p>
     </div>
     <div class="col-md-6" style="text-align: left">
         <p style="color: #00A6C7"><b>RE-35468</b></p>
         <p><b>{{$order->created_at->format('d.m.Y')}}</b></p>
     </div>
 </div>
 </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6" style="margin-top: 20%">
                    <p style="text-align: right">
                        We are truly grateful to you for choosing <br>
                    us  as your resume service provider and <br>
                    giving us the opportunity to grow
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="{{url('images/logo/3.png')}}"  class="img-fluid">
                </div>
            </div>
        </div>

    </div>
</div>
<div class="container mb-4">

    <div class="row m-2">
        <div class="col-md-12 text-center">
            <h3 id="feedback-heading">How likely are you to recommend us ?</h3>
        </div>
    </div>
    <div class="row" id="feedback-content-s" >
        <div class="col-md-12 text-center">
            <button class="btn btn-light btn-lg feedback-btn" value="1">1</button>
            <button class="btn btn-light btn-lg feedback-btn" value="2">2</button>
            <button class="btn btn-light btn-lg feedback-btn" value="3">3</button>
            <button class="btn btn-light btn-lg feedback-btn" value="4">4</button>
            <button class="btn btn-light btn-lg feedback-btn" value="5">5</button>
            <button class="btn btn-light btn-lg feedback-btn" value="6">6</button>
            <button class="btn btn-light btn-lg feedback-btn" value="7">7</button>
            <button class="btn btn-light btn-lg feedback-btn" value="8">8</button>
            <button class="btn btn-light btn-lg feedback-btn" value="9">9</button>
            <button class="btn btn-light btn-lg feedback-btn" value="10">10</button>
        </div>
        <div class="offset-md-2 col-md-2 text-right">
            <p class="text-muted">Very Likely</p>
        </div>
        <div class="offset-md-4 col-md-2 text-left">
            <p class="text-muted">Not Likely</p>
        </div>
    </div>

    <div class="row mb-4" id="feedback-content-h" style="display: none">
        <div class="col-md-12 text-center">
            <p class="text-muted">Some text will be here not shown now<br>Some text will be here not shown now<br>
                Some text will be here not shown now
            </p>
        </div>
        <div class="col-md-12 text-center">
            <button class="btn btn-md btn-primary" style="border-radius: 22px">Subscribe Now</button>
        </div>
    </div>
</div>




<div class="container">

    <div class="row mb-5">
        <div class="col-md-12">
            <h3 id="feedback-heading">Frequently Asked Questions</h3>
        </div>


    </div>


    <div class="row">
        @foreach($faqs as $faq)
        <div class="col-md-4">
            <div class="card brdr-tp">
                <h5 class="card-header" style="background-color: white">{{$faq->question}}</h5>
                <div class="card-body">
                    <p class="card-text">{{$faq->answer}}</p>
                </div>
            </div>
        </div>

            @endforeach
    </div>
</div>


</body>
</html>
<!-- Vendor js -->
<script src="{!! asset('public/theme/assets/js/vendor.min.js') !!}"></script>

<script>
$('.feedback-btn').on('click',function () {
    $('#feedback-content-s').hide();
    $('#feedback-content-h').show();
    $('#feedback-heading').text('Tell us a bit more about why you choose '+$(this).val());
});

</script>
