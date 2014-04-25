<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}

?>
<?php
//update book info
include("includes/mysql_functions.php"); 
include("includes/functions.php");
//Declaring the values
$reviewer_id = $_POST['reviewer_id'];
$reviewer_uname = $_POST['reviewer_uname'];
$reviewer_email = $_POST['reviewer_email'];
$reviewer_pwd = $_POST['reviewer_pwd'];
$about_reviewer = $_POST['about_reviewer'];
$photo = $_POST['photo'];

//code for uploading book cover images
$allowed_filetypes = array('.jpg','.jpeg','.png','.gif'); //restrict to only these extensions
$max_filesize = 1048576; //max file size
$upload_path = 'reviewers/'; //upload path

$filename = $_FILES['photo']['name']; //filename

if($filename!=NULL)
{//begin else
	$photo=fun_image_upload('photo',$allowed_filetypes,$max_filesize,$upload_path,$filename);//calling function image_upload, see functions.php
}//end else

if($reviewer_pwd==NULL)//check if password have been updated
{//begin if
//sql query to modify row 
$sql_update = "UPDATE reviewer SET reviewer_uname='".$reviewer_uname."',reviewer_email='".$reviewer_email."',about_reviewer='".$about_reviewer."',photo='".$photo."' WHERE reviewer_id='".$reviewer_id."'"; 	
}//end if
else
{//begin else
//sql query to modify row 
$sql_update = "UPDATE reviewer SET reviewer_uname='".$reviewer_uname."',reviewer_email='".$reviewer_email."',reviewer_pwd='".md5($reviewer_pwd)."',about_reviewer='".$about_reviewer."',photo='".$photo."' WHERE reviewer_id='".$reviewer_id."'"; 
}//end  else
query($sql_update); //calling query function
header("location:reviewers.php"); //browser redirection
?>