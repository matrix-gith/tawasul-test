@extends('front.layout.event_app')
@section('title','Tawasul')
@section('content')


   <div class="home-container">
     <div class="container">

       @include('front.includes.event_sidebar')
       @include('front.includes.event_header')


       <div id="exTab2">

			<div class="tab-content cal-con event-boxss ">
			  <div class="tab-pane active">
                <div class="row event_section">

        @if($eventList->count())
              @foreach($eventList as $event)
         	<div class="col-sm-4 col-xs-6">
           <div class="photo-single group-areas">
             <div class="group-img">
             	<a href="{{ route('event_details', encrypt($event->id)) }}">
               @if(count($event->eventImage) && file_exists(public_path('uploads/event_images/original/'.$event->eventImage[0]->image_name))) 
                        <img src="{{ asset('timthumb.php') }}?src={{ asset('uploads/event_images/original/'.$event->eventImage[0]->image_name) }}&w=377&h=200&q=100" alt="" class="big-img rounded">                       
                        @else
                        <img src="{{ asset('images/no-image-event-list.jpg') }}" alt="" class="big-img rounded">
                       @endif 
              </a>
             </div>
             <div class="eve-area">
             <div class="dates"><span>{{ \Carbon\Carbon::parse($event->event_start_date)->format('M') }}</span> {{ \Carbon\Carbon::parse($event->event_start_date)->format('d') }}</div>
             <div class="eve-right">
             <h3><a href="event-details.html">{!! $event->name !!}</a></h3>
             <h5 class="location">
               @if($event->allday_event =='Yes') 
                  @if($event->event_start_date == date('Y-m-d')) 
                    <i class="fa fa-hourglass-start"></i>Started 
                  @else 
                    Full Day Event 
                  @endif 
               @else  
                  <i class="fa fa-clock-o" aria-hidden="true"> </i><span class="timeCounter" data-time="{{ $event->event_start_date }} {{ $event->start_time }}"> {{ $event->start_time }} - {{ $event->end_time }}  </span> 
                @endif
              </h5>
             <h5 class="location"><i class="fa fa-map-marker"></i>{{ substr($event->location,0,30) }}</h5>
             </div>
             <div class="clear"></div>
             <a href="#" class="go">Attending</a>
             <a href="#" class="not_go">Not Attending</a>
             <a href="#" class="not_go">Tentative</a>
             </div>
           </div>
         </div>

         @endforeach
         @else
              <div class="col-sm-4">
                  {{ trans('eventList.no_event_for_today') }}
              </div>

         @endif



 </div>
</div>


			</div>
      <div class="loadings" data-offset="{{ $limit }}" data-event="{{ $eventDay }}" ><img src="{{ asset('frontend/images/Spin.gif') }}" alt=""/> <span>Load More...</span></div>
  </div>



     </div>

   </div>
  @endsection

  @section('script')
  <script src="{{ asset('frontend/js/jquery.countdown.js') }}"></script>
  <script type="text/javascript">

    $( ".timeCounter" ).each(function( index ) {
      var ths = $(this);
      var date = ths.attr('data-time');
      var newDate = new Date(); 
      newDate = new Date(date); 
      ths.countdown(newDate, function(event) {
        if(event.strftime('%D') === '00')
        {
          ths.text(
            event.strftime('%H:%M:%S')
          ); 
          ths.parent('h5').addClass('timer date-red');
          ths.parent('h5').removeClass('location');
          ths.parent().parent().parent().find('.dates').addClass('date-red');
        }

        if(event.strftime('%H:%M:%S') === '00:00:00')
        {
          ths.text('Started'); 
          ths.parent().find('i').addClass('fa fa-hourglass-start');
          ths.parent().find('i').removeClass('fa-clock-o');
          ths.parent('h5').removeClass('date-red');
        }      
      });
    });

 // $(document).on('click','.loadings', function(){
 //      event_load();

 // });


 $(window).scroll(function(){
    if ($(window).scrollTop() == $(document).height() - $(window).height()){
        event_load();
    }
});

 function event_load()
 {

  var ths     = $('.loadings');
  var offset  = ths.attr('data-offset');
  var event   = ths.attr('data-event');
  var newOffset = parseInt(offset) + {{ $limit }};
     $.ajax({
      'type'  : 'POST',
      'data'  : {offset: offset, event: event},
      'url' : BASE_URL+'/event_ajax_list',
      'beforeSend': function(){
      },
      'success': function(msg){
        if(msg == 0)
        {
            ths.hide();
        }
        else
        {
          $('.event_section').append(msg);        
        }
        
        ths.attr('data-offset', newOffset);


        $( ".timeCounter" ).each(function( index ) {
          var ths = $(this);
          var date = ths.attr('data-time');
          var newDate = new Date(); 
          newDate = new Date(date); 
          ths.countdown(newDate, function(event) {
            if(event.strftime('%D') === '00')
            {
              ths.text(
                event.strftime('%H:%M:%S')
              ); 
              ths.parent('h5').addClass('timer date-red');
              ths.parent('h5').removeClass('location');
              ths.parent().parent().parent().find('.dates').addClass('date-red');
            }

            if(event.strftime('%H:%M:%S') === '00:00:00')
            {
              ths.text('Started'); 
              ths.parent().find('i').addClass('fa fa-hourglass-start');
              ths.parent().find('i').removeClass('fa-clock-o');
              ths.parent('h5').removeClass('date-red');
            }      
          });
        });

      }

   });

 }


  </script>

  @endsection
