<?php
include_once 'dbConnection.php';
include_once 'udfunction.php';
ob_start();
$name = $_POST['name'];
$name= ucwords(strtolower($name));
$gender = $_POST['gender'];
$email = $_POST['email'];
$department = $_POST['department'];
$mob = $_POST['mob'];
$password = $_POST['password'];
$name = stripslashes($name);
$name = addslashes($name);
$name = ucwords(strtolower($name));
$gender = stripslashes($gender);
$gender = addslashes($gender);
$email = stripslashes($email);
$email = addslashes($email);
$department = stripslashes($department);
$department = addslashes($department);
$mob = stripslashes($mob);
$mob = addslashes($mob);

$password = stripslashes($password);
$password = addslashes($password);
//$password = md5($password);
$db=new database;
$con= $db->dblink();
$sign= new sign;
$s= $sign->signup($con,$name, $gender, $department, $email, $mob, $password);
if($s==1){
	header("location:account.php?q=1");
}
ob_end_flush();
?>