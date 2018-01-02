<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}">
    <title>@yield('title')</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom_responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/menu.css') }}" rel="stylesheet">

    <!------Photo upload-------->
    <link href="{{ asset('frontend/css/imageuploadify.min.css') }}" rel="stylesheet">


    <!------Multiselect-------->

    <link rel="stylesheet" href="{{ asset('frontend/css/dropdownCheckboxes.css') }}">

    <!------for search area-------->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/component.css') }}" />
    <script src="{{ asset('frontend/js/modernizr.custom.js') }}"></script>
   <!------Guest Listing-------->

    <link rel="stylesheet" href="{{ asset('frontend/css/multiselect.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/multiselect-style.min.css') }}" />

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

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!------Guest Listing-------->

    <script src="{{ asset('frontend/js/multiselects.js') }}"></script>
    <style>
        .demo-section label {
            display: block;
            margin: 15px 0 5px 0;
        }
        #get {
            float: right;
            margin: 25px auto 0;
        }
    </style>
    <script>
        $(document).ready(function() {
            // create MultiSelect from select HTML element
            var required = $("#required").kendoMultiSelect().data("kendoMultiSelect");
            var optional = $("#optional").kendoMultiSelect({
                autoClose: false
            }).data("kendoMultiSelect");

            $("#get").click(function() {
                alert("Attendees:\n\nRequired: " + required.value() + "\nOptional: " + optional.value());
            });
        });
    </script>

    <!------Guest Listing-------->

    <!------for search area-------->
    <script src="{{ asset('frontend/js/classie.js') }}"></script>
        <script src="{{ asset('frontend/js/uisearch.js') }}"></script>
        <script>
            new UISearch( document.getElementById( 'sb-search' ) );
    </script>

    <!------Photo Upload-------->

    <script type="text/javascript" src="{{ asset('frontend/js/imageuploadify.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('input[type="file"]').imageuploadify();
            })
        </script>

   <!------Photo Upload-------->

   <script type="text/javascript">
   $(document).ready(function(){
   $('.panel').click( function() {
   $('.slidemenu').toggleClass('clicked').addClass('unclicked');
   $('.menubar_icon_black').toggleClass('menubar_icon_cross');
    });
   });
   </script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
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
