<?php
require_once('config.php');
class Auth extends DataBase{
//======================================================================start registeration
//REGISTER NOW
	public function register($name,$email,$password)
	{
$sql="INSERT INTO users(name,email,password) VALUES(:name,:email,:password)";
$stmt=$this->conn->prepare($sql);
$stmt->execute(['name'=>$name,'email'=>$email,'password'=>$password]);
return true;

	}//end of the function register



//check if user already registred
	public function userExist($email)
	{
$sql="SELECT * FROM users WHERE `email`=:email";
$stmt=$this->conn->prepare($sql);
$stmt->execute(['email'=>$email]);
$count=$stmt->rowcount();
return $count;
	}
//======================================================================end registeration
//check user  login

public function findUser($email)
{
	$sql="SELECT * FROM users WHERE `email`=:email AND `deleted`!=0 ";
	$stmt=$this->conn->prepare($sql);
	$stmt->execute(['email'=>$email]);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	return$row;

}//======================================================================================end function login

public function forgotPassword($token,$email)
{
	$sql="UPDATE users SET `token`=:token ,`token_expier`=DATE_ADD(NOW(),INTERVAL 10 MINUTE) WHERE `email`=:email";
	$stmt=$this->conn->prepare($sql);
	$stmt->execute(['token'=>$token,'email'=>$email]);
	return true;

}
//======================================================================================end function forgot
public function resetPassword($email,$token)
{
$sql="SELECT `id` FROM users WHERE 	`email`=:email AND `token`=:token AND `token`!='' AND `token_expier`>NOW() AND `deleted`!= 0";
$stmt=$this->conn->prepare($sql);
$stmt->execute(['email'=>$email,'token'=>$token]);
$row=$stmt->fetch(PDO::FETCH_ASSOC);
return $row;

}//==================================================================================end of the function reset password
public function update($pass,$email)
{
$sql="UPDATE users SET `password`=:pass ,`token`='' WHERE `email`=:email AND deleted != 0";
$stmt=$this->conn->prepare($sql);
$stmt->execute(['pass'=>$pass,'email'=>$email]);

return true;
}

}//end of the class
