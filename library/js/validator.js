// as the page loads, call these scripts
jQuery(document).ready(function($) {

	//var validator = $("#post").validate();
	//validator.element( "#fyn_postalcode" );

	$( "#post" ).validate({
		debug:true,
		  rules: {
		    fyn_postalcode: {
		      required: true
		    }
		  },
		invalidHandler: function(event, validator) {
    // 'this' refers to the form
    var errors = validator.numberOfInvalids();
    if (errors) {
      var message = errors == 1
        ? 'You missed 1 field. It has been highlighted'
        : 'You missed ' + errors + ' fields. They have been highlighted';
      $("div.error span").html(message);
      $("div.error").show();
    } else {
      $("div.error").hide();
    }
  }
	});
	
});