<div class="top-backs">
       <div class="timeline-photo">
         <img src="{{ asset('frontend/images/timeline-photo.jpg') }}" alt="">
         <div class="timeline-cont">
           <div class="row">
             <div class="col-sm-8">
               <div class="timeline-profile">
                 <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                 <h2>Mahendra Kakumanu</h2>
                 <p>@Mahendra.k</p>
               </div>
             </div>
             <div class="col-sm-4">@if(request()->segment(2)!=''&& request()->segment(2)!='all')
             
                <div class="followmenu dropdown">
                 <button class="dropdown-toggle" type="button" id="followT" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Following <span class="caret"></span></button>
                 <ul class="dropdown-menu" aria-labelledby="followT">
                   <li><a href="#">Unfollow</a></li>
                 </ul>
               </div> 
               @endif
             </div>
           </div>
         </div>
       </div>

	   <div class="fixme">

       <div class="timeline-nav clearfix">
         <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                    <div class="main-menu">
                        <div id="header_menu">
                            <img src="images/logo.png" alt="" data-retina="true">
                        </div>
                        <a href="#" class="open_close" id="close_in"><i class="fa fa-times" aria-hidden="true"></i></a>

                        <ul>
                          <li><a href="home.html">News Feed </a></li>
                          <li><a href="global-general-events.html">Events</a></li>
                          <li><a href="user-directory2.html">Employee Directory </a></li>
                          <li class="active"><a href="{{ URL::Route('group') }}">Group</a></li>
                          <li><a href="occasions.html">Occasions</a></li>
                        </ul>
                        </div><!-- End main-menu -->
                         <label class="fileContainer">
                        <a href="create-group.html">Own Group </a> 
                      </label>
                         <?php   $role = Auth::user()->hasRole('default-user'); $add_permission_actv_grp = Auth::user()->can('add-activity-group'); $add_permission_global_grp = Auth::user()->can('add-global-group');$add_permission_dept_grp = Auth::user()->can('add-departmental-group'); ?>
                        @if($role==1 && ($add_permission_actv_grp==1 || $add_permission_dept_grp==1 || $add_permission_global_grp==1))
                       <label class="fileContainer">
                  	    <a href="{{ URL::Route('group_add') }}">Create Group </a> 
              		    </label>
                       @endif
                       
       </div>
       </div>

       </div>