<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}

?>
<?php $title="Reviews"; //Declaring the meta title  
$this_page="reviews"; //setting this_page for the nav
$arrow = "<img src='images/down_arrow.gif' />";
?>
<?php
include("includes/mysql_functions.php");
include("includes/functions.php");

$sql_reviews = "SELECT review.review_id,review,rating,review_date,review.isbn,review.reviewer_id,books.cover,books.title,books.author,reviewer.reviewer_uname FROM review INNER JOIN books ON review.isbn = books.isbn INNER JOIN reviewer ON review.reviewer_id = reviewer.reviewer_id"; //Select course table, sql query

///The following are sort conditions///

if(isset($_GET['order'])) //if order is defined then get value
{//begin if
	$order=$_GET['order'];
}//end if
else 
{//begin else
	$order = "DESC";
}//end else
if(isset($_GET['sort'])) //if sort is defined then get value
{//begin if
	$sort=$_GET['sort'];
}//end if
else 
{//begin else
	$sort = " ORDER BY review_date ".$order; //else order by date added (default sort)
}//end else



if($sort=="title") //if sort by title
{//begin if
	$sort = " ORDER BY books.title ".$order;
}//end if
if($sort=="author") //if sort by author
{//begin if
	$sort = " ORDER BY books.author ".$order;
}//end if
if($sort=="rating") //if sort by rating
{//begin if
	$sort = " ORDER BY rating ".$order;
}//end if

if($sort=="date") //if sort by date ascending
{//begin if
	$sort = " ORDER BY review_date ".$order;
}//end if
if($sort=="reviewedby") //if sort by date descending
{//begin if
	$sort = " ORDER BY reviewer.reviewer_uname ".$order;
}//end if

if($order=="DESC") //so when you click on the link again, the order is reversed
{//begin if
	$order="ASC";
}//end if
else
{//begin if
	$order="DESC";
}//end if
	
////end of sort conditions////

$sql_reviews .= $sort; //append sort to query

$result_review = query($sql_reviews); //calling query function
date_default_timezone_set("America/Vancouver"); //setting the timezone
?>
<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>


<div id="header"><!-- begin header -->
  <h2>Reviews</h2>
</div><!-- end header -->
<div id="content"> <!-- begin content -->
<!--<p><a href="add_review_booklist.php">Add a Review</a></p>-->
<?php
echo("<table>"); //begin table
echo("<tr class='table-row'><th class='label'>Cover</th><th class='label'><a href='reviews.php?sort=title&order=".$order."'>Title</a></th><th class='label'><a href='reviews.php?sort=author&order=".$order."'>Author</a></th><th  class='label'>Review</a></th><th class='label'><a href='reviews.php?sort=rating&order=".$order."'>Rating ".$arrow."</a></th><th class='label'><a href='reviews.php?sort=date&order=".$order."'>Reviewed on</a></th><th class='label'><a href='reviews.php?sort=reviewedby&order=".$order."'>Reviewed by</a></th><th class='label'>Edit Review</th><th class='label'>Delete Review</th></tr>");
//database number of rows is not fixed.  It changes as you add and delete, thus the while loop
while($arr_row = mysql_fetch_array($result_review)) //while loop because we don't know how many rows the table is going to be
{//begin while loop

$file = $arr_row['review'];
$review_text = file_get_contents($file); //get review contents from file
$review_excerpt = substr($review_text, 0, 100)."...";


	echo("<tr><td class='table-column'><img src='".$arr_row['cover']."' width='50px' /></td><td class='table-column'>".$arr_row['title']."</td><td class='table-column'>".$arr_row['author']."</td><td class='table-column'>".$review_excerpt."</td><td class='table-column'>".$arr_row['rating']."</td><td class='table-column'>".date("F j, Y, g:i a", strtotime($arr_row['review_date']))."</td><td class='table-column'>".$arr_row['reviewer_uname']."</td><td class='table-column'><a href='edit_review_form.php?review_id=".$arr_row['review_id']."'>Edit</a></td>"."<td class='table-column'><a href='delete_review.php?review_id=".$arr_row['review_id']."'>Delete</a></td>"."</tr>");	
}//end while loop
echo("</table>"); //end table
?>
<!--<p><a href="add_review_booklist.php">Add a Review</a></p>-->
</div> <!-- end content -->
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>