/* Send interest */

$(document).on("click", '.send_interest', function(){

    $this = $(this);
   const _token = $('meta[name="csrf-token"]').attr('content');
         let  send_interest = $(this).attr("send_interest");
         let  send_interest_url = $(".send_interest_url").attr("data-url");
         $.LoadingOverlay("show");
   jQuery.ajax({
       url: send_interest_url,
       type: "POST",
       data: { send_interest:send_interest, _token: _token},
       success: function (data, textStatus, xhr) {
         $.LoadingOverlay("hide");
         if(data.success){
           toastr.success(data.message, 'Success');

       if(data.data.type == "added"){

         $this.addClass('remove_interest');
         $this.removeClass('send_interest');
         $this.html('<i class="fas fa-heart"></i> Remove Interest');
       }
       

     }
     else{

       toastr.error('Opps....', data.message);
   

     }
       },
       error: function (xhr, textStatus, errorThrown) {
         toastr.error('Error', textStatus);
       $.LoadingOverlay("hide");
     }
     });
}); 


/* remove interest */

$(document).on("click", '.remove_interest', function(){

$this = $(this);
const _token = $('meta[name="csrf-token"]').attr('content');
    let  send_interest = $(this).attr("send_interest");
    let  send_interest_url = $(".remove_interest_url").attr("data-url");
    $.LoadingOverlay("show");
jQuery.ajax({
  url: send_interest_url,
  type: "POST",
  data: { send_interest:send_interest, _token: _token},
  success: function (data, textStatus, xhr) {
    $.LoadingOverlay("hide");
    if(data.success){
      toastr.success(data.message, 'Success');

  if(data.data.type == "removed"){
         $this.removeClass('remove_interest');
         $this.addClass('send_interest');
    $this.html('<i class="fas fa-heart"></i> Send Interest');
  }
  
}
else{

  toastr.error('Opps....', data.message);


}
  },
  error: function (xhr, textStatus, errorThrown) {
    toastr.error('Error', textStatus);
  $.LoadingOverlay("hide");
}
});
}); 

/* Accept interest */
  $(document).on("click", '.accept_interest', function(){
  
  $this = $(this);
  const _token = $('meta[name="csrf-token"]').attr('content');
      let  sender_id = $(this).attr("sender_id");
      let  accept_interest_url = $(".accept_interest_url").attr("data-url");
      $.LoadingOverlay("show");
  jQuery.ajax({
    url: accept_interest_url,
    type: "POST",
    data: { sender_id:sender_id, _token: _token},
    success: function (data, textStatus, xhr) {
      $.LoadingOverlay("hide");
      if(data.success){
        toastr.success(data.message, 'Success');
  
    if(data.data.type == "accepted"){
           $this.removeClass('accept_interest');
           
      $this.html('<i class="fas fa-heart"></i> Accepted');
    }
    
  }
  else{
  
    toastr.error('Opps....', data.message);
  
  
  }
    },
    error: function (xhr, textStatus, errorThrown) {
      toastr.error('Error', textStatus);
    $.LoadingOverlay("hide");
  }
  });
  }); 




/* shortlist */

$(document).on("click", '.shortlist', function(){

    $this = $(this);
   const _token = $('meta[name="csrf-token"]').attr('content');
         let  send_shortlist = $(this).attr("shortlist");
         let  send_shortlist_url = $(".shortlist_url").attr("data-url");
        
         $.LoadingOverlay("show");
 jQuery.ajax({
       url: send_shortlist_url,
       type: "POST",
       data: { send_shortlist:send_shortlist, _token: _token},
       success: function (data, textStatus, xhr) {
       
         $.LoadingOverlay("hide");
         if(data.success){
           toastr.success(data.message, 'Success');

       if(data.data.type == "added"){

         $this.html('<i class="far fa-star"></i> Remove Shortlisted');
       }
       else if(data.data.type == "removed"){
         $this.html('<i class="far fa-star"></i>Add to Shortlist');
       }


     }
     else{

       toastr.error('Opps....', data.message);
   

     }
       },
       error: function (xhr, textStatus, errorThrown) {
         toastr.error('Error', textStatus);
       $.LoadingOverlay("hide");
     }
}); 


}); 





/* District list */

$('#state_list').change(function (e) { 
  e.preventDefault();
  
  $this = $(this);

   const _token = $('meta[name="csrf-token"]').attr('content');
         let state_id = $this.val();
        
         let  get_district_url = $(".get_district_url").attr("data-url");


  $.ajax({
    type: "post",
    url: get_district_url,
    data: {state_id:state_id,_token:_token},
   
    success: function (data) {
      console.log(data.length);
      let options = '<option value="">Select District</option>';
      for (const key in data) {
        if (data.hasOwnProperty(key)) {
          
          options+= '<option value="'+data[key].id+'">'+data[key].name+'</option>';
          
        }
      }

   $("#district").html(options);
    }
  });
  
});



/* set preference */




$(document).on("submit", '.preference-form', function(e){

  $this = $(this);
 
       let  set_preference_url = $(".set_preference_url").attr("data-url");
     // console.log($this.serialize());
       $.LoadingOverlay("show");
jQuery.ajax({
     url: set_preference_url,
     type: "post",
     data: $this.serialize(),
     success: function (data, textStatus, xhr) {
     
       $.LoadingOverlay("hide");
       if(data.success){
         toastr.success(data.message, 'Success');



   }
   else{

     toastr.error('Opps....', data.message);
 

   }
     },
     error: function (xhr, textStatus, errorThrown) {
       toastr.error('Error', textStatus);
     $.LoadingOverlay("hide");
   }
}); 

e.preventDefault();
}); 



/* update Profile */


$(document).on("submit", '.uodate_profile', function(e){

  $this = $(this);
  $form = $this.attr('data');
       let  update_profile_url = $(".update_profile_url").attr("data-url");
     // console.log($this.serialize());
       $.LoadingOverlay("show");
jQuery.ajax({
     url: update_profile_url,
     type: "post",
     data: $this.serialize()+'&form='+$form,
     success: function (data, textStatus, xhr) {
     
       $.LoadingOverlay("hide");
       if(data.success){
         toastr.success(data.message, 'Success');

   }
   else{

     toastr.error('Opps....', data.message);

   }
     },
     error: function (xhr, textStatus, errorThrown) {
       toastr.error('Error', textStatus);
     $.LoadingOverlay("hide");
   }
}); 

e.preventDefault();
}); 
    
    
    /* viewphotoalbhum */

$(document).on("click", '.viewphotoalbhum', function(){
 // $('#myModal').modal('show');
    $this = $(this);
   const _token = $('meta[name="csrf-token"]').attr('content');
         let  id = $(this).attr("data-id");
        let  viewalbum_url = $(".viewalbum_url").attr("data-url");
       //  $.LoadingOverlay("show");
   jQuery.ajax({
       url: viewalbum_url,
       type: "POST",
       data: { user_id:id, _token: _token},
       success: function (data, textStatus, xhr) {
      //   $.LoadingOverlay("hide");
        
          $("#AlbumResponse").html(data);
       },
       error: function (xhr, textStatus, errorThrown) {
         toastr.error('Error', textStatus);
      // $.LoadingOverlay("hide");
     }
     });
}); 


