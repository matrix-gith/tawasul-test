@extends('front.layout.login_layout')
@section('title','Profile')

@section('css')
<!-- <link rel="stylesheet" href="{{ asset('frontend/css/jquery.ezdz.css') }}"> -->
<link rel="stylesheet" href="{{ asset('frontend/css/jquery.cropbox.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/tinyscrollbar.css') }}" type="text/css" media="screen"/>
<link href="{{ asset('frontend/css/animate.min.css') }}" rel="stylesheet">
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
@endsection
@section('content')

<div id="wrap">
    <div class="cube">
      <section class="page active face front" id="home">
              <div class="overview">
              <div class="register-in">
          <div class="act-table-cell ver-middle">
          <div class="register-top">
          <img src="{{ asset('frontend/images/reg-icon.jpg') }}" alt=""/>
          <span  class="animated zoomIn">Registration</span>
          <label class="animated infinite bounce down_arrow"><img src="{{ asset('frontend/images/reg-arrow.jpg') }}" alt=""/></label>
      </div>
           <h1><span>Hello <label>{{ $userInfo->display_name }},</label></span></h1>

      <div class="reg-body">
            <p>You are <input type="text" value="{{ $userInfo->display_name }}" readonly="readonly" placeholder="Full Name" data-autosize-input='{ "space": 20 }' />, working in our <input type="text" class="in2" value="{{ $userInfo->department->name }}" readonly="readonly" placeholder="Department" data-autosize-input='{ "space": 20 }' /> Department as <input type="text" class="in3" value="{{ $userInfo->designation->name }}" readonly="readonly" placeholder="Title" data-autosize-input='{ "space": 20 }' />.</p>

              <p>You have joined <input type="text" class="in3" value="{{ $userInfo->company->name }}" readonly="readonly" placeholder="Company" data-autosize-input='{ "space": 20 }' /> on <input type='text' id='datetimepicker' placeholder="DD/MM/YYYY" data-date-format="dd/mm/yyyy" value="{{ \DateTime::createFromFormat('Y-m-d', $userInfo->date_of_joining)->format('d/m/Y') }}" readonly="readonly" class="date" />.</p>

              <p>Can you tell me your date of birth <input type='text' placeholder="DD/MM" id="birthday" readonly="readonly"  data-date-format="dd/mm" class="date1" value="{{ \DateTime::createFromFormat('Y-m-d', $userInfo->date_of_birth)->format('d/m') }}" data-autosize-input='{ "space": 20 }'/>.</p>

              <p>You can be reached at <input type="text" readonly="readonly" placeholder="Phone No." value="{{ $userInfo->mobile }}" class="con" data-autosize-input='{ "space": 20 }' /> or on your E-Mail <input type='text' placeholder="E-Mail" value="{{ $userInfo->email }}" readonly="readonly" class="email" data-autosize-input='{ "space": 20 }'/>.</p>
          </div>

            <header>
              <nav class="text-center">
                <ul class="inline-block">
                  <li><a href="#" data-direction="back"><img src="{{ asset('frontend/images/arrow-right.png') }}" alt=""/></a><span>&nbsp;or&nbsp;</span> <a href="{{ URL::Route('home') }}">Skip</a></li>
                  <div class="clearfix"></div>
                </ul>
              </nav>
      
            </header>
          </div>
        </div>
            </div>
      </section>

     {!! Form::open(['method' => 'post','files' => true, 'id'=>'profileUpdate', 'route' => array('store_profile')]) !!}
     {!! Form::hidden('page_name','after-login') !!}
      <section class="page face back" id="portfolio">
              <div class="overview">
            <div class="register-in">
          <div class="act-table-cell ver-middle">

      <div class="reg-body reg-body2">
            <p>Write something about yourself:</p>
              <div class="paper">
          <div class="paper-content">
            <!-- <textarea autofocus>I am...</textarea> -->
            {!! Form::textarea('description',$userInfo->description, ['id' => 'description', 'maxlength' => '500', 'class' => 'form-control']) !!}
            
          </div>
          <span id="charNum"></span>
        </div>

              <p>Please upload an image of yourself:</p>
              
              <div id="plugin" class="cropbox">
                <div class="workarea-cropbox">
                    <div class="bg-cropbox">
                        <img class="image-cropbox">
                        <div class="membrane-cropbox"></div>
                    </div>

                    <div class="frame-cropbox">
                        <div class="resize-cropbox"></div>
                    </div>

                    <div class="btn-area">
                    <button type="button" class="btn btn-success btn-crop">
                        <i class="glyphicon glyphicon-scissors"></i> Crop
                    </button>
                    <button type="button" class="btn btn-warning btn-reset">
                        <i class="glyphicon glyphicon-repeat"></i> Reset
                    </button>
                  </div>

                </div>

              <div class="cropped panel panel-default">
                    <div class="panel-body">Drag & Drop your files or browse</div>
                    <span class="btn-file browss">
                        <img src="{{ asset('frontend/images/drop-icon.png')}}"/>
                        <input name="profile_photo" type="file" accept="image/*">
                    </span>
                </div>
                <div class="form-group hidden">
                    <label>Info of cropping</label>
                    <textarea class="data form-control" rows="5"></textarea>
                </div>
                </div>

              <p>Would you like to set a cover page on your Tawasul profile?</p>



              <div id="plugin1" class="cropbox1">
             <div class="workarea-cropbox1">
                 <div class="bg-cropbox1">
                     <img class="image-cropbox1">
                     <div class="membrane-cropbox1"></div>
                     <div class="btn-area">
                     <button type="button" class="btn btn-success btn-crop">
                         <i class="glyphicon glyphicon-scissors"></i> Crop
                     </button>
                     <button type="button" class="btn btn-warning btn-reset">
                         <i class="glyphicon glyphicon-repeat"></i> Reset
                     </button>
                   </div>
                 </div>
                 <div class="frame-cropbox1">
                     <div class="resize-cropbox1"></div>
                 </div>
             </div>

           <div class="cropped panel panel-default">
                 <div class="panel-body">Drag & Drop your files or browse</div>
                 <span class="btn-file browss">
                     <img src="{{ asset('frontend/images/drop-icon.png') }}"/> <input name="cover_photo" type="file" accept="image/*">
                 </span>
             </div>
             <div class="form-group hidden">
                 <label>Info of cropping</label>
                 <textarea class="data form-control" rows="5"></textarea>
             </div>
             </div>

              <div class="sub-area">
              <input type="submit" value="Submit"/> <span>or</span> <a href="{{ URL::Route('home') }}">Skip</a>
              </div>
          </div>


          </div>
        </div>
    </div>
      </section>
       {!! Form::close() !!}

      <section class="page face top" id="about">
        <div class="act-table text-center">
          <div class="act-table-cell ver-middle">about Page</div>
        </div>
      </section>
      <section class="page face right" id="contact">
        <div class="act-table text-center">
          <div class="act-table-cell ver-middle">contact Page</div>
        </div>
      </section>
      <section class="page face bottom" id="blog">
        <div class="act-table text-center">
          <div class="act-table-cell ver-middle">blog Page</div>
        </div>
      </section>
      <section class="page face left" id="article">
        <div class="act-table text-center">
          <div class="act-table-cell ver-middle">article Page</div>
        </div>
      </section>
    </div>
  </div>


@endsection

@section('script')

<script src="{{ asset('frontend/js/jquery.tinyscrollbar.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                var $scrollbar = $("#scrollbar3");
        $scrollbar.tinyscrollbar();
            });
      $(document).ready(function()
            {
        var $scrollbar = $("#scrollbar4");
        $scrollbar.tinyscrollbar();
            });
        </script>
<script>

(function(document, window, $){
  $(document).ready(function(){

    // Variables
    var
      windowWidth = $(window).width(),
      windowHeight = $(window).height(),
      $header = $('header');

    // header anchor tags
    function headerAnchors(){
      var pageDirection = '';
      var thisElement;
      var timeout;
      $header.find('nav li a').click(function(event){
        event.preventDefault();
          $('.cube').removeClass('reverse-' + pageDirection);
        thisElement = $(this);
        pageDirection = thisElement.data('direction');
        reverseDirection = thisElement.data('reverse-direction');
        thisElement.parent().addClass('active').siblings().removeClass('active');
          $('.cube').addClass('reverse-' + pageDirection);

          $header.addClass('go-out');
        $('#wrap').addClass('active');
        clearTimeout(timeout);
        timeout = setTimeout(function(){
          $header.removeClass('go-out');
          $('#wrap').removeClass('active');
        }, 1000);
      });
    }headerAnchors();
    $(window).resize(function(){

      // Vars
        windowWidth = $(window).width();
        windowHeight = $(window).height();
      // Functions
    });
  });
})(document, window, jQuery);

</script>

<!--/////////////page slider///////////////-->

<script type="text/javascript">
var Plugins;(function(n){var t=function(){function n(n){typeof n=="undefined"&&(n=30);this.space=n}return n}(),i;n.AutosizeInputOptions=t;i=function(){function n(t,i){var r=this;this._input=$(t);this._options=$.extend({},n.getDefaultOptions(),i);this._mirror=$('<span style="position:absolute; top:-999px; left:0; white-space:pre;"/>');$.each(["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],function(n,t){r._mirror[0].style[t]=r._input.css(t)});$("body").append(this._mirror);this._input.on("keydown keyup input propertychange change",function(){r.update()});(function(){r.update()})()}return n.prototype.getOptions=function(){return this._options},n.prototype.update=function(){var n=this._input.val()||"",t;n!==this._mirror.text()&&(this._mirror.text(n),t=this._mirror.width()+this._options.space,this._input.width(t))},n.getDefaultOptions=function(){return this._defaultOptions},n.getInstanceKey=function(){return"autosizeInputInstance"},n._defaultOptions=new t,n}();n.AutosizeInput=i,function(t){var i="autosize-input",r=["text","password","search","url","tel","email","number"];t.fn.autosizeInput=function(u){return this.each(function(){if(this.tagName=="INPUT"&&t.inArray(this.type,r)>-1){var f=t(this);f.data(n.AutosizeInput.getInstanceKey())||(u==undefined&&(u=f.data(i)),f.data(n.AutosizeInput.getInstanceKey(),new n.AutosizeInput(this,u)))}})};t(function(){t("input[data-"+i+"]").autosizeInput()})}(jQuery)})(Plugins||(Plugins={}))
</script>


<script src="{{ asset('frontend/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
            $(function () {
                // $('#datetimepicker').datepicker(function(){
                //   format: 'dd/mm/yyyy'
                // });
                // $('#birthday').datepicker(function(){
                //   format: 'dd/mm'
                // });

                
            });
</script>
<!-- <script src="{{ asset('frontend/js/jquery.ezdz.min.js') }}"></script> -->
<script>
        // $('#profile_photo').ezdz({
        //     text: 'Drag & Drop your files or browse',
        //     validators: {
        //         maxWidth : 800,
        //         maxHeight: 800,
        //         minWidth : 600,
        //         minHeight: 600
        //     },
        //     reject: function(file, errors) {
        //         if (errors.mimeType) {
        //             alert(file.name + ' must be an image.');
        //         }

        //         if (errors.maxWidth) {
        //             alert(file.name + ' must be width:800px max.');
        //         }

        //         if (errors.maxHeight) {
        //             alert(file.name + ' must be height:800px max.');
        //         }

        //         if (errors.minWidth) {
        //             alert(file.name + ' must be minimum width:600px ');
        //         }

        //         if (errors.minHeight) {
        //             alert(file.name + ' must be minimum height:600px min.');
        //         }
        //     }
        // });

        // $('#cover_photo').ezdz({
        //     text: 'Drag & Drop your files or browse',
        //     validators: {
        //         maxWidth : 1024,
        //         maxHeight: 900,
        //         minWidth : 600,
        //         minHeight: 800
        //     },
        //     reject: function(file, errors) {
        //         if (errors.mimeType) {
        //             alert(file.name + ' must be an image.');
        //         }

        //         if (errors.maxWidth) {
        //             alert(file.name + ' must be width:1024px max.');
        //         }

        //         if (errors.maxHeight) {
        //             alert(file.name + ' must be height:900px max.');
        //         }

        //         if (errors.minWidth) {
        //             alert(file.name + ' must be minimum width:600px ');
        //         }

        //         if (errors.minHeight) {
        //             alert(file.name + ' must be minimum height:800px min.');
        //         }
        //     }
        // });




    </script>


      <!--/////////////image crop js///////////////-->
<script src="{{ asset('frontend/js/jquery.cropbox.js') }}"></script>
<script src="{{ asset('frontend/js/cropper.min.js') }}"></script>
  <script>
   $('#plugin').cropbox({
        selectors: {
            inputInfo: '#plugin textarea.data',
            inputFile: '#plugin input[type="file"]',
            btnCrop: '#plugin .btn-crop',
            btnReset: '#plugin .btn-reset',
            resultContainer: '#plugin .cropped .panel-body',
            messageBlock: '#message'
        },
        imageOptions: {
            class: 'img-thumbnail',
            style: 'margin-right: 5px; margin-bottom: 5px'
        },
        variants: [
            {
                width: 200,
                height: 200,
                minWidth: 180,
                minHeight: 200,
                maxWidth: 350,
                maxHeight: 350
            }
        ],
        messages: [
            'Crop a middle image.',
            /*'Crop a small image.'*/
        ]
    });

      $('#close').click(function(e) {
              $('.canvasCon').hide();
          });

    $('#plugin1').cropbox1({
       selectors: {
           inputInfo: '#plugin1 textarea.data',
           inputFile: '#plugin1 input[type="file"]',
           btnCrop: '#plugin1 .btn-crop',
           btnReset: '#plugin1 .btn-reset',
           resultContainer: '#plugin1 .cropped .panel-body',
           messageBlock: '#message1'
       },
       imageOptions: {
           class: 'img-thumbnail',
           style: 'margin-right: 5px; margin-bottom: 5px'
       },
       variants: [
           {
               width: 1280,
               height: 350,
               minWidth: 1280,
               minHeight: 350,
               maxWidth: 1280,
               maxHeight: 350
           }
       ],
       messages: [
           'Crop a middle image.',
           /*'Crop a small image.'*/
       ]
      });
  </script>


@endsection