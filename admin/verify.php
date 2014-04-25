<?php
session_start(); //start session
include("includes/mysql_functions.php");
//declaring the values
$reviewer_email = $_POST["reviewer_email"];
$reviewer_pwd = $_POST["reviewer_pwd"];

//will check if email and pwd matches
function authorize($id,$pwd)
{//begin function authorize()
	
	$sql_login = "SELECT reviewer_email,reviewer_uname,reviewer_id,about_reviewer,photo,role FROM reviewer WHERE reviewer_email = '".$id."' AND reviewer_pwd = '".md5($pwd)."'";
	$result = query($sql_login); //sql query
	while($arr_row = mysql_fetch_array($result))
	{//begin while
		return $arr_row; //if id and password match, arr_row is returned	
	}//end while
	return false; //if id and pw DOES NOT match, return false
}//end function authorize()

if($reviewer = authorize($reviewer_email,$reviewer_pwd)) //returned value is stored in array reviewer
{//begin if
	$_SESSION['reviewer'] = $reviewer;
header("location:index.php?reviewer_email=".$reviewer_email);	
}//end if
else
{//begin if
header("location:login.php");	
}//end if

?>