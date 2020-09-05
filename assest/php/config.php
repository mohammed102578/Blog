<?php
class DataBase{
    const USERNAME="mohamed@gmail.com";
    const PASSWORD="anythings"; 
private $dsn="mysql:localhost=host;dbname=user_system";
private $user="root";
private $password="";
public $conn;

public function __construct(){
try{

$this->conn=new pdo($this->dsn,$this->user,$this->password);

}
catch(PDOExecption $e){
echo "failed to connect".$e->getMessage();

}
return $this->conn;
}
//=================================check input
public function test_input($data){
$data=trim($data);

$data=stripslashes($data);

$data=htmlspecialchars($data);

return$data;
}
//====================Error show message alert
public function showMessage($type,$message){
return '<div class="alert alert-'.$type.' alert-dismissible">

<button typ="button" class="close" data-dismiss="alert">&times;</button>
<strong class="text-center">'.$message.'</strong>  </div>';

}//end of the function show message
}//end of the brakcit class
?>