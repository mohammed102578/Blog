$(document).ready(function(){
			$('#register-link').click(function(){
            $("#login-box").hide();
            $("#register-box").show();
			});

			$('#login-link').click(function(){
			$("#register-box").hide();
            $("#login-box").show();
            
			});


            $('#forgot-link').click(function(){
			$("#login-box").hide();
            $("#forgot-box").show();
            
			});

            $('#back-link').click(function(){
			$("#forgot-box").hide();
            $("#login-box").show();
            
			});
//===========================================================start register ajax
			$('#register-btn').click(function(e){
             if ($('#register-form')[0].checkValidity()) {
            e.preventDefault();
            $('#register-btn').val('please wait.......');
            if ($('#rpassword').val()!==$('#cpassword').val()) {
            	$('#passError').text('* password did not match!');
            	$('#register-btn').val('Sign Up');
            }//end of if password not match
            else{//startof the password is match
            	$('#passError').text('');
            	$.ajax({
            		url:'php/action.php',
            		method:'post',
            		data:$('#register-form').serialize()+'&action=register',
            		success:function(response){
            			$('#register-btn').val('Sign Up');
                       
            			if(action=== 'register') {
            				window.location='home.php';
            			}else{
                        
                        $("#alertErorr").html(response);
            			}
            		}//end success


            	});

            }//end of the password is match
             }//end of if checkValidity
            
			});//end of the register form
//===========================================================end register ajax
//===========================================================start login ajax

$('#login-btn').click(function(e){

if ($('#login-form')[0].checkValidity()) {
e.preventDefault();
$('#login-btn').val('please wait.....');
$.ajax({
	url:'php/action.php',
	method:'post',
	cache:false,
	data: $('#login-form').serialize()+'&action=login',
	success: function(response){
		$('#login-btn').val('Sign In');
		if (response==='login'){
			
			window.location.replace("home.php");

		}else{
$("#AlertloginError").html(response);

		}
		
	}//end success

});//end ajax 
}//end of if checkValidity
});//end of the register form
//===========================================================endt register ajax


		});