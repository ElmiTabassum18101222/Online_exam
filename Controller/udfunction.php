<?php
//public $con;
class sign{
	
		
	Public function signup($con,$name, $gender, $department, $email, $mob, $password){
		//echo $con;
		$q3=mysqli_query($con,"INSERT INTO user VALUES  ('$name' , '$gender' , '$department','$email' ,'$mob', '$password',0)");
		if($q3)
		{
		session_start();
		$_SESSION["email"] = $email;
		$_SESSION["name"] = $name;

		return 1;
		//header("location:account.php?q=1");
		}
		else
		{
		//header("location:index.php?q7=Email Already Registered!!!");
		}
	}
}

class quiz{
	public function addquiz($con, $type, $c_code, $deadline, $file_tmp, $final_file){
		if($type=='M')
		{
			$q3=mysqli_query($con,"UPDATE course SET d_mid='$deadline', q_mid='$final_file' WHERE course_code=$c_code");
		}
		else if($type=='Q')
		{
			$q3=mysqli_query($con,"UPDATE course SET d_quiz='$deadline', q_quiz='$final_file' WHERE course_code=$c_code");
		}
		else if($type=='F')
		{
			$q3=mysqli_query($con,"UPDATE course SET d_final='$deadline', q_final='$final_file' WHERE course_code=$c_code");
		}

		if (move_uploaded_file($file_tmp, $final_file)){
				   echo "Success";
		}
		else echo "Failed";
			

			
			
			
	}
}
?>