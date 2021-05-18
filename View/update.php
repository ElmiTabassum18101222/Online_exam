<?php
include_once 'dbConnection.php';
include_once 'udfunction.php';
$db=new database;
$con= $db->dblink();
session_start();
$email=$_SESSION['email'];


//delete user
if(isset($_SESSION['key'])){
if(@$_GET['demail'] && $_SESSION['key']=='elmi112358') {
$demail=@$_GET['demail'];
$r1 = mysqli_query($con,"DELETE FROM rank WHERE email='$demail' ") or die('Error');
$r2 = mysqli_query($con,"DELETE FROM history WHERE email='$demail' ") or die('Error');
$result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
header("location:dash.php?q=1");
}
}
//remove quiz
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'rmquiz' && $_SESSION['key']=='elmi112358') {
$eid=@$_GET['eid'];
$result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$qid = $row['qid'];
$r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
$r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
}
$r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');

header("location:dash.php?q=5");
}
}

//add quiz
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addquiz' && $_SESSION['key']=='elmi112358') {
$type = $_POST['e_type'];
//$name= ucwords(strtolower($name));
$c_code = $_POST['c_code'];
$deadline = $_POST['deadline'];
$folder_path = './upload/';
$filename = $_FILES['qfile']['name'];
$file_tmp= $_FILES['qfile']['tmp_name'];
$final_file = $folder_path.$filename;
$id=uniqid();
echo "$c_code";
//$sq=mysqli_query($con,"SELECT * FROM course WHERE course_code='$c_code'");
$quiz=new quiz;
$addquiz= $quiz->addquiz($con, $type, $c_code, $deadline, $file_tmp, $final_file);
//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
}
//add answer
if(isset($_SESSION['email'])){
if(@$_GET['q']== 'addans') {
$type = $_POST['e_type'];
//$name= ucwords(strtolower($name));
$c_code = $_POST['c_code'];
//$deadline = $_POST['deadline'];
$folder_path = './upload/';
$filename = $_FILES['afile']['name'];
$file_tmp= $_FILES['afile']['tmp_name'];
$final_file = $folder_path.$filename;
//$id=uniqid();
echo "$c_code";
//$sq=mysqli_query($con,"SELECT * FROM course WHERE course_code='$c_code'");
echo "$type";
if($type=='M')
{
$q3=mysqli_query($con,"UPDATE course SET a_mid='$final_file' WHERE course_code=$c_code");
}
else if($type=='Q')
{
$q3=mysqli_query($con,"UPDATE course SET a_quiz='$final_file' WHERE course_code=$c_code");
}
else if($type=='F')
{
$q3=mysqli_query($con,"UPDATE course SET a_final='$final_file' WHERE course_code=$c_code");
}

if (move_uploaded_file($file_tmp, $folder_path.$filename))
        {
           echo "Success";
                   }
		else echo "Failed";
	

//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
}

//add result
if(isset($_SESSION['email'])){
if(@$_GET['q']== 'addresult') {
$type = $_POST['e_type'];
//$name= ucwords(strtolower($name));
$c_code = $_POST['c_code'];
//$deadline = $_POST['deadline'];
$folder_path = './upload/';
$filename = $_FILES['rfile']['name'];
$file_tmp= $_FILES['rfile']['tmp_name'];
$final_file = $folder_path.$filename;
//$id=uniqid();
echo "$c_code";
//$sq=mysqli_query($con,"SELECT * FROM course WHERE course_code='$c_code'");
echo "$type";
if($type=='M')
{
$q3=mysqli_query($con,"UPDATE course SET r_mid='$final_file' WHERE course_code=$c_code");
}
else if($type=='Q')
{
$q3=mysqli_query($con,"UPDATE course SET r_quiz='$final_file' WHERE course_code=$c_code");
}
else if($type=='F')
{
$q3=mysqli_query($con,"UPDATE course SET r_final='$final_file' WHERE course_code=$c_code");
}

if (move_uploaded_file($file_tmp, $folder_path.$filename))
        {
           echo "Success";
                   }
		else echo "Failed";
	

//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
}
?>



