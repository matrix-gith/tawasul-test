@extends('front.layout.group_app')
@section('title','Tawasul')
@section('content')

   <div class="home-container">
     <div class="container">
     @include('front.includes.group_slidemenu')
 	 @include('front.includes.group_header')     
<style>
.wrapper > ul#results li {
  margin-bottom: 1px;
  background: #f9f9f9;
  padding: 20px;
  list-style: none;
}
.ajax-loading{
  text-align: center;
}
</style>
       <div id="exTab2">
			<div class="tab-content cal-con grop-time ">
			  <div class="tab-pane active">
                <div class="row" id="results">

        
        @include('front.groups.data_group')


        </div>
		</div>

		</div>
      <div class="loadings ajax-loading"><img src="{{ asset('frontend/images/Spin.gif') }}" alt=""/> <span>Load More...</span></div>
  </div>

    

   <div class="modal fade" id="uploadphoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content alt">
      <div class="modal-body">
        <button type="button" class="close alt" data-dismiss="modal" aria-label="Close"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
        <div class="row">
          <div class="col-sm-12">
            <h2><i class="fa fa-users" aria-hidden="true"></i> Create Group</h2>
  <form action="/action_page.php">
    <div class="form-group">
      <label for="title">Group Name:</label>
      <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
      <label for="pwd">Upload Group Banner Image:</label>
      <input type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple>
    </div>

    <div class="form-group">
      <label for="title">Group Description:</label>
      <input type="text" class="form-control" id="title" name="title">
    </div>

    <div class="form-group">
  <label for="sel1">Select list:</label>
  <div class="form-select">
  <div class="arrow" for="sel1"><i class="fa fa-angle-down" aria-hidden="true"></i></div>
  <select class="form-control" id="sel1">
    <option>All Group</option>
    <option>All Group2</option>
    <option>All Group 3</option>
    <option>All Group 4</option>
  </select>
  </div>
   </div>


   <div class="clearfix"></div>
    <div class="form-sub">
    <input type="submit" value="Create"/> <i class="fa fa-check-circle" aria-hidden="true"></i></i>
    </div>
  </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

	<a id="back-to-top" href="#" class="back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><i class="fa fa-angle-up" aria-hidden="true"></i></a>

<script>
var page = 1; //track user scroll as page number, right now page number is 1
load_more(page); //initial content load
$(window).scroll(function() { //detect page scroll
 
    if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page      
        page++; //page number increment
        load_more(page); //load content   
    }
});     
function load_more(page){
  $.ajax( 
        { 
            url: '?page=' + page,
            type: "get",
            datatype: "html",
            beforeSend: function()
            {              
                $('.ajax-loading').show();
            }
        })
        .done(function(data)
        {
            if(data.length == 0){
            console.log(data.length);
               
                //notify user if nothing to load
                $('.ajax-loading').html("No more records!");
                return;
            }
            $('.ajax-loading').hide(); //hide loading animation once data is received
            $("#results").append(data); //append data into #results element          
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              alert('No response from server');
        });
 }
</script>
   
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
   $('.panel').on('click', function() {
   $('.slidemenu').toggleClass('clicked').addClass('unclicked');
   $('.menubar_icon_black').toggleClass('menubar_icon_cross');
});
});
   </script>


   
    @endsection
 
