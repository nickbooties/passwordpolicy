var baseUrl = OC.generateUrl('/apps/passwordpolicy');

var passwordpolicy = new Object();

$('#save_password_policy').live('click',function(){
    passwordpolicy.minlength = $("#password_policy_min_length").val();
    passwordpolicy.hasmixedcase = $("#password_policy_mixed_case").prop('checked');
    passwordpolicy.hasnumbers = $("#password_policy_numbers").prop('checked');
    passwordpolicy.hasspecialchars = $("#password_policy_special_characters").prop('checked');
    passwordpolicy.specialcharslist = $("#password_policy_special_chars_list").val();
    
    $.ajax({
	url: baseUrl + '/savepolicy',
	type: 'POST',
	contentType: 'application/json',
	data: JSON.stringify(passwordpolicy)
    }).done(function (response) {
	// handle success
	$('#save_password_policy_status').html("Policy updated.");
    }).fail(function (response, code) {
	// handle failure
	$('#save_password_policy_status').html("Policy update failed.");
    });
});