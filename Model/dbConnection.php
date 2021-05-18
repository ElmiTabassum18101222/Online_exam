<?php
//all the variables defined here are accessible in all the files that include this one
class database{
	public function dblink(){ 
		$con= new mysqli('localhost','root','','online_exam')or die("Could not connect to mysql".mysqli_error($con));
		return $con;
	}
}

?>