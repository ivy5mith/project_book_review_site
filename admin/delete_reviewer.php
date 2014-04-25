<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}

?>
<?php 
//This will delete a course
include("includes/mysql_functions.php");
$reviewer_id = $_GET['reviewer_id'];
$sql_delete = "DELETE FROM reviewer WHERE reviewer_id=".$reviewer_id; //Delete SQL query
query($sql_delete); //call query function
header("location:reviewers.php");//Browser redirection
?>