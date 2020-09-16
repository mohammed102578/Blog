<?php
require_once('php/auth.php');
$user=new Auth();
global $msg;
if(isset($_GET['email'])&&isset($_GET['token'])){
$email=$user->testInput($_GET['email']);
$token=$user->testInput($_GET['token']);

$find_pass=$user->resetPassword($email,$token);
if($find_pass){
if($_SERVER['REQUEST_METHOD']==='POST'){
$new_pass=$_POST['password'];
$confirm_pass=$_POST['cpassword'];
$hash_pass=password_hash($new_pass,PASSWORD_DEFAULT);
if($new_pass===$confirm_pass){
$update= $user->update($hash_pass,$email);
if($update==true){
$msg='<div class="alert alert-success alert-dismissible">your password is updated <br><h1 class="text-center font-weight-bold">
<a href="index.php">login</a></h1></div>';	

}else{
	$msg='<div class="alert alert-danger alert-dismissible">sorry something went wrong  your password not updated!</div>';
}

}//if password not match
else{
	$msg='<div class="alert alert-danger alert-dismissible">your password is No matched!</div>';
}
}//end of the if request method =post
}//if found user 
else{
	header('location:index.php');
}
}//end of the condition $_GET isset
else{

	header('location:index.php');
}

?>


<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
	<meta name="author" content="mohammed">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
<link rel="stylesheet" type="text/css" href="design/css/bootstrap.min.css">
<title>reset password</title>
<link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="design/css/font-awesome.min
.css">
<link rel="stylesheet" type="text/css" href="design/css/control.css">
</head>
<body>
	<div class="container">
<div class="row  justify-content-center wrapper" style="
    height: 100vh;">
		<div class="col-lg-10 my-auto">
			<div class="card-group myShadow">
				<div class="card  rounded-right myColor p-4"><!---start card 1-->
					<h1 class="text-center font-weight-bold text-white">Welcome Dear </h1>
					<hr class="my-3 bg-light myhr">
					<br><br>
					<h1 class="text-center font-weight-bold text-white"> Reset Your Password.</h1>
					
				</div><!---end card 1-->
				<!---start card 2-->
				<div class="card rounded-left p-4 " style="flex-grow :1:6;">
					<h1 class="text-center font-weight-bold text-primary">Reset Password</h1>
					<hr class="my-3">
					<form action="#" method="post" class="px-3" id="register-form">
						<?php echo $msg;?>

						
						<!--start password-->
						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fa fa-key fa-lg"></i>
								</span>
							</div>
							<input type="password" name="password" id="rpassword" class="form-control rounded-0" placeholder="password" required="required" minlength='5'>
						</div>
						<!--end password-->
						<!--start confirm password-->
						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fa fa-key fa-lg"></i>
								</span>
							</div>
							<input type="password" name="cpassword" id="cpassword" class="form-control rounded-0" placeholder="Confirm password" required="required"minlength='5' >
						</div>
						<!--end confirm password-->
						<!--start error not password match-->
							<div class="form-group">
								<div id="passError" class="text-danger font-weight-bold"></div>
							</div>
								<!--end error not password match-->
						<div class="form-group">
							<input type="submit" name="submit" id="register-btn" value="Reset password" class="btn btn-primary btn-lg btn-block mybtn">
						</div>
					</form>
				</div><!---end card 2-->
				
			</div><!--end form group-->
		</div><!--class grid system--->
	</div><!--end class row-->
</div><!--end class container-->

</body>
</html>