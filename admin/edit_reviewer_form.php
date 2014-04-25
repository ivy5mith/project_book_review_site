<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}
$this_page="reviewers";//setting this_page for the nav
?>
<?php $title="Edit Profile" //Declaring the meta title  ?>
<?php 
include("includes/mysql_functions.php");
include("includes/functions.php");
$reviewer_id = $_GET['reviewer_id'];

$arr_row = fun_select("reviewer_id,reviewer_uname,reviewer_email,reviewer_pwd,about_reviewer,photo","reviewer","reviewer_id='".$reviewer_id."'");
//call select function see functions.php

?>
<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>

<div id="header"><!-- begin header -->
  <h2>Update <?php echo $arr_row['reviewer_uname']; ?>'s Profile</h2>
</div><!-- end header -->
<div id="content"> <!-- begin content -->
<!-- This HTML code will display a form that will accept information using the "Post" method -->
<form method="POST" action="edit_reviewer.php" enctype="multipart/form-data"> <!-- Begin form -->
<table align="center"> <!-- Begin table -->



<tr>
	<th class="label">Username*</th>
	<td><input type="text" name="reviewer_uname" maxlength="20" class="form-text" value="<?php echo($arr_row['reviewer_uname']); ?>" /></td>
</tr>

<tr>
	<th class="label">Email*</th>
	<td><input type="text" name="reviewer_email" maxlength="30" class="form-text" value="<?php echo($arr_row['reviewer_email']); ?>" /></td>
</tr>

<tr>
	<th class="label">Password*</th>
	<td>
    <input type="hidden" name="reviewer_pwd" value="<?php echo($arr_row['reviewer_pwd']); ?>" />
    <input type="password" name="reviewer_pwd" maxlength="10" class="form-text" /></td>
</tr>

<tr>
	<th class="label">About Me</th>
	<td><textarea row="3" cols="17" name="about_reviewer" class="form-textarea" /><?php echo($arr_row['about_reviewer']); ?></textarea></td>
</tr>
<tr>
	<th class="label">Add a photo</th>
	<td >
    <input type="hidden" name="photo" value="<?php echo($arr_row['photo']); ?>" />
    <input type="file" name="photo">
 <input type="hidden" name="reviewer_id" value="<?php echo($arr_row['reviewer_id']); ?>" />
    </td>
</tr>
<tr>
	<td colspan=2>
 		<?php echo("<img src='".$arr_row['photo']."' />"); //Display Photo ?>
 	</td>
</tr>
<tr>
	
	<td colspan="2" Align="center"><input type="submit" name="submit" value="Update Reviewer" /></td>
</tr>

</table> <!-- End table -->
</form> <!-- End form -->
*denotes required field
</div> <!-- end content -->
</body>
</html>