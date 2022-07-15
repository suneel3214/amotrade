<!DOCTYPE HTML>
<html>
<head>
    <title>Vaishnav Vivah</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
   <link rel="stylesheet" type="text/css" href="{{ url('assets/css/font-awesome.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/jquery.bxslider.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/multi-select.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/select2.min.css') }}">
<!--<link rel="stylesheet" type="text/css" href="{{ url('assets/css/pricing-table.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/bt-bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/bt-style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/bt-dashboard.css?68714') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/toastr.min.css') }}">
<script src="{{ url('assets/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/bootstrap-tabdrop.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ url('assets/js/toastr.min.js') }}"></script>
<!--<script language="JavaScript" type="text/javascript" src="{{ url('assets/includes/functions.js?97') }}"></script>-->
<!--<script language="JavaScript" type="text/javascript" src="{{ url('assets/includes/validate.js') }}"></script>-->
<!--<script language="JavaScript" type="text/javascript" src="{{ url('assets/includes/function_new.js') }}"></script>-->
</head>
<body>

    <!-- ============================  Navigation End ============================ -->
    <!-- ============================ Begin Content ============================ -->
<input type="hidden" name="send_interest" class="send_interest_url" data-url="{{ route('sendinterest')}}"  >
<input type="hidden" name="remove_interest" class="remove_interest_url" data-url="{{ route('removeinterest')}}"  >
<input type="hidden" name="shortlist" class="shortlist_url" data-url="{{ route('send-shortlisted')}}"  >
<input type="hidden" name="get_district" class="get_district_url" data-url="{{ url('api/get_district')}}"  >
<input type="hidden" name="accept_interest" class="accept_interest_url" data-url="{{ route('acceptinterest')}}"  >
    @yield('content')
    <!-- ============================ End Content ============================ -->

    <!-- ============================  Footer ============================ -->
    <div class="clearfix"> </div>
    <div class="footer-white">
      
        <footer class="ft-wrapper-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-9">
                        <div class="ft-copyright"> &copy; 2019 vaishnavvivah.com, All Rights Reserved.</div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <div class="ft-verify"> <img class="img-responsive" src="{{ url('assets/images/vaishnavvivah-logo.png') }}"> </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ url('assets/js/jquery.bootstrap.newsbox.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/jQuery-plugin-progressbar.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/jquery.multi-select.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/jquery.bxslider.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/owl.carousel.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/jquery.slimscroll.js') }}" type="text/javascript"></script>
<script>
var disable_click_flag = false;

$(window).scroll(function() {
    disable_click_flag = true;

    clearTimeout($.data(this, 'scrollTimer'));

    $.data(this, 'scrollTimer', setTimeout(function() {
        disable_click_flag = false;
    }, 250));
});

$("body").on("click", "a", function(e) {
    if( disable_click_flag ){
        e.preventDefault();
    }
});
</script>
    @yield('js')
</body>

</html>
