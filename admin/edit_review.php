<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}

?>
<?php
//update review
include("includes/mysql_functions.php"); 
include("includes/functions.php");
//Declaring the values
$review_id = $_POST['review_id'];
$review = $_POST['review'];
$rating = $_POST['rating'];
$review_date = $_POST['review_date'];
$isbn = $_POST['isbn'];
$reviewer_id = $_POST['reviewer_id'];
$path = $_POST['path'];
file_put_contents($path, $review); //put review content in created file
//sql query to modify row 
$sql_update = "UPDATE review SET review='".$path."',rating='".$rating."',review_date='".$review_date."',isbn='".$isbn."',reviewer_id='".$reviewer_id."' WHERE review_id='".$review_id."'"; 
query($sql_update); //calling query function
header("location:reviews.php"); //browser redirection
?>