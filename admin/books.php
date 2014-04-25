<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}
include("includes/mysql_functions.php");
 
$title="Books"; //Declaring the meta title  
$this_page="books"; //setting this_page for the nav
$arrow = "<img src='images/down_arrow.gif' />";

$sql_books = "SELECT isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover,review_id,reviewer.reviewer_uname FROM books INNER JOIN reviewer ON added_by = reviewer.reviewer_id"; //Select course table, sql query

///The following are sort conditions///

if(isset($_GET['order'])) //if order is defined then get value
{//begin if
	$order=$_GET['order'];
}//end if
else 
{//begin else
	$order = "DESC"; //else default value is descending
}//end else

if(isset($_GET['sort'])) //if sort is defined then get value
{//begin if
	$sort=$_GET['sort'];
}//end if
else 
{//begin else
	$sort = " ORDER BY date_added ".$order; //else order by date added (default sort)
}//end else


if($sort=="isbn") //if sort by isbn
{//begin if
	$sort = " ORDER BY isbn ".$order;
}//end if
if($sort=="title") //if sort by title
{//begin if
	$sort = " ORDER BY title ".$order;
}//end if
if($sort=="author") //if sort by author
{//begin if
	$sort = " ORDER BY author ".$order;
}//end if
if($sort=="publisher") //if sort by publisher
{//begin if
	$sort = " ORDER BY publisher ".$order;
}//end if
if($sort=="published") //if sort by published date
{//begin if
	$sort = " ORDER BY publish_date ".$order;
}//end if
if($sort=="date") //if sort by date ascending
{//begin if
	$sort = " ORDER BY date_added ".$order;
}//end if
if($sort=="addedby") //if sort by added_by
{//begin if
	$sort = " ORDER BY added_by ".$order;
}//end if
if($sort=="shelf") //if sort by date descending
{//begin if
	$sort = " ORDER BY shelf ".$order;
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


$sql_books .= $sort; //append sort to query
$result = query($sql_books); //calling query function

?>
<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>


<div id="header"><!-- begin header -->
  <h2>Books</h2>
</div><!-- end header -->
<div id="content"> <!-- begin content -->

<!--<p><a href="add_book_form.php">Add a book</a></p> -->

<?php
echo("<table>"); //begin table
echo("<tr class='table-row'><th class='label'>Cover</th><th class='label'><a href='books.php?sort=isbn&order=".$order."'>ISBN</a></th><th class='label'><a href='books.php?sort=title&order=".$order."'>Title</a></th><th class='label'><a href='books.php?sort=author&order=".$order."'>Author</a></th><th class='label'><a href='books.php?sort=publisher&order=".$order."'>Publisher</a></th><th class='label'><a href='books.php?sort=published&order=".$order."'>Published</a></th><th class='label'><a href='books.php?sort=date&order=".$order."'>Date Added ".$arrow."</a></th><th class='label'><a href='books.php?sort=addedby&order=".$order."'>Added by</a></th><th class='label'><a href='books.php?sort=shelf&order=".$order."'>Shelf</a></th><th class='label'>Add a Review</th><th class='label'>Edit</th><th class='label'>Delete</th></tr>");
//database number of rows is not fixed.  It changes as you add and delete, thus the while loop
while($arr_row = mysql_fetch_array($result)) //while loop because we don't know how many rows the table is going to be
{//begin while loop
	echo("<tr><td class='table-column'><img src='".$arr_row['cover']."' width='50px' /></td><td class='table-column'>".$arr_row['isbn']."</td><td class='table-column'>".$arr_row['title']."</td><td class='table-column'>".$arr_row['author']."</td><td class='table-column'>".$arr_row['publisher']."</td><td class='table-column'>".date("F j, Y",strtotime($arr_row['publish_date']))."</td><td class='table-column'>".date("F j, Y, g:i a", strtotime($arr_row['date_added']))."</td><td class='table-column'>".$arr_row['reviewer_uname']."</td>");
	
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
	
	
	echo("<td class='table-column'><a href='edit_book_form.php?isbn=".$arr_row['isbn']."'>Edit</a></td>"."<td class='table-column'><a href='delete_book.php?isbn=".$arr_row['isbn']."'>Delete</a></td>"."</tr>");	
}//end while loop
echo("</table>"); //end table
?>
<!--<p><a href="add_book_form.php">Add a book</a></p> -->
</div> <!-- end content -->
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>