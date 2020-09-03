<?php
session_start();
require_once('auth.php');
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
		return "register";
		$_SESSION['user']=$email;


	}else{
		echo $user->showMessage('danger','some thing went wrong! try again later!');
	}
}

}//=============================================================================end register ajax
//===============================================================================start login ajax
if (isset($_POST['action'])&&$_POST['action']==='login') {
	
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
			$_SESSION['email']=$email;
			//header("location: home.php");

		}// end of password_verify
		else{
echo $user->showMessage('danger','Your Password Is Incorrect!');
		}// end of not password_verify

	}//end of the user loginUser
	else{
		echo $user->showMessage('danger','user not found!');
	}//end of user not loginUser
}
//===============end   login ajax
?>