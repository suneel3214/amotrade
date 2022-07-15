$(document).ready(function(){
	$('body').delegate('.prfviewnotvalidfrm','submit',function(){
		return false;
	});
	$('body').delegate('.prfviewnotvalidfrm input[type="button"]','click',function(){
		var invalidreason=$('[name="invalidreason"]');
		var thisform=$(this).closest('form');
		$('.prfviewnotvalidact').html('');
		if(invalidreason.val()=="")
		{
			$('.prfviewnotvalidact').html("<div class='alert alert-danger'>Please select reason</div>");
		}
		else
		{
			$('.prfviewnotvalidact').html("<div class='alert alert-warning'>Please wait while updating your information</div>");
			
			$.ajax({

			   url: './includes/prfviewnotvalidfrm.php',

			   data: thisform.serialize(),

			   error: function() {

				  $('.prfviewnotvalidact').html("<div class='alert alert-success'>Thanks for update your information</div>");
				  $(invalidreason).find('option:first').prop('selected',true);

			   },

			   dataType: 'json',

			   success: function(data) {
				   
				   $('.prfviewnotvalidact').html("<div class='alert alert-success'>Thanks for update your information</div>");
				   $(invalidreason).find('option:first').prop('selected',true);

			   },

			   type: 'POST'

			});
		}
		return false;
	});
	$(".phoneformat").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
       // $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
	else
	{
		
		if($(this).val().length<2)
		{
			if(e.key<7)
			{
				return false;
			}
		}
	}
   });
});