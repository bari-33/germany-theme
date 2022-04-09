<html>
<head>
    <meta charset="utf-8" />
    <title>Bewerbung.one</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/logo.png') }}">
    <link href="{{ url('css/orders.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @include('panels/styles')
    @include('panels/styles')

    <style>
        .bg-bdy{
            background: url('{!! asset('public/img/logo/login-bg-01.png') !!}') center top no-repeat;
        }
    </style>
</head>
<body>
<body class="bg-bdy" style="margin: 0 auto">

<div class="container-fluid">

    <h2 class="text-center logo mt-2 mb-3">
        <a href="#">
            <img src="{{url('images/logo/logo.png')}}" alt="">
        </a>

    </h2><!--/Logo_Bar-->

</div>

<div class="container">
    <div class="row">
        <div class="offset-lg-4 col-lg-5 col-xl-5 offset-md-3">
            <div class="card" style="border-radius: 10px;box-shadow: 0px 8px 6px 1px #7e57c2b5;">
                <div style="height: 200px;background: url('{{url('images/theme/assets/images/background-2.jpg')}}') no-repeat;background-position: -157px -263px;border-radius: 10px 10px 0px 0px;text-align: left;color: white;">
                    <h2 style="color: white;padding-top: 14%;padding-left: 14%;font-size: 224%;">Hallo {{$order->user->name}} !</h2>
                    <p style="padding-left: 14%;font-size: 153%;">Danke für dein Vertrauen</p>
                </div>
                <div class="card-body" style="text-align: center;">
                    <p class="card-title" style="margin-top: 3%;margin-bottom: 4%;">Ihr Passwort lautet :
                        <span style="font-weight: 600;color: black;">{{$password}}</span>
                    </p>
                    <p class="card-text" style="margin-bottom: 1%;">
                        Wir haben Ihnen die Zugangsdaten per E-Mail zugesandt:
                    </p>
                    <p style="margin-bottom: 10%;color: black;">{{$order->user->email}}</p>
                    <a href="{{url('customer_dashboard')}}" class="btn btn-primary waves-effect waves-light" style="padding-left: 4%;padding-right: 4%;border-radius: 20px;">Upload Dokumente jetzt</a>
                    <p style="margin-top: 3%;">Laden Sie jetzt Ihre Dokumente hoch und fügen Sie die erforderlichen Daten hinzu.</p>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>
