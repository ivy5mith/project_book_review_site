<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}

?>
<?php $title="Review Added" //Declaring the meta title  ?>
<?php
include("includes/mysql_functions.php"); //include mysql_functions which also includes config.php
include("includes/functions.php");
date_default_timezone_set("America/Vancouver");
//Declaring the values
$review = $_POST['review'];
$rating = $_POST['rating'];
$isbn = $_POST['isbn'];
$reviewer_id = $_SESSION['reviewer']['reviewer_id'];

$time = time();
$date = date('Y-m-d',$time); //get date for the folder name

if (!is_dir("reviews/".$date)) //if directory does not exist create folder
{//begin if
    mkdir("reviews/".$date, 0755, true); //bool mkdir ( string $pathname [, int $mode = 0777 [, bool $recursive = false [, resource $context ]]] )
}//end if

$file = "reviews/".$date."/".$isbn.$reviewer_id.".txt";
file_put_contents($file, $review); //put review content in created file
$review_text = file_get_contents($file); //get review contents from file


$return_result = fun_insert(0,0,"review","review,rating,isbn,reviewer_id","'".$file."','".$rating."','".$isbn."','".$reviewer_id."'"); //calling function insert, see functions.php

$sql_review = "SELECT review_id, isbn FROM review WHERE isbn ='".$isbn."'"; //select the newly added review to get the review_id
$result_review = query($sql_review);
$arr_row = mysql_fetch_array($result_review);
$sql_update = "UPDATE books SET review_id='".$arr_row['review_id']."' WHERE isbn ='".$arr_row['isbn']."'"; //update the review_id in table "books"
query($sql_update);
?>
<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>


<div id="header"><!-- begin  -->
 <h2>Thank You</h2>
</div><!-- end  -->
<div id="content"> <!-- begin  -->
<p>You have submitted the following information:</p>
<table align="center" class="narrowform"><!-- Begin table -->

<tr>
	<th class="label">Review</th>
	<td><?php 
	echo($review_text); //Display Review ?></td>
</tr>

<tr>
	<th class="label">Rating</th>
	<td ><?php echo($rating); //Display rating ?></td>
</tr>




</table><!-- End table -->
<p><a href="reviews.php">Go back to Admin page</a></p>
</div>
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>