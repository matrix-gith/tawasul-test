 <div class="side-nav1 slidemenu">
         <button class="left_slide_btn panel"> <span class="menubar_icon_black" style="display: block;"> </span></button>
           <ul>
               <li>
                 <a href="{{ URL::Route('group') }}/all">
                 <img src="{{ asset('frontend/images/ic6.png') }}" alt=""/>
                 <span>All Group</span>
               </a>
               </li>
               <li>
                 <a href="{{ URL::Route('group') }}/global">
                 <img src="{{ asset('frontend/images/ic7.png') }}" alt=""/>
                 <span>Global</span>
               </a>
               </li>
               <li>
                 <a href="{{ URL::Route('group') }}/departmental">
                 <img src="{{ asset('frontend/images/ic8.png') }}" alt=""/>
                 <span>Departmental</span>
               </a>
               </li>
               <li>
                 <a href="{{ URL::Route('group') }}/activity">
                 <img src="{{ asset('frontend/images/ic9.png') }}" alt=""/>
                 <span>Other</span>
               </a>
               </li>

           </ul>
       </div>