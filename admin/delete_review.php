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
$review_id = $_GET['review_id'];
$sql_delete = "DELETE FROM review WHERE review_id=".$review_id; //Delete SQL query
query($sql_delete); //call query function
$sql_update = "UPDATE books SET review_id=NULL WHERE review_id =".$review_id; //update the review_id in table "books" to NULL
query($sql_update);
header("location:reviews.php");//Browser redirection
?>