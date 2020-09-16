<?php
class DataBase{
    const USERNAME="mohammed10257883@gmail.com";
    const PASSWORD='0911036308'; 
private $dsn="mysql:host=localhost;dbname=user_system";
private $user="root";
private $password="";
public $conn;

public function __construct()
{
try{

$this->conn=new pdo($this->dsn,$this->user,$this->password);

}catch(PDOException $e){
echo "failed to connect".$e->getMessage();

}
return $this->conn;
}
//=================================check input
public function testInput($data)
{
$data=trim($data);

$data=stripslashes($data);

$data=htmlspecialchars($data);
$data=htmlentities($data);

return$data;
}
//====================Error show message alert
public function showMessage($type,$message){
return '<div class="alert alert-'.$type.' alert-dismissible fade show">

<button typ="button" class="close" data-dismiss="alert">&times;</button>
<strong class="text-center">'.$message.'</strong>  </div>';

}//end of the function show message

}//end of the brackets class
?>