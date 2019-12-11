


$('document').ready(function(){

    var prc_id_state = false;
    var email_state = false;
    var contact_state = false;
    var birthdate_state = false;
    var school_state = false;


 $('#prc_id').on('blur', function(){
  var prc_id = $('#prc_id').val();
  if (prc_id == '') {
  	prc_id_state = false;
  	return;
  }
  $.ajax({
    url: 'signup2.php',
    type: 'post',
    data: {
    	'prc_id_check' : 1,
    	'prc_id' : prc_id,
    },
    success: function(response){
      if (response == 'taken' ) {
      	prc_id_state = false;
      	$('#prc_id').parent().removeClass();
      	$('#prc_id').parent().addClass("form_error");
      	$('#prc_id').siblings("span").text('Sorry... PRC ID already taken');
      }else if (response == 'not_taken') {
      	prc_id_state = true;
      	$('#prc_id').parent().removeClass();
      	$('#prc_id').parent().addClass("form_success");
      	$('#prc_id').siblings("span").text('PRC ID available');
      }
    }
  });
 });		

  $('#email').on('blur', function(){
 	var email = $('#email').val();
 	if (email == '') {
 		email_state = false;
 		return;
 	}
 	$.ajax({
      url: 'signup2.php',
      type: 'post',
      data: {
      	'email_check' : 1,
      	'email' : email,
      },
      success: function(response){
      	if (response == 'taken' ) {
          email_state = false;
          $('#email').parent().removeClass();
          $('#email').parent().addClass("form_error");
          $('#email').siblings("span").text('Sorry... Email already taken');
      	}else if (response == 'not_taken') {
      	  email_state = true;
      	  $('#email').parent().removeClass();
      	  $('#email').parent().addClass("form_success");
      	  $('#email').siblings("span").text('Email available');
      	}
      }
 	});
 });

  $('#contact').on('blur', function(){
 	var contact = $('#contact').val();
 	if (contact == '') {
 		contact_state = false;
 		return;
 	}
 	$.ajax({
      url: 'signup2.php',
      type: 'post',
      data: {
      	'contact_check' : 1,
      	'contact' : contact,
      },
      success: function(response){
      	if (response == 'taken' ) {
          contact_state = false;
          $('#contact').parent().removeClass();
          $('#contact').parent().addClass("form_error");
          $('#contact').siblings("span").text('Sorry... contact already taken');
      	}else if (response == 'not_taken') {
      	  contact_state = true;
      	  $('#contact').parent().removeClass();
      	  $('#contact').parent().addClass("form_success");
      	  $('#contact').siblings("span").text('contact available');
      	}
      }
 	});
 });

 
  $('#birthdate').on('blur', function(){
 	var birthdate = $('#birthdate').val();
 	if (birthdate == '') {
 		birthdate_state = false;
 		return;
 	}
 	$.ajax({
      url: 'signup2.php',
      type: 'post',
      data: {
      	'birthdate_check' : 1,
      	'birthdate' : birthdate,
      },
      success: function(response){
      	if (response == 'Not Valid' ) {
          birthdate_state = false;
          $('#birthdate').parent().removeClass();
          $('#birthdate').parent().addClass("form_error");
          $('#birthdate').siblings("span").text('Sorry... Birthdate is not valid');
      	}else if (response == 'Valid') {
      	  birthdate_state = true;
      	  $('#birthdate').parent().removeClass();
      	  $('#birthdate').parent().addClass("form_success");
      	  $('#birthdate').siblings("span").text('Birthdate Valid');
      	}
      }
 	});
 });

  $('#school').on('blur', function(){
 	var school = $('#school').val();
 	if (school == '') {
 		school_state = false;
 		return;
 	}
 	$.ajax({
      url: 'signup2.php',
      type: 'post',
      data: {
      	'school_check' : 1,
      	'school' : school,
      },
      success: function(response){
      	if (response == 'taken' ) {
          school_state = false;
          $('#school').parent().removeClass();
          $('#school').parent().addClass("form_error");
          $('#school').siblings("span").text('Sorry... There is a principal assigned on this school');
      	}else if (response == 'not_taken') {
      	  school_state = true;
      	  $('#school').parent().removeClass();
      	  $('#school').parent().addClass("form_success");
      	  $('#school').siblings("span").text('Valid');
      	}
      }
 	});
 });

 $('#signup').on('click', function(){
 	var prc_id = $('#prc_id').val();
     var email = $('#email').val();
    var contact = $('#contact').val();
    var birthdate = $('#birthdate').val();
    var school = $('#school').val();


 	if (prc_id_state == false || email_state == false || contact_state == false || birthdate_state == false || school_state == false ) {
	  $('#error_msg').text('Please fix error first!');
	}else{
      // proceed with form submission
      $.ajax({
      	url: 'signup2.php',
      	type: 'post',
      	data: {
            'save' : 1,
            'prc_id': prc_id,
      		'email' : email,
      		'contact' : contact,
            'birthdate' : birthdate,
            'school' : school
      	},
      	success: function(response){
      		alert('user saved');
      		location.href = "signup2.php";
      	}
      });
 	}
 });
});