<?php
session_start();
require_once('auth.php');
$cuser=new Auth();
if (!isset($_SESSION['user'])) {
	header('location:index.php');
}else{
$cmail=$_SESSION['user'];
$sessionData=$cuser->currentUser($cmail);


}




?>