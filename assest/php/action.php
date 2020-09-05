<?php
session_start();
require_once('auth.php');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$user=new Auth();
//===============start register ajax
if (isset($_POST['action'])&&$_POST['action']=='register') {
	$name=$user->test_input($_POST['name']);
	$email=$user->test_input($_POST['remail']);
	$password=$user->test_input($_POST['password']);
	$pass=password_hash($password, PASSWORD_DEFAULT);

	if($user->user_exist($email)){
echo $user->showMessage('warning','This E-mail is already registerd!');
}else{

	if ($user->register($name,$email,$pass)) {
		echo"register";
		$_SESSION['user']=$email;


	}else{
		echo $user->showMessage('danger','some thing went wrong! try again later!');
	}
}

}//=============================================================================end register ajax
//===============================================================================start login ajax
if (isset($_POST['action'])&&$_POST['action']=='login') {
	$email=$user->test_input($_POST['email']);
	$password=$user->test_input($_POST['password']);
	$loginUser=$user->login($email);
	
	if ($loginUser) {
		if (password_verify($password,$loginUser['password'] )) {
			if (!empty($_POST['rem'])) {
				setcookie('email',$email,time()+(30*24*60*60),'/');
				setcookie('password',$password,time()+(30*24*60*60),'/');

			}else{
				setcookie('email','',1,'/');
				setcookie('password','',1,'/');
			}//end of the no found remmember
			echo"login";
			$_SESSION['user']=$email;
			

		}// end of password_verify
		else{
echo $user->showMessage('danger','Your Password Is Incorrect!');
		}// end of not password_verify

	}//end of the user loginUser
	else{
		echo $user->showMessage('danger','user not found!');
	}//end of user not loginUser
}
//==============================================================================end   login ajax
//==============================================================================start forgot ajax
if (isset($_POST['action'])&&$_POST['action']=='forgot'){
	$cemail=$_POST['email'];
	$email=$user->test_input($cemail);
	$user_found=current_user($email);
	if($user_found){
$token=uniqid();
$token=str_shuffle($token);
$user->forgot_password($token,$email);
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = DataBase::USERNAME;                     // SMTP username
    $mail->Password   = DataBase::PASSWORD;                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom(DataBase::USERNAME,'DeCodeMania');
    $mail->addAddress($email);     // Add a recipient
   

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Reset password';
	$mail->Body    = '<h3>Click the below link to reset your password.<br>
	<a href="http://localhost/user-management/assest/reset_password.php?email='.$email.'&token='.$token.'">
	http://localhost/user-management/assest/reset_password.php?email='.$email.'&token='.$token.'</a><br>Regards<br>DecodeMania!</h3>';

    

    $mail->send();
    echo $user->showMessage('success','We have send you the reset link in your E-mail ID , please check you e-mail');
} catch (Exception $e) {
	echo $user->showMessage('danger','somethig went wrong please try again later');
}
	}//end of the user not null
	else{
		echo $user->showMessage('info','This E-mail is not Registered!');
	}
}

//=============================================================================end forgot ajaX
?>