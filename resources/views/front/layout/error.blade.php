<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <title>@yield('title')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    @if(Request::segment(1) == 'ar')
        <link href="{{ asset('css/ar/custom_ar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/ar/menu_ar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/ar/custom_responsive_ar.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/ar/component_ar.css') }}" />
    @else
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom_responsive.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/component.css') }}" />
    @endif


    <!------Photo upload-------->
    <link href="{{ asset('css/imageuploadify.min.css') }}" rel="stylesheet">

    <!------Multiselect-------->    
    <link rel="stylesheet" href="{{ asset('css/dropdownCheckboxes.css') }}">
    
    <!------for search area-------->    
	<script src="{{ asset('js/modernizr.custom.js') }}"></script>
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<!-- START HEADER -->  

<div class="top-wrapper">
     <div class="container">
      <div class="row">
        <div class="col-sm-3">
           <div class="logo">
             <a href="{{ URL::Route('home') }}"><img src="{{ asset('images/logo.png') }}" alt=""></a>
           </div>
        </div>
        <div class="col-sm-9">
          
          
          
          <div class="top-nav">
            <ul>
              <li><a href="{{ URL::Route('home') }}">Home</a></li>
            </ul>
          </div>
          
          
          
          
          
        </div>
      </div>
     </div>
   </div>

<!-- END HEADER -->

    @yield('content')
    @include('front.includes.footer')   

	<a id="back-to-top" href="#" class="back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><i class="fa fa-angle-up" aria-hidden="true"></i></a>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <!------for search area-------->
    <script src="{{ asset('js/classie.js') }}"></script>
		<script src="{{ asset('js/uisearch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/imageuploadify.min.js') }}"></script>
		<script>
			new UISearch( document.getElementById( 'sb-search' ) );

      $(document).ready(function() {
                $('input[type="file"]').imageuploadify();
            })

    </script>
    
      
  </body>
</html>
