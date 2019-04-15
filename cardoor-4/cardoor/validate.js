$(document).ready(function() {
	// your js code goes here...

var email = $('#email').val();
var password = $('#password').val();

//Expression that should be matched to the username and email
var emailReg = /([\w\-]+\@[\w\-]+\.[\w\-]+)/;

$('span').hide();


// Email Validation
$('#email').focus(function() {
  $("#em").hide();
	$('#email').after('<span id="em" class = info> Email should contain @ character.<span>')

});

$('#email').blur(function() {
    if($("#email").val().length==0){
	   $('#em').hide();
}
    if(emailReg.test($(this).val()))
      {$("#em").hide();
      
    }
    else{
      $("#em").hide();
      $('#email').after('<span id="em" class = error> Email should contain @ !! <span>')
    }
});


});
