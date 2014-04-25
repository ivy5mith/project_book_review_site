<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}

?>
<?php $title="Reviewers"; //Declaring the meta title  
$this_page="reviewers";//setting this_page for the nav
?>
<?php
include("includes/mysql_functions.php");

$sql_reviewer = "SELECT reviewer_id,reviewer_uname,reviewer_email,reviewer_pwd,about_reviewer,photo,role FROM reviewer"; //Select course table, sql query
$result = query($sql_reviewer); //calling query function
?>
<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>

<div id="header"><!-- begin header -->
  <h2>Reviewers</h2>
</div><!-- end header -->
<div id="content"> <!-- begin content -->
<!--<p><a href="add_reviewer_form.php">Add a Reviewer</a></p>-->
<?php
echo("<table>"); //begin table
echo("<tr class='table-row'><th class='label'>Photo</th><th class='label'>Username</th><th class='label'>Email</th><th class='label'>About Reviewer</th><th class='label'>Role</th><th class='label'>Edit Profile</th><th class='label'>Delete Reviewer</th></tr>");
//database number of rows is not fixed.  It changes as you add and delete, thus the while loop
while($arr_row = mysql_fetch_array($result)) //while loop because we don't know how many rows the table is going to be
{//begin while loop

$about_excerpt = substr($arr_row['about_reviewer'], 0, 100)."..."; //get 100 characters only for tthe excerpt

	echo("<tr><td class='table-column'><img src='".$arr_row['photo']."' width='50px' /></td><td class='table-column'>".$arr_row['reviewer_uname']."</td><td class='table-column'>".$arr_row['reviewer_email']."</td><td class='table-column'>".$about_excerpt."</td><td class='table-column'>".$arr_row['role']."</td><td class='table-column'><a href='edit_reviewer_form.php?reviewer_id=".$arr_row['reviewer_id']."'>Edit</a></td>"."<td class='table-column'><a href='delete_reviewer.php?reviewer_id=".$arr_row['reviewer_id']."'>Delete</a></td>"."</tr>");	
}//end while loop
echo("</table>"); //end table
?>
<!--<p><a href="add_reviewer_form.php">Add a Reviewer</a></p>-->
</div> <!-- end content -->
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>