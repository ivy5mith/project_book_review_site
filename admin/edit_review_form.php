<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}
$this_page="reviews";//setting this_page for the nav
?>
<?php $title="Edit Review" //Declaring the meta title  ?>

<?php 
include("includes/mysql_functions.php");
include("includes/functions.php");
$review_id = $_GET['review_id'];

$arr_row = fun_select("review_id,review,rating,review_date,isbn,reviewer_id","review","review_id='".$review_id."'");
//call select function see functions.php
$file = $arr_row['review'];
$review_text = file_get_contents($file); //get review contents from file


?>
<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>

<div id="header"><!-- begin header -->
  <h2>Edit Review</h2>
</div><!-- end header -->
<div id="content"> <!-- begin content -->
<!-- This HTML code will display a form that will accept information using the "Post" method -->
<form method="POST" action="edit_review.php"> <!-- Begin form -->
<table align="center"> <!-- Begin table -->
        <input type="hidden" name="path" value="<?php $path=$arr_row['review']; echo($path); ?>" />
<tr>
	<th class="label">Review*</th>
	<td><textarea rows="20" cols="100" name="review"  class="form-textarea" /><?php echo($review_text); ?></textarea></td>
</tr>

<tr>
	<th class="label">Rating*</th>
	<td><input type="text" name="rating" maxlength="1" class="form-text" value="<?php echo($arr_row['rating']); ?>" /></td>
    <input type="hidden" name="review_id" value="<?php echo($arr_row['review_id']); ?>" />
	<input type="hidden" name="isbn" value="<?php echo($arr_row['isbn']); ?>" />
     <input type="hidden" name="reviewer_id" value="<?php echo($arr_row['reviewer_id']); ?>" />
     <input type="hidden" name="review_date" value="<?php echo($arr_row['review_date']); ?>" />
</tr>
<tr>
	
	<td colspan="2" Align="center"><input type="submit" name="submit" value="Update Review" /></td>
</tr>

</table> <!-- End table -->
</form> <!-- End form -->
*denotes required field
</div> <!-- end content -->
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>