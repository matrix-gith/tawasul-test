<div class="top-wrapper">
     <div class="container">
      <div class="row">
        <div class="col-sm-3">
           <div class="logo">
             <a href="{{ URL::Route('home') }}"><img src="{{ asset('frontend/images/logo.png') }}" alt=""></a>
           </div>
        </div>
        <div class="col-sm-9">

          <div class="lang">
            <ul>
              <!--
                <li>/</li>-->
                <li class="active"><a href="#"><img src="{{ asset('frontend/images/flag1.jpg') }}" alt=""/> عربي </a></li>
            </ul>
          </div>

          <div class="top-nav">
            <ul>
              <li><a href="{{ URL::Route('home') }}">Home</a></li>
              <li><a href="{{ URL::Route('user_logout') }}">Logout</a></li>
            </ul>
          </div>

          <div class="notification-div dropdown">
            <span class="noti-icon dropdown-toggle" id="notific" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-bell" aria-hidden="true"></i></span>
            <div class="dropdown-menu" aria-labelledby="notific">
              <div class="notific-top">
                <p>Notification</p>
              </div>
              <div class="notific-cont">
               <div class="notific-cont-single">
                 <div class="notific-img-user"><img src="{{ asset('frontend/images/followers-1.jpg') }}" alt=""></div>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                 <p class="posted-time"><i class="fa fa-calendar" aria-hidden="true"></i> Yesterday at 1.36pm</p>
               </div>
               <div class="notific-cont-single">
                 <div class="notific-img-user"><img src="{{ asset('frontend/images/followers-2.jpg') }}" alt=""></div>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                 <p class="posted-time"><i class="fa fa-calendar" aria-hidden="true"></i> Yesterday at 1.36pm</p>
               </div>
               <div class="notific-cont-single">
                 <div class="notific-img-user"><img src="{{ asset('frontend/images/followers-3.jpg') }}" alt=""></div>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                 <p class="posted-time"><i class="fa fa-calendar" aria-hidden="true"></i> Yesterday at 1.36pm</p>
               </div>
               <div class="notific-cont-single">
                 <div class="notific-img-user"><img src="{{ asset('frontend/images/followers-4.jpg') }}" alt=""></div>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                 <p class="posted-time"><i class="fa fa-calendar" aria-hidden="true"></i> Yesterday at 1.36pm</p>
               </div>
               <div class="notific-cont-single">
                 <div class="notific-img-user"><img src="{{ asset('frontend/images/followers-5.jpg') }}" alt=""></div>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                 <p class="posted-time"><i class="fa fa-calendar" aria-hidden="true"></i> Yesterday at 1.36pm</p>
               </div>
               <div class="notific-cont-single">
                 <div class="notific-img-user"><img src="{{ asset('frontend/images/followers-6.jpg') }}" alt=""></div>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                 <p class="posted-time"><i class="fa fa-calendar" aria-hidden="true"></i> Yesterday at 1.36pm</p>
               </div>
              </div>
              <div class="notific-bottom text-center"><a href="#">View All</a></div>
            </div>
          </div>

          <div class="search-part">
          <div id="sb-search" class="sb-search">
            <form>
              <input class="sb-search-input" placeholder="Search..." type="text" value="" name="search" id="search">
              <input class="sb-search-submit" type="submit" value="">
              <span class="sb-icon-search"></span>
            </form>
          </div>
          </div>

        </div>
      </div>
     </div>
   </div>