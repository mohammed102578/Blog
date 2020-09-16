<?php
require_once 'session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="mohammed">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
<link rel="stylesheet" type="text/css" href="design/css/bootstrap.min.css">
	<title><?= ucfirst(basename($_SERVER['PHP_SELF'],'.php'));?> | Verina</title>
<link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="design/css/font-awesome.min
.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.css"/> 
</head>
<body>


<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="index.php"><i class="fa fa-code fa-lg"></i>&nbsp Verina</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='home.php')?"active":""?>" href="home.php"><i class="fa fa-home"></i> &nbsp Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='Profile.php')?"active":""?>" href="Profile.php"><i class="fa fa-user-circle"></i> &nbsp Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='Feedback.php')?"active":""?>" href="Feedback.php"><i class="fa fa-comment"></i> &nbsp Feedback</a>
      </li>  
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='Notification.php')?"active":""?>" href="Notification.php"><i class="fa fa-bell"></i> &nbsp Notification</a>
      </li>


    <li class="nav-item dropdown">
  <a id="navbardrop" class="nav-link dropdown-toggle" data-toggle="dropdown" href="">
    <i class="fa fa-user"></i>&nbsp <?= $cname;?></a>

  <div class="dropdown-menu">
    <a class="dropdown-item" href="#"><i class="fa fa-cog"></i>&nbsp Setting</a>
    <a class="dropdown-item" href="php/log out.php"><i class="fa fa-sign-out"></i>&nbsp Logout</a>
    
</div>
          </li> 
    </ul>
  </div>  
</nav>
<br>


  <h3>
  	<?php basename($_SERVER['PHP_SELF']);?>

  	</h3>


