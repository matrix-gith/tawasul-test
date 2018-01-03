<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}">
    <title>Tawasul : @yield('title')</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom_responsive.css') }}" rel="stylesheet">

    @yield('css')
    
    <!------for search area-------->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/component.css') }}" />
    <script src="{{ asset('frontend/js/modernizr.custom.js') }}"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <script>   
        var BASE_URL = "{{ URL::route('home') }}"; 
        var CSRF_TOKEN = "{{ csrf_token() }}";
    </script> 

@yield('content')

  <a id="back-to-top" href="#" class="back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><i class="fa fa-angle-up" aria-hidden="true"></i></a>

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>


    <script type="text/javascript">
            $("#btn-loading-animation").click(function(){
            $("#btn-loading-animation").addClass("btn-animate");
            var username = $('#username').val();
            var password = $('#password').val();
            
            $.ajax({
                  type  : 'POST',
                  url : BASE_URL + '/login',
                  data  : {'_token': CSRF_TOKEN,'username':  username, password: password },
                  success: function(msg){
                    msg = JSON.parse(msg);
                    if(msg.validate == 'Error')
                    {
                      $('#error_msg').html(msg.message);
                      $("#btn-loading-animation").removeClass("btn-animate");
                    }

                    if(msg.validate == 'Success')
                    {
                      window.location.href= BASE_URL+ "/"+msg.redirect_page;
                    }

                      
                  }
                });
            });
    </script>

    @yield('script')
  </body>
</html>
