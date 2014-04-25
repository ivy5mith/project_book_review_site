<?php 
session_start();
include("admin/includes/mysql_functions.php"); //include mysql_functions which also includes config.php
include("admin/includes/functions.php");
if(isset($_GET['sort'])) //if sort is defined then get value
{//begin if
	$sort=$_GET['sort'];
}//end if
else 
{//begin else
	$sort = " ORDER BY review_date DESC"; //else order by review date (default sort)
}//end else
$sql_books = "SELECT isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover FROM books"; //Select books table, sql query
$sql_reviews = "SELECT review.review_id,review,rating,review_date,review.isbn,reviewer.reviewer_uname,books.cover,books.title,books.author FROM review INNER JOIN reviewer ON review.reviewer_id = reviewer.reviewer_id INNER JOIN books ON review.isbn = books.isbn"; //Select books table, sql query

if($sort=="dateasc") //if sort by date ascending
{//begin if
	$sort = " ORDER BY review_date ASC";
}//end if
if($sort=="title") //if sort by title
{//begin if
	$sort = " ORDER BY books.title ASC";
}//end if
if($sort=="rating") //if sort by rating
{//begin if
	$sort = " ORDER BY rating DESC";
}//end if
if($sort=="datedesc") //if sort by date descending
{//begin if
	$sort = " ORDER BY review_date DESC";
}//end if

$sql_reviews .= $sort; //append sort to query

date_default_timezone_set("America/Vancouver"); //setting the timezone
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
	<?php include("admin/includes/header.php"); ?>
    <div id="feature"><!--begin feature-->
    
    	<div class="breadcrumbs"><a href="index.php">Home</a> > Reviews </div>
    
    </div><!--end feature-->
  <div id="content"><!--begin content-->
        
   		 <h4 class="sectiontitle"><span>Reviews</span></h4>
         <p align="left">Sort by: <span><a href="reviews.php?sort=datedesc">Date (Descending)</a> | </span><span><a href="reviews.php?sort=dateasc">Date (Ascending)</a> | </span><span><a href="reviews.php?sort=title">Title</a> | </span><span><a href="reviews.php?sort=rating">Rating</a> | </span></p>
    	<?php
		$result_review = query($sql_reviews); //calling query function
		
		while($arr_row_review = mysql_fetch_array($result_review)) 
		{//begin while
			
				$file = "admin/".$arr_row_review['review'];//file path
				$review_text = file_get_contents($file); //get review contents from file
				$review_excerpt = substr($review_text, 0, 500)."...";
	
				echo("<div class='post-block'><!--begin post-block-->");
					echo("<div class='post-img'><a href='page.php?review_id=".$arr_row_review['review_id']."'><img src='admin/".$arr_row_review['cover']."' /></a></div>");
					echo("<div class='post-content'><!--begin post-content-->");
					echo("<div class='post-title'><a href='page.php?review_id=".$arr_row_review['review_id']."'>".$arr_row_review['title']." - ".$arr_row_review['author']."</a></div>");
					echo("<div class='small'>Reviewed by ".$arr_row_review['reviewer_uname']." on ".date("F j, Y",strtotime($arr_row_review['review_date']))." ".fun_rating($arr_row_review['rating'])."</div>");
						echo($review_excerpt);
						echo("<p><a href='page.php?review_id=".$arr_row_review['review_id']."'>Read Post</a></p>");
				 	echo("</div><!--end post-content-->");
				echo("</div><!--end post-block-->");
		
		
		}//end while
		
    ?>
    
  </div><!--end content-->
   <?php include("admin/includes/sidebar.php"); ?>
    <?php include("admin/includes/front_footer.php"); ?>
    
</div><!--end wrapper-->

</body>
</html>