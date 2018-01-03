 @if(count($groups)>0)
         @foreach ($groups as $group)       	
        {{ $group->group_name }}

          <?php $group_id = base64_encode($group->group_user_id + 100);?>
         <div class="col-sm-4 col-xs-6">
           <div class="photo-single group-areas">
             <div class="group-img">
                <a href="{{URL::Route('group_details').'/'.$group_id}}"><img src="{{ asset('uploads/group_images/').'/'.$group->cover_image }}" alt="" class="big-img"/></a>
                @if(request()->segment(2)!=''&& request()->segment(2)!='all')
                 <img src="{{ asset('frontend/images/sg-1.jpg')}}" alt="" class="small-img"/> 
                @endif
             </div>
             <h3><a href="{{URL::Route('group_details').'/'.$group_id}}">{{ $group->group_name }}</a></h3>
             <h5>{{ get_memeber_group( $group->group_user_id) }} members</h5>
             <p>{{ $group->group_description }}</p>
             <span class="week-active">Active {{ active_memeber_group($group->created_at) }} ago / <label>{{ ucwords($group_type)}} Group</label></span>
           </div>
         </div>
       
         @endforeach
         @endif