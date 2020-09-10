<?php
if (isset($_SESSION['user'])) {
	header('location: home.php');
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
	<title>user-managemnt</title>
<link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="design/css/font-awesome.min
.css">
<link rel="stylesheet" type="text/css" href="design/css/control.css">
</head>
<body class="background">

<div class="container">
	<!--login form start-->
	
	<div class="row  justify-content-center wrapper" id="login-box"style="
    height: 100vh;">
		<div class="col-lg-10 my-auto">
			<div class="card-group myShadow">
				<!---start card 1-->
				<div class="card rounded-left p-4 " style="flex-grow :1:4;">
					<h1 class="text-center font-weight-bold text-primary">Sing In To Account</h1>
					<hr class="my-3">
					<p id ="try"></p>
					<form action="#" method="post" class="px-3" id="login-form">
						<div id="AlertloginError"></div>
						<!--start email-->
						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fa fa-envelope fa-lg"></i>
								</span>
							</div>
							<input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-mail" required="required" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>" >
						</div>
						<!--end email-->
						<!--start password-->
						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fa fa-key fa-lg"></i>
								</span>
							</div>
							<input type="password" name="password" id="password" class="form-control rounded-0" placeholder="password" required="required" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>">
						</div>
						<!--end password-->
						<!--start remember-->
						<div class="form-group">
								<div class="custom-control custom-checkbox float-left">
								<input type="checkbox" class="custom-control-input" id="customCheck" name="rem" <?php if(isset($_COOKIE['email'])){echo 'checked';}?>>
                          <label class="custom-control-label" for="customCheck">									Remember me 
								</label>
							</div>
							<div class="forgot float-right">
								<a href="#" id="forgot-link">Forgot Password ?</a>
							</div>
						</div>
						<!--end remember-->
						<div class="form-group">
							<input type="submit" name="submit" id="login-btn" value="Sing In" class="btn btn-primary btn-lg btn-block mybtn">
						</div>
					</form>
				</div><!---end card 1-->
				<div class="card  rounded-right myColor p-4">
					<h1 class="text-center font-weight-bold text-white">Hello Friend</h1>
					<hr class="my-3 bg-light myhr">
					<p class="text-center font-weight-bolder text-light lead">Enter Personal Detailes And Start Your Journey with us!</p>
					<button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="register-link">Sign Up</button>
				</div><!---end card 2-->
			</div><!--end form group-->
		</div><!--class grid systm--->
	</div><!--end class row-->
	<!--login form end--======================================================================-->
	<!--register form start--==================================================================-->


<div class="row  justify-content-center wrapper" id="register-box"style="
    height: 100vh;display: none;">
		<div class="col-lg-10 my-auto">
			<div class="card-group myShadow">
				<div class="card  rounded-right myColor p-4"><!---start card 1-->
					<h1 class="text-center font-weight-bold text-white">Wellcome Back</h1>
					<hr class="my-3 bg-light myhr">
					<p class="text-center font-weight-bolder text-light lead"> To Keep Connect With Us Please login with your Personal Info.</p>
					<button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="login-link">Sign In</button>
				</div><!---end card 1-->
				<!---start card 2-->
				<div class="card rounded-left p-4 " style="flex-grow :1:4;">
					<h1 class="text-center font-weight-bold text-primary">Create Account</h1>
					<hr class="my-3">
					<form action="#" method="post" class="px-3" id="register-form">
						<div id="alertErorr"></div>
						<!--start full name-->
						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fa fa-user fa-lg"></i>
								</span>
							</div>
							<input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Full Name" required="required" >
						</div>
						<!--end full name-->
						<!--start email-->
						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fa fa-envelope fa-lg"></i>
								</span>
							</div>
							<input type="email" name="remail" id="email" class="form-control rounded-0" placeholder="E-mail" required="required" >
						</div>
						<!--end email-->
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
							<input type="submit" name="submit" id="register-btn" value="Sing Up" class="btn btn-primary btn-lg btn-block mybtn">
						</div>
					</form>
				</div><!---end card 2-->
				
			</div><!--end form group-->
		</div><!--class grid systm--->
	</div><!--end class row-->
	<!--regiser form end--====================================================================-->
<!--forgot password form start-->
	<div class="row  justify-content-center wrapper" id="forgot-box"style="
    height: 100vh; display: none;">
		<div class="col-lg-10 my-auto">
			<div class="card-group myShadow">
				<div class="card  rounded-right myColor p-4"><!---start card 1-->
					<h1 class="text-center font-weight-bold text-white">Forgot your Password</h1>
					<hr class="my-3 bg-light myhr">
					
					<button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="back-link">Back</button>
				</div><!---end card 1-->
				<!---start card 2-->
				<div class="card rounded-left p-4 " style="flex-grow :1:4;">
					<h1 class="text-center font-weight-bold text-primary">Sing In To Account</h1>
					<hr class="my-3">
					<p class="lead text-center text-secondary">
						To reset your password ,Enter the Registered E-mail address And we will send you the Reset Instructions on your email. 
					</p>
					
					<form action="#" method="post" class="px-3" id="forgot-form">
					<div id="forgotalert"></div>
						<!--start email-->
						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fa fa-envelope fa-lg"></i>
								</span>
							</div>
							<input type="email" name="email" id="femail" class="form-control rounded-0" placeholder="E-mail" required="required" autofocus>
						</div>
						<!--end email-->
						
						
						<div class="form-group">
							<input type="submit" name="submit" id="forgot-btn" value="Reset password" class="btn btn-primary btn-lg btn-block mybtn">
						</div>
					</form>
				</div><!---end card 2-->
				
			</div><!--end form group-->
		</div><!--class grid systm--->
	</div><!--end class row-->
	<!--forgot password form end--======================================================================-->
</div><!--class container end-->

	<script src="design/js/jquery-3.3.1.min.js"></script>
	<script src="design/js/bootstrap.min.js"></script>
	<script src="design/js/control.js"></script>
	<script src="design/js/popper.min.js"></script>
	
</body>
</html>
