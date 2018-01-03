$(document).ready(function(){
	$('#country').change(function(){
		var id = $(this).val();
		$.ajax({
			'type'	: 'POST',
			'data' 	: {'_token':csrf_token, 'id': id},
			'url'	: base_url+'cities/ajax_statelist',
			'success': function(msg){
				$('#state').html(msg);
			}
		});
	});
 
	$('#company_logo').change(function(){

    var totalFile = this.files.length;
    for (var i = 0; i < totalFile; i++) {     
       
      		var fileInfo = this.files[i]; 
          var sizeKB = fileInfo.size / 1000;
          sizeKB  = sizeKB.toFixed(1);

      		var fileType = fileInfo["type"];
      		var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
      		if ($.inArray(fileType, ValidImageTypes) < 0) {

              $.alert({
                        title: 'Alert!',
                        content: 'Invalid File Type',
                        icon: 'fa fa-rocket',
                        type: 'blue',
                        animation: 'scale',
                        closeAnimation: 'scale',                            
                        animateFromElement: false,
                        buttons: {
                            okay: {
                            text: 'Okay',
                            btnClass: 'btn-blue'
                            }
                        }
                    });
      			  
      			    $(this).val('');
      		}

    }

	});

  $('#event_image').change(function(){

    var totalFile = this.files.length;
    for (var i = 0; i < totalFile; i++) {     
       
          var fileInfo = this.files[i]; 
          var sizeKB = fileInfo.size / 1000;
          sizeKB  = sizeKB.toFixed(1);
          if(sizeKB > 2048)
          {
            $.alert({
                        title: 'Alert!',
                        content: 'Uploaded image size maximum 2MB allowed',
                        icon: 'fa fa-rocket',
                        type: 'blue',
                        animation: 'scale',
                        closeAnimation: 'scale',                            
                        animateFromElement: false,
                        buttons: {
                            okay: {
                            text: 'Okay',
                            btnClass: 'btn-blue'
                            }
                        }
                    });


            $(this).val('');
            return false;
          }

          var fileType = fileInfo["type"];
          var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
          if ($.inArray(fileType, ValidImageTypes) < 0) {

                $.alert({
                        title: 'Alert!',
                        content: 'Invalid File Type',
                        icon: 'fa fa-rocket',
                        type: 'blue',
                        animation: 'scale',
                        closeAnimation: 'scale',                            
                        animateFromElement: false,
                        buttons: {
                            okay: {
                            text: 'Okay',
                            btnClass: 'btn-blue'
                            }
                        }
                    });

                $(this).val('');
                return false;
          }

    }

  });


 /////////////////// Event section ////////////////////

	$('#allday_event').change(function(){
		
		
		if($(this).is(':checked'))
		{
			$('#start_time').val('');
      $('#end_time').val('');
			$('#time_section').hide();
		}
		else
		{			
			$('#time_section').show();	
		}
	});


/////////// event Date ////////////////////////

var startDate = new Date();
var FromEndDate = new Date();
var ToEndDate = new Date();

  $('#event_start_date').datepicker({
    
    format: 'dd-mm-yyyy',
    startDate: startDate,
    autoclose: true
})
    .on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#event_end_date').datepicker('setStartDate', startDate);
    }); 

$('#event_end_date')
    .datepicker({
        
        format: 'dd-mm-yyyy',
        startDate: startDate,
        autoclose: true
    })
    .on('changeDate', function(selected){
        
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('#event_start_date').datepicker('setEndDate', FromEndDate);
    });

////////////////// Event Time  ///////////////////

	 $('.timepicker').timepicker({
	    timeFormat: 'h:mm p',
	    interval: 30,
	    //minTime: '10',
	    //maxTime: '6:00pm',
	    //defaultTime: '11',
	    //startTime: '10:00',
	    dynamic: false,
	    dropdown: true,
	    scrollbar: true
	});

});

/////////////////// End Event section ////////////////////

$('.status').click(function(){

    var id = $(this).attr('data-id');
    var model = $(this).attr('data-model');
    var ths = $(this);

    bootbox.confirm({
        message: "<h4>Are you sure to change this status?</h4>",
        buttons: {
            confirm: {
                label: '<i class="fa fa-check-circle"></i> Confirm',
                className: 'btn-success'
            },
            cancel: {
                label: '<i class="fa fa-times-circle"></i> Cancel',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if(result)
            {               
                $.ajax({
                  'type'  : 'POST',
                  'url' : base_url + 'statusChange',
                  'data'  : {'_token': csrf_token,'id':  id, model: model },
                  'success': function(msg){
                      ths.html(msg);
                  }
                });
            }
        }
    });      
   });


  ///////////// User Status Change ///////////////////////////

   $('.user_status').click(function(){
      var userId = $(this).attr('data-id');
      var ths = $(this);
      $.ajax({
        'type'  : 'POST',
        'url' : base_url + 'user_status',
        'data'  : {'_token': csrf_token,'user_id':  userId },
        'success': function(msg){
            ths.html(msg);
        }
      });
   });

   ///////////// End User Status Change ///////////////////////////

$(".form-validate").validate({
     rules: {             
       password_confirmation: {
        required: true,
        equalTo: "#password"
       }
     },     
 });

if($('.summernote').length>0)
{
	$('.summernote').summernote({
    height: 200,
  	toolbar: [
  	  ['style', ['bold', 'italic', 'underline', 'clear']],
  	  ['undoredobtn', ['undo','redo']],
  	  ['color', ['color']],
  	  ['para', ['ul', 'ol', 'paragraph']],
      ['codeview',['codeview']],
  	  ['fullscreen',['fullscreen']]
  	]
	});
}
    
function changeStatusData(ID, changeStatusURL)
{
    var thisUrl = changeStatusURL;
    thisUrl = thisUrl.replace('THIS', ID);

    bootbox.confirm({
        message: "<h4>Are you sure to change this record status?</h4>",
        buttons: {
            confirm: {
                label: '<i class="fa fa-check-circle"></i> Confirm',
                className: 'btn-success'
            },
            cancel: {
                label: '<i class="fa fa-times-circle"></i> Cancel',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if(result)
            {
                window.location.href = thisUrl;
            }
        }
    });
}
 
function destroyData(destroyURL)
{  
    bootbox.confirm({
        message: "<h4>Are you sure to delete this record?</h4>",
        buttons: {
            confirm: {
                label: '<i class="fa fa-check-circle"></i> Confirm',
                className: 'btn-success'
            },
            cancel: {
                label: '<i class="fa fa-times-circle"></i> Cancel',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if(result)
            {
                $('#frmDelete').attr('action', destroyURL);
                $('#frmDelete').submit();
            }
        }
    });            
}

      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        //autocomplete.addListener('place_changed', fillInAddress);
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }




////// This is for sitesetting section ////////////////////////



$(function(){

  $(".editLink").click(function(){
      var parent    = $(this).parents('tr');
      var dataId    = $(this).attr('data-id');
      var dataType  = $(this).attr('data-type');
      var label     = $(this).attr('data-label');
      var Text      = $(parent).find('.settingsContent').html();
      var html      = '';
      var editContent = $(parent).find('.settingsEditContent');
      $(editContent).empty();
      switch(dataType){
          case "TEXT":                  
                  $("<input />")
                    .attr('type','text')
                    .val(Text)
                    .attr('onkeypress','return (event.charCode != 44)')
                    .addClass('form-control')
                    .appendTo(editContent);
                 
          break;
          case "TEXTAREA":
                  $("<textarea />")
                    .val(Text)
                    .addClass('form-control summernote')
                    .appendTo(editContent);
          break;    
      }
          $('<br />')
            .appendTo(editContent);
          $('<button />')
            .addClass('btn btn-info btn-xs saveEditBtn')
            .text('Save')
            .appendTo(editContent);
          $("<span/>")
            .html('&nbsp;&nbsp;')
            .appendTo(editContent);
          $('<button />')
            .addClass('btn btn-default btn-xs cancelEditBtn')
            .text('Cancel')
            .appendTo(editContent);

          $("<span/>")
            .addClass('loaderEdit')
            .css('display','none')
            .css('color','#A7A1A1')
            .html("<i class='fa fa-cog fa-spin ' ></i> Please wait...")
            .appendTo(editContent);

      $(parent).find('.settingsContent').hide();
      $(parent).find('.editLink').hide();
      $(parent).find('.settingsEditContent').show();

      $(".cancelEditBtn").click(function(){
        var parent    = $(this).parents('tr');
        $(parent).find('.editLink').show();
        $(parent).find('.settingsEditContent').hide();
        $(parent).find('.settingsContent').show();
        
      })
      $(".saveEditBtn").click(function(){

          var parent    = $(this).parents('tr');
          var dataId    = $(parent).find('.editLink').attr('data-id');
          var label     = $(parent).find('.editLink').attr('data-label');
          var html      = $(parent).find('.settingsEditContent').find('input,textarea').val();

          if(label == 'Info_email'){         
              var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
              email = html.trim();
              if(!mailformat.test(email))
              {   
                parent.find('label').remove();         
                parent.find('input').after('<label style="color:red">Invalid Email</label>');
                return false;
              }
          }

          if(html){
             $.ajax({
                  url   : base_url+'sitesettings/edit',
                  type  : 'POST',
                  data  : {
                      '_token' : csrf_token,
                      'id'     : dataId,
                      'value'  : html.trim()
                  },
                  dataType : "JSON",
                  beforeSend: function(){
                      $(parent).find('.loaderEdit').show();
                  },
                  success:function(response){
                      $(parent).find('.loaderEdit').hide();
                      $(parent).find('.editLink').show();
                      $(parent).find('.settingsEditContent').hide();
                      $(parent).find('.settingsContent').html(html);
                      $(parent).find('.settingsContent').show();
                  }
              })
            }else{
              $(parent).find('.settingsEditContent').find('input,textarea').css('border','1px solid red');
            }
      })
  });
})

////// End sitesetting section ////////////////////////



