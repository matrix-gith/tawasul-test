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