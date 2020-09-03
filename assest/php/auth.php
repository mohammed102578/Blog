<?php
require_once('config.php');
class Auth extends Database{
//======================================================================start registeration
//REGISTER NOW
	public function register($name,$email,$password){
$sql="INSERT INTO users(name,email,password) VALUES(:name,:email,:password)";
$stmt=$this->conn->prepare($sql);
$stmt->execute(['name'=>$name,'email'=>$email,'password'=>$password]);
return true;

	}//end of the function register



//check if user already registred
	public function user_exist($email){
$sql="SELECT * FROM users WHERE `email`=:email";
$stmt=$this->conn->prepare($sql);
$stmt->execute(['email'=>$email]);
$result=$stmt->fetch(PDO::FETCH_ASSOC);
return $result;
	}
//======================================================================end registeration
//check user  login
public function login($email){
	$sql="SELECT * FROM users WHERE `email`=:email AND `deleted`!=0 ";
	$stmt=$this->conn->prepare($sql);
	$stmt->execute(['email'=>$email]);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$count=$stmt->rowcount();
	//return $count ;
	return$row;

}/////////////////////////////////////end function login($email)///////////////////////////////

public function currentUser($email){
	$sql="SELECT * FROM users WHERE `email`=:email AND `deleted`!=0 ";
	$stmt=$this->conn->prepare($sql);
	$stmt->execute(['email'=>$email]);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$count=$stmt->rowcount();
	//return $count ;
	return$row;

}}//end of the class


?>