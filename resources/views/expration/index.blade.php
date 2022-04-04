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
    .centered {
      position: absolute;
      top: 10%;
      left: 20%;
      transform: translate(-50%, -50%);
    }
    .paragraph {
      position: absolute;
      top: 13%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    .paragraph2 {
      position: absolute;
      top: 11%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    .paragraph3 {
      position: absolute;
      top: 18%;
      left: 50%;
      font-size: 120%;
      text-align: center;
      transform: translate(-50%, -50%);
    }
    .paragraph4 {
      position: absolute;
      top: 30%;
      left: 50%;
      text-align: center;
      transform: translate(-50%, -50%);
    }
    .paragraph5 {
      position: absolute;
      top: 32%;
      left: 50%;
      font-size: 190%;
      text-align: center;
      transform: translate(-50%, -50%);
    }
    .paragraph6 {
      position: absolute;
      top: 90%;
      left: 50%;
      font-size: 190%;
      text-align: center;
      transform: translate(-50%, -50%);
    }
    .paragraph7 {
      position: absolute;
      top: 92%;
      left: 50%;
      font-size: 190%;
      text-align: center;
      transform: translate(-50%, -50%);
    }
    .paragraph8 {
      position: absolute;
      top: 95%;
      left: 50%;
      font-size: 190%;
      text-align: center;
      border-radius: 2px;
      transform: translate(-50%, -50%);
    }
    .img1{
        opacity: 0.5;
    }
    </style>
@section('content')
    <!-- Validation -->
    <h1>{{ __('locale.Expration') }}</h1>
    <section class="bs-validation">
        <div>
            <img src="{!! asset('images/logo/login-bg.jpg')!!}"  alt="user-image" class="image" width="100%" height="450px;">
            <div class="centered">
                <h2>Wir!</h2>
            </div>
            <div class="paragraph">
                <h4>KURZ ÜBER UNS</h4>


            </div>
            <div class="paragraph2">
                <h2 >Wer sind Wir</h2>
                <hr style="border: 2px solid gray">
            </div>

            <div class="paragraph3">
                <p >Unser qualifiziertes Team von ausgebildeten Bewerbungsprofis und Grafikdesignern verhilft Dir zu Deinem Traumjob. Lasse Dir von unserem Expertenteam Deine professionelle Bewerbung erstellen- individuell an dich angepasst. Unser fachkundiges Personal weiß genau, wie du einen bleibenden Eindruck hinterlässt. Durch fundiertes Fachwissen im Bereich der Bewerbung sowie der Verwendung von neuester Grafik-Software erstellen wir qualitativ hochwertige Bewerbungsunterlagen, die obendrauf nach den modernsten Bewerbungstrends gestaltet werden.</p>

            </div>
           </div>

        <div>

        <img src="{!! asset('images/profiles/expration.png')!!}"  alt="user-image" class="img1" width="100%" height="450px;">
        <div class="paragraph4">
            <h1>So funktionierts</h1>
        </div>
        <div class="paragraph5">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.s</p>
        </div>
        <br><br><br><br>
        <div class="container">
            <div class="row">
        <div class="col-md-4" >
            <h6 class="ml-3">VERTRAUEN</h6>
            <h1>3800+<h1>
            <h6>über 3800 zufriedene Kunden<h6>
        </div>
        <div class="col-md-4" >
            <h6 class="">BEWERTUNG</h6>
            <h1>99%<h1>
            <h6>über 99% unserer Kunden haben positiv bewertet<h6>
        </div>
        <div class="col-md-4" >
            <h6 class="">EINLADUNG</h6>
            <h1>5x<h1>
            <h6>höhe Quote zum Vorstellungsgespräch<h6>

        </div>
        <div class="col-md-12">
        <hr style="border-bottom: 2px solid rgb(28, 73, 141)">

        </div>

        <div class="col-md-4">
            <h2>
                Unser kreatives Team
            </h2>
            <h4>
                Zusammen schaffen wir was großes
            </h4>
        <p> Die moderne und professionelle visuelle Gestaltung sorgt für jeden Blickfang. Durch fundiertes Fachwissen im Bereich der Bewerbung sowie der Verwendung von neuester Grafik-Software erstellen wir qualitativ hochwertige Bewerbungsunterlagen, die obendrauf nach den modernsten Bewerbungstrends gestaltet werden. Um auch sprachlich anspruchsvolle Bewerbungsunterlagen gewährleisten zu können, bedarf es ständigen Schulungen aus dem Bereich der Sprachlehre. Gerne sind wir bereit, mit unserem Expertenwissen auch Dir zu Deinem Traumjob zu verhelfen.</p>
        <img src="{!! asset('images/profiles/content.png')!!}"  alt="user-image" width="100%" height=";">
        <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>


        </div>
        <div class="col-md-2"></div>
        <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>

        <div class="col-md-6">
            <i class="fa fa-signal " style="font-size: 60px;" aria-hidden="true"></i>
            <h2>
                Nonumy  sadipscing
            </h2>
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod </p><br><br>
            <i class="fa fa-clock-o " style="font-size: 60px;" aria-hidden="true"></i>
            <h2>
                Sadipscing invidunt
            </h2>
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt </p><br><br>
            <i class="fa fa-handshake-o " style="font-size: 60px;" aria-hidden="true"></i>
            <h2>
                Dolor Consetetur elitr
            </h2>
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt  </p><br><br>
            <i class="fa fa-address-card-o " style="font-size: 60px;" aria-hidden="true"></i>
            <h2>
                Lorem ipsum sadipscing elitr
            </h2>
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt </p>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
        </div>
        </div>

        </div>

        <footer>
            <div>
        <img src="{!! asset('images/profiles/white.png')!!}"  alt="user-image" width="100%" height="350px;">
            <div class="paragraph6">
            <h2 >
                Hast du fragen an uns?
            </h2>
            </div>
            <div class="paragraph7">
                <h4 >
                    Was sollen wir etwas machen?

                </h4>
                </div>
                <div class="paragraph8">
                    <button class="btn btn-primary">Kontaktieren</button>
                    </div>
            </div>
        </footer>


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
