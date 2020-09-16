<?php
session_start();
require_once('auth.php');
$cuser=new Auth();
if (!isset($_SESSION['user'])) {
	header('location:index.php');
}else{
$cmail=$_SESSION['user'];
$ses_data=$cuser->findUser($cmail);

$cid=$ses_data['id'];
$cname=$ses_data['name'];
$cpass=$ses_data['password'];
$cphone=$ses_data['phone'];
$cgender=$ses_data['gender'];
$cdob=$ses_data['dob'];
$cphoto=$ses_data['photo'];
$create=$ses_data['created_at'];
$verified=$ses_data['verified'];

if ($verified==1) {
	$verified= "verified";
}else{

	$verified= "Not verified";
}
}




?>