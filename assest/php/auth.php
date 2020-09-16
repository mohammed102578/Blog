<?php
require_once('config.php');
class Auth extends DataBase
{

//======================================================================start registration
//REGISTER NOW
	public function register($name, $email, $password)
	{
$sql="INSERT INTO users(name,email,password) VALUES(:name,:email,:password)";
$stmt=$this->conn->prepare($sql);
$stmt->execute(['name'=>$name,'email'=>$email,'password'=>$password]);
return true;

	}//end of the function register



//check if user already registered
	public function userExist($email)
	{
$sql="SELECT * FROM users WHERE `email`=:email";
$stmt=$this->conn->prepare($sql);
$stmt->execute(['email'=>$email]);
$count=$stmt->rowcount();
return $count;
	}
//======================================================================end registration
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
public function update($pass, $email)
{
$sql="UPDATE users SET `password`=:pass ,`token`='' WHERE `email`=:email AND deleted != 0";
$stmt=$this->conn->prepare($sql);
$stmt->execute(['pass'=>$pass,'email'=>$email]);

return true;
}
//========================================================end update
public function addNote($uid, $title, $note)
{

	$sql="INSERT INTO notes (`user-id`,`title`,`note`) 	VALUES (:uid,:title,:note)";
	$stmt=$this->conn->prepare($sql);
	$stmt->execute(['uid'=>$uid,'title'=>$title,'note'=>$note]);
	return true;
}
//===================================================end add note

public function getNote($uid)
{
$sql="SELECT * FROM notes WHERE `user-id`=:uid";
$stmt=$this->conn->prepare($sql);
$stmt->execute(['uid'=>$uid]);
$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
return $row;
}
//====================================================end getnote
public function getEditNote($id){
$sql="SELECT * FROM notes WHERE `id`=:id";
$stmt=$this->conn->prepare($sql);
$stmt->execute(['id'=>$id]);
$result=$stmt->fetch(PDO::FETCH_ASSOC);
return $result;
}
//==================================end of the geyeditnote
//edit note
public function editNote($title, $note, $id)
{
	$sql="UPDATE `notes` SET `title`=:title ,`note`=:note ,`update_at`=now() WHERE `id`=:id";
	$stmt=$this->conn->prepare($sql);
	$stmt->execute(['title'=>$title,'note'=>$note,'id'=>$id]);
	return true;
}//=================================END of the edit note
//delete note
public function deleteNote($id)
{
	$sql="DELETE FROM `notes` WHERE `id`=:id";
	$stmt=$this->conn->prepare($sql);
	$stmt->execute(['id'=>$id]);
	return true;
}//=================================END of the delete note
}//end of the class
