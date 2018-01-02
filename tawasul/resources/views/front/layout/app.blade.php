<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}">
    <title>@yield('title')</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom_responsive.css') }}" rel="stylesheet">

    <!------for search area-------->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/component.css') }}" />
  <script src="{{ asset('frontend/js/modernizr.custom.js') }}"></script>
  <!-- custom scrollbar stylesheet -->
  <link rel="stylesheet" href="{{ asset('frontend/css/tinyscrollbar.css') }}" type="text/css" media="screen"/>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>   
        var BASE_URL = "{{ URL::route('home') }}"; 
        var CSRF_TOKEN = "{{ csrf_token() }}";
    </script> 
  </head>



  <body>
 
    @include('front.includes.header')   
    @yield('content')
    @include('front.includes.footer')
    @include('front.includes.modal_box') 



    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

    <!-- custom scrollbar plugin -->

        <script type="text/javascript" src="{{ asset('frontend/js/jquery.tinyscrollbar.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                var $scrollbar = $("#scrollbar1");

                $scrollbar.tinyscrollbar();

            });
        </script>

    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <!------for search area-------->
    <script src="{{ asset('frontend/js/classie.js') }}"></script>
    <script src="{{ asset('frontend/js/uisearch.js') }}"></script>
    <script>
      new UISearch( document.getElementById( 'sb-search' ) );
  </script>



<script>
$(function () {
    $('.user-com').click(function () {
            var index = $(this).data("target");
            jQuery('#comment_'+index).slideToggle("slow");
    });
  });

 </script>

 <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })
</script>
    
    @yield('script')
 
  </body>
</html>
