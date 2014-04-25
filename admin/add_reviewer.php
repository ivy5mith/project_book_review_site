<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}

?>
<?php $title="Reviewer Added" //Declaring the meta title  ?>
<?php
include("includes/mysql_functions.php"); //include mysql_functions which also includes config.php
include("includes/functions.php");
//Declaring the values
$reviewer_uname = $_POST['reviewer_uname'];
$reviewer_email = $_POST['reviewer_email'];
$reviewer_pwd = $_POST['reviewer_pwd'];
$about_reviewer = $_POST['about_reviewer'];

//script for uploading reviewer photo
$allowed_filetypes = array('.jpg','.jpeg','.png','.gif'); //restrict to only these extensions
$max_filesize = 1048576; //max file size
$upload_path = 'reviewers/'; //upload path

$filename = $_FILES['photo']['name']; //filename

if($filename==NULL)//if there is no cover image uploaded
{//begin if
	$photo="reviewers/noimage.png";
}//end if
else
{//begin else
	$photo=fun_image_upload('photo',$allowed_filetypes,$max_filesize,$upload_path,$filename);//calling function image_upload, see functions.php
}//end else

$return_result = fun_insert("reviewer_email",$reviewer_email,"reviewer","reviewer_uname,reviewer_email,reviewer_pwd,about_reviewer,photo","'".$reviewer_uname."','".$reviewer_email."','".md5($reviewer_pwd)."','".htmlspecialchars($about_reviewer, ENT_QUOTES)."','".$photo."'"); //calling function insert, see functions.php

?>
<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>

<?php
if($return_result==0)
{?>
<div id="header"><!-- begin  -->
 Email address already exist.  Please try again. 
</div><!-- end  -->
<?php	
}
else
{
?>
<div id="header"><!-- begin  -->
 <h2>Thank You</h2>
</div><!-- end  -->
<div id="content"> <!-- begin  -->
<p>You have submitted the following information:</p>
<table align="center" class="narrowform"><!-- Begin table -->

<tr>
	<th class="label">Photo</th>
	<td><?php echo("<img src='".$photo."' />"); //Display photo ?></td>
</tr>

<tr>
	<th class="label">Username</th>
	<td ><?php echo($reviewer_uname); //Display username ?></td>
</tr>

<tr>
	<th class="label">Email</th>
	<td><?php echo($reviewer_email); //Display email ?></td>
</tr>

<tr>
	<th class="label">About Me</th>
	<td><?php echo($about_reviewer); //Display about reviewer ?></td>
</tr>


</table><!-- End table -->
<?php	
}
?>
<p><a href="reviewers.php">Go back to Reviewer admin page</a></p>
</div>
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>