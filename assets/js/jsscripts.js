  
$(function(){
  
$(document).on('keyup keypress', 'form input[type="text"]', function(e) {
if(e.which == 13) {
e.preventDefault();
return false;
}
});

if(!ace.vars['touch']) {
    $('.chosen-select').chosen({allow_single_deselect:true}); 

    $('.mask-phoneNo').mask('254-799-999-999');
    //resize the chosen on window resize
            
                    $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function() {
                        $('.chosen-select').each(function() {
                             var $this = $(this);
                             $this.next().css({'width': $this.parent().width()});
                        })
                    }).trigger('resize.chosen');
                    //resize chosen on sidebar collapse/expand
                    $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                        if(event_name != 'sidebar_collapsed') return;
                        $('.chosen-select').each(function() {
                             var $this = $(this);
                             $this.next().css({'width': $this.parent().width()});
                        })
                    });
            
            
                    
                }
	  
          $('.date-picker').datepicker({
                    autoclose: true,
                    format: 'DD-MM-YYYY',
                    todayHighlight: true
                })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });


 // Disble Submit after Clicking
/*$("form").submit(function () {
  if ($(this).valid()) { // in case you have some validation
$("*").css("cursor", "wait"); // in case you want to show a waiting cursor after submit
    $(this).find(":submit").prop('disabled', true);
    $(this).find(":submit").html("<i class='fa fa-spinner fa-pulse'></i> Please wait..."); 
  }
});*/

 // jQuery plugin to prevent double submission of forms
        jQuery.fn.preventDoubleSubmission = function () {
            $(this).on('submit', function (e) {
                var $form = $(this);
           
                if ($form.data('submitted') === true) {
                    // Previously submitted - don't submit again
                    alert('Data already submitted. Please wait.');
                    e.preventDefault();
                } else {
                    // Mark it so that the next submit can be ignored
                    // ADDED requirement that form be valid
                    if($form.valid()) {
                        $(this).find(":submit").prop('disabled', true);
                       $(this).find(":submit").html("<i class='fa fa-spinner fa-pulse'></i> Please wait..."); 
                        $form.data('submitted', true);
                    }
                }
            });

            // Keep chainability
            return this;
        };
  $('form').preventDoubleSubmission();

/* End Form Submission */

$(".NumberOnly").keydown(function (e) {
if (e.shiftKey) e.preventDefault();
else {
var nKeyCode = e.keyCode;
//Ignore Backspace and Tab keys
if (nKeyCode == 8 || nKeyCode == 9) return;
if (nKeyCode < 95) {
    if (nKeyCode < 48 || nKeyCode > 57) e.preventDefault();
} else {
    if (nKeyCode < 96 || nKeyCode > 105) e.preventDefault();
}
}
});



 

});