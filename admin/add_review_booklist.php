<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}

?>
<?php 
$title="Add a Review"; //Declaring the meta title  
$this_page="reviews"; //setting this_page for the nav
?>
<?php
include("includes/mysql_functions.php");

$sql_books = "SELECT isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover,review_id,reviewer.reviewer_uname FROM books INNER JOIN reviewer ON added_by = reviewer.reviewer_id"; //Select course table, sql query
$result = query($sql_books); //calling query function

?>
<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>


<div id="header"><!-- begin header -->
  <h2>Add Review</h2>
</div><!-- end header -->
<div id="content"> <!-- begin content -->

<?php
echo("<table>"); //begin table
echo("<tr class='table-row'><th class='label'>Cover</th><th class='label'>Title</th><th class='label'>Author</th><th class='label'>Book Added by</th><th class='label'>Shelf</th><th class='label'>Add Review</th></tr>");
//database number of rows is not fixed.  It changes as you add and delete, thus the while loop
while($arr_row = mysql_fetch_array($result)) //while loop because we don't know how many rows the table is going to be
{//begin while loop
	echo("<tr><td class='table-column'><img src='".$arr_row['cover']."' width='50px' /></td><td class='table-column'>".$arr_row['title']."</td><td class='table-column'>".$arr_row['author']."</td><td class='table-column'>".$arr_row['reviewer_uname']."</td>");
	
	if($arr_row['shelf']==1)//Defining shelves
	{//begin if
	echo("<td class='table-column'>To Read</td>");
	}//end if
	if($arr_row['shelf']==2)//Defining shelves
	{//begin if
	echo("<td class='table-column'>Currently Reading</td>");
	}//end if
	if($arr_row['shelf']==3)//Defining shelves
	{//begin if
	echo("<td class='table-column'>Read</td>");
	}//end if
	
	if($arr_row['review_id']!=NULL)//check if review id is null
	{//begin if
		echo("<td class='table-column'><a href='edit_review_form.php?review_id=".$arr_row['review_id']."'>Edit Review</a>"."</td>");
	}//end if
	else{//begin else
		echo("<td class='table-column'><a href='add_review_form.php?isbn=".$arr_row['isbn']."'>Add a Review</a>"."</td>");
	}//end else
	
	
	echo("</tr>");	
}//end while loop
echo("</table>"); //end table
?>

</div> <!-- end content -->
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>