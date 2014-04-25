<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}
$this_page="reviewers";//setting this_page for the nav
?>
<?php $title="Add Reviewer" //Declaring the meta title  ?>
<?php 
//accessing nav include
include("includes/functions.php");
date_default_timezone_set("UTC");
?>
<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>
<div id="header"><!-- begin header -->
  <h2>Add a Reviewer</h2>
</div><!-- end header -->
<div id="content"> <!-- begin content -->
<!-- This HTML code will display a form that will accept information using the "Post" method -->
<form method="POST" action="add_reviewer.php" enctype="multipart/form-data"> <!-- Begin form -->
<table> <!-- Begin table -->

<tr>
	<th class="label">Username*</th>
	<td><input type="text" name="reviewer_uname" maxlength="20" class="form-text" /></td>
</tr>

<tr>
	<th class="label">Email*</th>
	<td><input type="text" name="reviewer_email" maxlength="30" class="form-text" /></td>
</tr>

<tr>
	<th class="label">Password*</th>
	<td><input type="password" name="reviewer_pwd" maxlength="10" class="form-text" /></td>
</tr>

<tr>
	<th class="label">About Me</th>
	<td><textarea row="3" cols="17" name="about_reviewer" class="form-textarea" /></textarea></td>
</tr>
<tr>
	<th class="label">Add a photo</th>
	<td >
    
    <input type="file" name="photo">
 
    </td>
</tr>
<tr>
	
	<td colspan="2" Align="center"><input type="submit" name="submit" value="Add Reviewer" /></td>
</tr>

</table> <!-- End table -->
</form> <!-- End form -->
*denotes required field
</div> <!-- end content -->
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>