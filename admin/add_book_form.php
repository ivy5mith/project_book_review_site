<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}
$this_page="books"; //setting this_page for the nav
?>
<?php $title="Add a New Book" //Declaring the meta title  ?>
<?php 
//accessing nav include
include("includes/functions.php");
?>
<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>
<div id="header"><!-- begin header -->
  <h2>Add a New Book</h2>
</div><!-- end header -->
<div id="content"> <!-- begin content -->
<!-- This HTML code will display a form that will accept information using the "Post" method -->
<form method="POST" action="add_book.php" enctype="multipart/form-data"> <!-- Begin form -->
<table align="center"> <!-- Begin table -->

<tr>
	<th class="label">ISBN*</th>
	<td><input type="text" name="isbn" maxlength="13"  class="form-text" /></td>
</tr>

<tr>
	<th class="label">Title*</th>
	<td><input type="text" name="title" maxlength="50"  class="form-text" /></td>
</tr>

<tr>
	<th class="label">Author*</th>
	<td><input type="text" name="author" maxlength="30"  class="form-text" /></td>
</tr>

<tr>
	<th class="label">Publisher</th>
	<td><input type="text" name="publisher" maxlength="30"  class="form-text" /></td>
</tr>

<tr>
	<th class="label">Published</th>
	<td>
    Year: <input type="text" name="year" maxlength="4" /> Month: <?php echo(fun_date(1,12,"month",1)); //Display month by calling date function ?> Day: <?php echo(fun_date(1,31,"day",1)); //Display day by calling date function ?>
    </td>
</tr>

<tr>
	<th class="label">Summary</th>
	<td><textarea  cols="100" rows="10"  name="summary"  class="form-textarea" /></textarea></td>
</tr>
<tr>
	<th class="label">Shelf</th>
	<td >
    <select name="shelf" class="form-dropdown">
    <option value="1" selected>To Read</option>
    <option value="2">Currently Reading</option>
    <option value="3">Read</option>
    </select>
    </td>
</tr>
<tr>
	<th class="label">Add a cover image for this book</th>
	<td >
   
     <input type="file" name="cover">
     
     <input type="hidden" name="added_by" value="<?php echo($_SESSION['reviewer']['reviewer_id']); ?>" /> 
  
    </td>
</tr>
<tr>
	
	<td colspan="2" align="center"><input type="submit" name="submit" value="Add Book" /></td>
</tr>

</table> <!-- End table -->
</form> <!-- End form -->
*denotes required field
</div> <!-- end content -->
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>