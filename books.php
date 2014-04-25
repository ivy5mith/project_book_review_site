<?php 
session_start();
include("admin/includes/mysql_functions.php"); //include mysql_functions which also includes config.php
include("admin/includes/functions.php"); //include functions
$sql_books = "SELECT isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover FROM books ORDER BY title ASC"; //Select books table, sql query
date_default_timezone_set("America/Vancouver"); //setting the timezone
if(isset($_GET['shelf']))//checks if shelf is defined
{//begin if
$shelf = $_GET['shelf'];
}//end if
else
{//begin else
$shelf="all";//set shelf to all
}//end else

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>YA Reads Book Reviews</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper"><!--begin wrapper-->
	<?php include("admin/includes/header.php"); //include header ?>
    <div id="feature"><!--begin feature-->
    
    	<div class="breadcrumbs"><a href="index.php">Home</a> > Books </div>
    
    </div><!--end feature-->
  <div id="content"><!--begin content-->
        
   		 <h4 class="sectiontitle"><span>Books</span></h4>
         <div id="books-left">
         <ul>
         	<li>Bookshelves</li>
            <li><a href="books.php">All</a></li>
            <li><a href="books.php?shelf=3">Read</a></li>
            <li><a href="books.php?shelf=2">Currently Reading</a></li>
            <li><a href="books.php?shelf=1">To Read</a></li>
         </ul>
         </div>
         <div id="books-right">
			<?php
            $result_book = query($sql_books); //calling query function
			
            while($arr_row_book = mysql_fetch_array($result_book)) 
            {//begin while
            		if($arr_row_book['shelf']==$shelf) //display books by shelf
					{
						echo ("<a href='book.php?isbn=".$arr_row_book['isbn']."'><img src='admin/".$arr_row_book['cover']."' width='100px' /></a> ");
					}
					if($shelf=="all") //display all books
					{
                    	echo ("<a href='book.php?isbn=".$arr_row_book['isbn']."'><img src='admin/".$arr_row_book['cover']."' width='100px' /></a> ");
					}
                
            }//end while
            ?>
        </div>
    
  </div><!--end content-->
   <?php include("admin/includes/sidebar.php");//include sidebar ?> 
    <?php include("admin/includes/front_footer.php");//include footer ?>
    
</div><!--end wrapper-->

</body>
</html>