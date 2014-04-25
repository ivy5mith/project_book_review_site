<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}

include("includes/mysql_functions.php");
//Declaring the values
$isbn = $_POST['isbn'];
$title = $_POST['title'];
$author = $_POST['author'];

$sql_books = "SELECT isbn,title,author,cover FROM books";

$filter=" WHERE 1=1 "; //dummy clause

if($_POST['isbn']!="") //if isbn is not blank
{//begin if
$filter .= "AND isbn LIKE ".$isbn; // append condition to query
}//end if
if($_POST['title']!="") //if title is not blank
{//begin if
$filter .= "AND title LIKE '".$title."'"; // append condition to query
}//end if
if($_POST['author']!="") //if author is not blank
{//begin if
$filter .= "AND author LIKE '".$author."'"; // append condition to query
}//end if

$sql_books .= $filter; // append filter to query
echo $sql_books;
$result = query($sql_books); //calling function query
?>
<?php $title="Search Result" //Declaring the meta title?>
<?php include("includes/head.php"); //inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>



<div id="header"><h2>Search Result</h2></div>
    <div id="content">
    <table align="center">
        <tr>
        	<th>Cover</th><th>ISBN</th><th>Title</th><th>Author</th>
        </tr>
        <?php
		if(mysql_num_rows($result)==0)//if 0 result is returned
		{//begin if
			echo("<tr><td colspan='3'>Sorry, but nothing matched your search criteria.</td></tr>");
		}//end if
		while($arr_row = mysql_fetch_array($result)) //loop through the table to display information
		{//begin while
			echo("<tr>");
				echo("<td><a href='edit_book_form.php?isbn=".$arr_row['isbn']."'><img src='".$arr_row['cover']."' width='50px' /></a></td>");
				echo("<td><a href='edit_book_form.php?isbn=".$arr_row['isbn']."'>".$arr_row['isbn']."</a></td>");
				echo("<td><a href='edit_book_form.php?isbn=".$arr_row['isbn']."'>".$arr_row['title']."</a></td>");
				echo("<td><a href='edit_book_form.php?isbn=".$arr_row['isbn']."'>".$arr_row['author']."</a></td>");
			echo("</tr>");
		}//end while
		
		?>
	</table>
    </div>
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>