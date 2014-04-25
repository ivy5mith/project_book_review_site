<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}
$this_page="reviews"; //setting this_page for the nav
?>
<?php $title="Add a Review" //Declaring the meta title  ?>
<?php 
include("includes/mysql_functions.php");
include("includes/functions.php");
$isbn = $_GET['isbn'];
$arr_row_book = fun_select("title,author","books","isbn='".$isbn."'");
?>
<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>
<div id="header"><!-- begin header -->
  <h2>Add a Review for <?php echo($arr_row_book['title']." by ".$arr_row_book['author']);?></h2>
</div><!-- end header -->
<div id="content"> <!-- begin content -->
<!-- This HTML code will display a form that will accept information using the "Post" method -->
<form method="POST" action="add_review.php"> <!-- Begin form -->
<table> <!-- Begin table -->

<tr>
	<th class="label">Review*</th>
	<td><textarea cols="100" rows="20" name="review" class="form-textarea" /></textarea></td>
</tr>

<tr>
	<th class="label">Rating*</th>
	<td><input type="text" name="rating" maxlength="1" class="form-text" /></td>
    <input type="hidden" name="isbn" value="<?php echo($isbn); ?>" />
     
</tr>
<tr>
	
	<td colspan="2" align="center"><input type="submit" name="submit" value="Add Review" /></td>
</tr>

</table> <!-- End table -->
</form> <!-- End form -->
*denotes required field
</div> <!-- end content -->
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>