<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Online Examination </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

 
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
 <!--alert message-->
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->

</head>
<?php
include_once 'dbConnection.php';
$db=new database;
$con= $db->dblink();
?>
<body>
<div class="header">
<div class="row">
<div class="col-lg-6">
<span class="logo">Online Examination</span></div>
<div class="col-md-4 col-md-offset-2">
 <?php
 include_once 'dbConnection.php';
 $db=new database;
$con= $db->dblink();
session_start();
  if(!(isset($_SESSION['email']))){
header("location:index.php");

}
else
{
$name = $_SESSION['name'];
$email=$_SESSION['email'];

include_once 'dbConnection.php';
$db=new database;
$con= $db->dblink();
echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="account.php?q=1" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
}?>
</div>
</div></div>
<div class="bg">

<!--navigation menu-->
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><b>Netcamp</b></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?> ><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
        <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="account.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;Quiz</a></li>
		<li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="account.php?q=3"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Mid Term</a></li>
		<li <?php if(@$_GET['q']==4) echo'class="active"'; ?>><a href="account.php?q=4"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Final Examination</a></li>
		<li <?php if(@$_GET['q']==5) echo'class="active"'; ?>><a href="account.php?q=5"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Upload Answer</a></li>
		<li class="pull-right"> <a href="logout.php?q=account.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Signout</a></li>
		</ul>
            <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter tag ">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Search</button>
      </form>
      </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!--navigation menu closed-->
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">

<!--home start-->
<?php if(@$_GET['q']==1) {

$result = mysqli_query($con,"SELECT * FROM course WHERE FIND_IN_SET('$email',students)") or die('Error');
echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Course Code</b></td><td><b>Course Title</b></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$course_code =$row['course_code'];
	$title = $row['course_title'];
	$d_quiz= $row['d_quiz'];
	
	echo '<tr><td>'.$c++.'</td><td>'.$course_code.'</td><td>'.$title.'</td></tr>';
}
$c=0;
echo '</table></div></div>';

}?>

<!--home closed-->

<!--quiz start-->
<?php
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];
$q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
echo '<div class="panel" style="margin:5%">';
while($row=mysqli_fetch_array($q) )
{
$qns=$row['qns'];
$qid=$row['qid'];
echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br />'.$qns.'</b><br /><br />';
}
$q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
echo '<form action="update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
<br />';

while($row=mysqli_fetch_array($q) )
{
$option=$row['option'];
$optionid=$row['optionid'];
echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option.'<br /><br />';
}
echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
//result display
if(@$_GET['q']== 'result' && @$_GET['eid']) 
{
$eid=@$_GET['eid'];
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
echo  '<div class="panel">
<center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
      <tr style="color:#99cc32"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
	  <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
	  <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
$q=mysqli_query($con,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
echo '</table></div>';

}
?>
<!--quiz end-->
<?php
//Quiz start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM course WHERE FIND_IN_SET('$email',students)") or die('Error');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>S.N.</b></td><td><b>Coure Code</b></td><td><b>Course Title</b></td><td><b>Deadline</b></td><td><b>Question<b></td><td><b>Answer</b></td><td><b>Result</b></td></tr>';
$c=1;
while($row=mysqli_fetch_array($q) )
{
$course_code =$row['course_code'];
	$title = $row['course_title'];
	$d_quiz= $row['d_quiz'];
	$q_quiz= $row['q_quiz'];
	$a_quiz= $row['a_quiz'];
	$r_quiz= $row['r_quiz'];
	
	echo '<tr><td>'.$c++.'</td><td>'.$course_code.'</td><td>'.$title.'</td><td>'.$d_quiz.'</td><td> <a href="download.php?FilePaths='.$q_quiz.'">Question</a></td><td><a href="download.php?FilePaths='.$a_quiz.'">Answer</a></td><td><a href="download.php?FilePaths='.$r_quiz.'">Result</a></td></tr>';
	
	//$q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
//while($row=mysqli_fetch_array($q23) )
//{
//$title=$row['title'];
//}
//$c++;
//echo '<tr><td>'.$c.'</td><td>'.$title.'</td><td>'.$qa.'</td><td>'.$r.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
}
echo'</table></div>';
}

//Mid Term start
if(@$_GET['q']== 3) 
{
$q=mysqli_query($con,"SELECT * FROM course WHERE FIND_IN_SET('$email',students)") or die('Error');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>S.N.</b></td><td><b>Coure Code</b></td><td><b>Course Title</b></td><td><b>Deadline</b></td><td><b>Question<b></td><td><b>Answer</b></td><td><b>Result</b></td></tr>';
$c=1;
while($row=mysqli_fetch_array($q) )
{
$course_code =$row['course_code'];
	$title = $row['course_title'];
	$d_mid= $row['d_mid'];
	$q_mid= $row['q_mid'];
	$a_mid= $row['a_mid'];
	$r_mid= $row['r_mid'];
	
	echo '<tr><td>'.$c++.'</td><td>'.$course_code.'</td><td>'.$title.'</td><td>'.$d_mid.'</td><td> <a href="download.php?FilePaths='.$q_mid.'">Question</a></td><td><a href="download.php?FilePaths='.$a_mid.'">Answer</a></td><td><a href="download.php?FilePaths='.$r_mid.'">Result</a></td></tr>';
	
	
}
echo'</table></div>';
}

//Final Examination start
if(@$_GET['q']== 4) 
{
$q=mysqli_query($con,"SELECT * FROM course WHERE FIND_IN_SET('$email',students)") or die('Error');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>S.N.</b></td><td><b>Coure Code</b></td><td><b>Course Title</b></td><td><b>Deadline</b></td><td><b>Question<b></td><td><b>Answer</b></td><td><b>Result</b></td></tr>';
$c=1;
while($row=mysqli_fetch_array($q) )
{
$course_code =$row['course_code'];
	$title = $row['course_title'];
	$d_final= $row['d_final'];
	$q_final= $row['q_final'];
	$a_final= $row['a_final'];
	$r_final= $row['r_final'];
	
	echo '<tr><td>'.$c++.'</td><td>'.$course_code.'</td><td>'.$title.'</td><td>'.$d_final.'</td><td> <a href="download.php?FilePaths='.$q_final.'">Question</a></td><td><a href="download.php?FilePaths='.$a_final.'">Answer</a></td><td><a href="download.php?FilePaths='.$r_final.'">Result</a></td></tr>';
	
	
}
echo'</table></div>';
}

//Answer Upload 



if(@$_GET['q']==5) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Upload Answer</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="update.php?q=addans"  method="POST" enctype="multipart/form-data">
<fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="e_type"></label>
  <div class="col-md-12">
    <select id="e_type" name="e_type" placeholder="Enter Examination Type" class="form-control input-md" >
   <option value="">Select Type</option>
  <option value="Q">Quiz</option>
  <option value="M">Mid Term</option>
  <option value="F">Final Examination</option> </select>
  </div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="c_code"></label>  
  <div class="col-md-12">
  <input id="c_code" name="c_code" placeholder="Enter Course Code" class="form-control input-md" type="number">
    
  </div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="afile"></label>  
  <div class="col-md-12">
  <input id="afile" name="afile" placeholder="Select a pdf file" class="form-control input-md" type="file">
    
  </div>
</div>




<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';



}

?>



</div></div></div></div>
<!--Footer start-->
<div class="row footer">
<div class="col-md-3 box">
<a href="" target="_blank">About us</a>
</div>
<div class="col-md-3 box">
<a href="#" data-toggle="modal" data-target="#login">Admin Login</a></div>
<div class="col-md-3 box">
<a href="#" data-toggle="modal" data-target="#developers">Developers</a>
</div>
<!--div class="col-md-3 box">
<a href="feedback.php" target="_blank">Feedback</a></div></div-->
<!-- Modal For Developers-->
<div class="modal fade title1" id="developers">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Developers</span></h4>
      </div>
	  
      <div class="modal-body">
        <p>
		<div class="row">
		<div class="col-md-4">
		 <img src="image/elmi.jpg" width=100 height=100 alt="Elmi" class="img-rounded">
		 </div>
		 <div class="col-md-5">
		<a  style="color:#202020; font-family:'typo' ; font-size:18px" title="title1">Elmi Tabassum</a>
		<h4 style="color:#202020; font-family:'typo' ;font-size:16px" class="title1">+8801743136565</h4>
		<h4 style="font-family:'typo' ">elmztab@gmail.com</h4>
		<h4 style="font-family:'typo' ">Brac University</h4></div></div>
		</p>
      </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal for admin login-->
	 <div class="modal fade" id="login">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span style="color:orange;font-family:'typo' ">LOGIN</span></h4>
      </div>
      <div class="modal-body title1">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<form role="form" method="post" action="admin.php?q=index.php">
<div class="form-group">
<input type="text" name="uname" maxlength="20"  placeholder="Admin user id" class="form-control"/> 
</div>
<div class="form-group">
<input type="password" name="password" maxlength="15" placeholder="Password" class="form-control"/>
</div>
<div class="form-group" align="center">
<input type="submit" name="login" value="Login" class="btn btn-primary" />
</div>
</form>
</div><div class="col-md-3"></div></div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--footer end-->


</body>
</html>
