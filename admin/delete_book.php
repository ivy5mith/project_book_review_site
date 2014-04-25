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
$isbn = $_GET['isbn'];
$sql_delete = "DELETE FROM books WHERE isbn=".$isbn; //Delete SQL query
query($sql_delete); //call query function
header("location:books.php");//Browser redirection
?>