@extends('front.layout.app')
@section('title','Tawasul')
@section('content')


<div class="home-container">
     <div class="container">
       <div class="row">

         <div class="col-lg-3 col-sm-4">
           <div class="left-sidebar">
             <div class="profile-image-block">
               <div class="profile-image"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
               <h2>Shabber</h2>
               <p>Application Developer <br> Information Technology</p>
             </div>
             <div class="side-nav">
               <ul>
                 <li class="active"><a href="home.html"><i class="fa fa-user" aria-hidden="true"></i> News feed</a></li>
                 <li><a href="global-general-events.html"><i class="fa fa-calendar" aria-hidden="true"></i> Events</a></li>
                 <li><a href="user-directory2.html"><i class="fa fa-handshake-o" aria-hidden="true"></i> Employee Directory</a></li>
                 <li><a href="group-timeline.html"><i class="fa fa-users" aria-hidden="true"></i> Groups</a></li>
                 <li><a href="occasions.html"><i class="fa fa-sign-language" aria-hidden="true"></i> Occasions</a></li>
               </ul>
             </div>
           </div>
         </div>

         <div class="col-lg-6 col-sm-5">
           <div class="post-timeline">
             <textarea placeholder="What's in your mind today?" name="name"></textarea>
             <div class="post-bar">
               <div class="row">
                 <div class="col-sm-6">
                   <ul class="nav-varient">
                     <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
                   </ul>
                 </div>
                 <div class="col-sm-6">
                   <div class="pull-right">
                     <input type="submit" name="" value="Post">
                   </div>
                 </div>
               </div>
             </div>
           </div>

           <div class="timeline-blockMain">

           <div class="timelineBlock eventblock">
               <div class="time-postedBy">
                 <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                 <h2>Mahendra Kakumanu</h2>
                 <p>Shared publicly - 7.30 PM Today</p>
               </div>
               <div class="postedTime-image">
                 <img src="{{ asset('frontend/images/timeline-photo.jpg') }}" alt="">
               </div>

               <div class="likeComment learn">
               <div class="row">
                   <div class="col-sm-12">

                     <div class="eve-area">
                     <div class="dates"><span>Jan</span> 26</div>
                     <div class="eve-right">
                     <h3><a href="event-details.html">Event Name</a></h3>
                     <h5 class="location"><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00 AM, Tue 26 Jan</h5>
                     <h5 class="location"><i class="fa fa-map-marker"></i>Corner Cross and Hocking...</h5>
                     </div>

                     <div class="btn-right">
                       <a href="#" class="go">Attending</a>
                       <a href="#" class="not_go">Not Attending</a>
                       <a href="#" class="not_go">Tentative</a>
                     </div>


                     </div>

                 </div>


                 </div>
               </div>

             </div>


           <div class="timelineBlock groupblock">
               <div class="time-postedBy">
                 <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                 <h2>Mahendra Kakumanu</h2>
                 <p>Shared publicly - 7.30 PM Today</p>
               </div>
               <div class="postedTime-image">
                 <img src="{{ asset('frontend/images/group-banner.jpg') }}" alt="">
               </div>

               <div class="likeComment learn">
               <div class="row">
                 <div class="col-sm-12 col-lg-9">

                 <p>A new <strong>Group Name</strong> has been published</p>
                 </div>
                   <div class="col-sm-12 col-lg-3">
                   <a href="group.html" class="view_all pull-right"> Learn More</a>
                   </div>
                 </div>
               </div>

             </div>


      <div class="timelineBlock">

               <div class="time-postedBy">
                 <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                 <h2>Human Capital</h2>
                 <p>Shared publicly - 7.30 PM Today</p>
               </div>
               <div class="postedTime-image">
                 <h2>HR Announcement to Lorem ipsum dolor sit amet.</h2>
               </div>
               <div class="likeComment">
                 <div class="row">
                   <div class="col-sm-12 col-md-6 col-lg-4">
                     <button class="face-like" type="button" name="button"><i class="fa fa-share" aria-hidden="true"></i> Share</button>
                     <button class="face-like" type="button" name="button"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Like</button>
                   </div>
                   <div class="col-sm-12 col-md-6 col-lg-8">
                     <p>127 Likes - <a href="javascript:void(0);" class="user-com" data-target="1">3 Comments</a></p>
                   </div>
                 </div>
               </div>
               <div class="comment-other" id="comment_1">
                 <div class="comment-other-single">
                   <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                   <h2>Albert Velian <span>8.03 PM Today</span></h2>
                   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                 </div>

               </div>
               <div class="comment-field">
                 <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                 <textarea name="name" placeholder="Press Enter to post comment"></textarea>
               </div>
             </div>



             <div class="timelineBlock">
               <div class="time-postedBy">
                 <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                 <h2>Mahendra Kakumanu</h2>
                 <p>Shared publicly - 7.30 PM Today</p>
               </div>
               <div class="postedTime-image">
                 <img src="{{ asset('frontend/images/post-img.jpg') }}" alt="">
                 <p class="padding">Our new datacenter!! You are welcome to have a tour of it!</p>
               </div>
               <div class="likeComment">
                 <div class="row">
                   <div class="col-sm-12 col-md-6 col-lg-4">
                     <button class="face-like" type="button" name="button"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Like</button>
                   </div>
                   <div class="col-sm-12 col-md-6 col-lg-8">
                     <p>127 Likes - <a href="javascript:void(0);" class="user-com" data-target="2">3 Comments</a></p>
                   </div>
                 </div>
               </div>
               <div class="comment-other" id="comment_2">
                 <div class="comment-other-single">
                   <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                   <h2>Albert Velian <span>8.03 PM Today</span></h2>
                   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                 </div>

               </div>
               <div class="comment-field">
                 <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                 <textarea name="name" placeholder="Press Enter to post comment"></textarea>
               </div>
             </div>

             <div class="timelineBlock">

               <div class="time-postedBy">
                 <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                 <h2>Mahendra Kakumanu</h2>
                 <p>Shared publicly - 7.30 PM Today</p>
               </div>
               <div class="postedTime-image">
                 <h2>Our new datacenter!! You are welcome to have a tour of it!</h2>
               </div>
               <div class="likeComment">
                 <div class="row">
                   <div class="col-sm-12 col-md-6 col-lg-4">
                     <button class="face-like" type="button" name="button"><i class="fa fa-share" aria-hidden="true"></i> Share</button>
                     <button class="face-like" type="button" name="button"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Like</button>
                   </div>
                   <div class="col-sm-12 col-md-6 col-lg-8">
                     <p>127 Likes - <a href="javascript:void(0);" class="user-com" data-target="3">3 Comments</a></p>
                   </div>
                 </div>
               </div>
               <div class="comment-other" id="comment_3">
                 <div class="comment-other-single">
                   <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                   <h2>Albert Velian <span>8.03 PM Today</span></h2>
                   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                 </div>

               </div>
               <div class="comment-field">
                 <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                 <textarea name="name" placeholder="Press Enter to post comment"></textarea>
               </div>
             </div>

             <div class="timelineBlock">

               <div class="time-postedBy">
                 <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                 <h2>Mahendra Kakumanu</h2>
                 <p>Shared publicly - 7.30 PM Today</p>
               </div>
               <div class="postedTime-image">
                 <h2>Our new datacenter!! You are welcome to have a tour of it!</h2>
               </div>
               <div class="likeComment">
                 <div class="row">
                   <div class="col-sm-12 col-md-6 col-lg-4">
                     <button class="face-like" type="button" name="button"><i class="fa fa-share" aria-hidden="true"></i> Share</button>
                     <button class="face-like" type="button" name="button"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Like</button>
                   </div>
                   <div class="col-sm-12 col-md-6 col-lg-8">
                     <p>127 Likes - <a href="javascript:void(0);" class="user-com" data-target="4">3 Comments</a></p>
                   </div>
                 </div>
               </div>
               <div class="comment-other" id="comment_4">
                 <div class="comment-other-single">
                   <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                   <h2>Albert Velian <span>8.03 PM Today</span></h2>
                   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                 </div>

               </div>
               <div class="comment-field">
                 <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                 <textarea name="name" placeholder="Press Enter to post comment"></textarea>
               </div>
             </div>

           </div>

           <div class="loadings"><img src="{{ asset('frontend/images/Spin.gif') }}" alt=""/> <span>Load More...</span></div>


         </div>

        <div class="col-lg-3 col-sm-3">
          <div class="right-sidebar clearfix">
            <div class="recentUpdates">
             <h2>Recent Updates</h2>
             <div class="cont-wrap">
               <div class="cont-wrap-main">
                 <div class="recent-block">
                   <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                   <h3><a href="#">Jeesmon Steaphen</a> requested on <a href="#">IT help desk</a>. 5 min ago </h3>
                 </div>
                 <div class="recent-block">
                   <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                   <h3><a href="#">Jeesmon Steaphen</a> requested on <a href="#">IT help desk</a>. 5 min ago </h3>
                 </div>
                 <div class="recent-block">
                   <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                   <h3><a href="#">Jeesmon Steaphen</a> requested on <a href="#">IT help desk</a>. 5 min ago </h3>
                 </div>
                 <div class="recent-block">
                   <div class="image-div"><img src="{{ asset('frontend/images/avatar-male.jpg') }}" alt=""></div>
                   <h3><a href="#">Jeesmon Steaphen</a> requested on <a href="#">IT help desk</a>. 5 min ago </h3>
                 </div>
               </div>
             </div>
             <div class="btn_view"><a href="#" class="view_all"><i class="fa fa-eye"></i> View All</a></div>
            </div>
            <div class="recentUpdates group">
             <h2>My Groups</h2>
             <div class="cont-wrap">
               <div class="cont-wrap-main">
                 <div class="recent-block">
                   <div class="image-div"><img src="{{ asset('frontend/images/html5.png') }}" alt=""></div>
                   <h4>HR Group</h4>
                 </div>
                 <div class="recent-block">
                   <div class="image-div"><img src="{{ asset('frontend/images/css3.png') }}" alt=""></div>
                   <h4>CEO Group</h4>
                 </div>
                 <div class="recent-block">
                   <div class="image-div"><img src="{{ asset('frontend/images/git-logo.png') }}" alt=""></div>
                   <h4>IT Group</h4>
                 </div>
               </div>

              </div>
              <div class="btn_view"><a href="group-timeline.html" class="view_all"><i class="fa fa-eye"></i> View All</a></div>

            </div>


            <div class="recentUpdates group occasion" id="rsidebar">
             <h2>Occasions</h2>
             <div class="cont-wrap">
               <div class="cont-wrap-main">

                 <div id="scrollbar1" class="custom-scroll">
               <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
               <div class="viewport">
                   <div class="overview">

                 <div class="recent-block">
                   <div class="image-div"><img src="{{ asset('frontend/images/friend-1.jpg') }}" alt=""></div>
                   <h4>Mahendra Kakumanu <br> <span>IT Manager</span></h4>
                   <p>Having Birthday</p>
                   <div class="emailPop"><a href="#" data-toggle="modal" data-target="#occasions"><img src="{{ asset('frontend/images/b-1.png') }}" alt=""></a></div>
                 </div>
                 <div class="recent-block">
                   <div class="image-div"><img src="{{ asset('frontend/images/friend-3.jpg') }}" alt=""></div>
                   <h4>Mahendra Kakumanu <br> <span>IT Manager</span></h4>
                   <p>completed 2 years</p>
                   <div class="emailPop spop"><a href="#" data-toggle="modal" data-target="#occasionsII"><img src="{{ asset('frontend/images/b-2.png') }}" alt=""></a></div>
                 </div>
                 <div class="recent-block">
                   <div class="image-div"><img src="{{ asset('frontend/images/friend-4.jpg') }}" alt=""></div>
                   <h4>Mahendra Kakumanu <br> <span>IT Manager</span></h4>
                   <p>Having Birthday</p>
                   <div class="emailPop"><a href="#" data-toggle="modal" data-target="#occasions"><img src="{{ asset('frontend/images/b-1.png') }}" alt=""></a></div>
                 </div>

                 <div class="recent-block">
                   <div class="image-div"><img src="{{ asset('frontend/images/friend-5.jpg') }}" alt=""></div>
                   <h4>Mahendra Kakumanu <br> <span>IT Manager</span></h4>
                   <p>Having Birthday</p>
                   <div class="emailPop"><a href="#" data-toggle="modal" data-target="#occasions"><img src="{{ asset('frontend/images/b-1.png') }}" alt=""></a></div>
                 </div>

                 </div>
                 </div>
                 </div>

               </div>

              </div>
              <div class="btn_view"><a href="occasions.html" class="view_all"><i class="fa fa-eye"></i> View All</a></div>

            </div>


          </div>
        </div>

       </div>
     </div>
   </div>

   @endsection
