<?php 
session_start();
include("admin/includes/mysql_functions.php"); //include mysql_functions which also includes config.php
include("admin/includes/functions.php");
$sql_books = "SELECT isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover FROM books"; //Select books table, sql query
$sql_reviews = "SELECT review.review_id,review,rating,review_date,review.isbn,reviewer.reviewer_uname,books.cover,books.title,books.author FROM review INNER JOIN reviewer ON review.reviewer_id = reviewer.reviewer_id INNER JOIN books ON review.isbn = books.isbn ORDER BY review_date DESC"; //Select books table, sql query

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
    	<h4 class="featuretitle"><span>Featured Books</span></h4>
    
    	<div class="featured-books"><!--begin featured-books-->
        	<a href="book.php?isbn=0062024035"><img src="admin/images/13335037.jpg" /></a>
            <a href="book.php?isbn=1406310255"><img src="admin/images/2118745.jpg" /></a>
            <a href="book.php?isbn=1416914285"><img src="admin/images/256683.jpg" /></a>
            <a href="book.php?isbn=1907411054"><img src="admin/images/11594257.jpg" /></a>
        </div><!--end featured-books-->
    
    </div><!--end feature-->
  <div id="content"><!--begin content-->
        <h4 class="sectiontitle"><span>Featured Review</span></h4>
        
        <div class="post-block"><!--begin post-block-->
            <div class="post-img"><a href="page.php?review_id=22"><img src="images/11594257.jpg" /></a></div>
            <div class="post-content"><!--begin post-content-->
                <div class="post-title"><a href="page.php?review_id=22">Under the Never Sky - Veronica Rossi</a></div>
                <div class="small">Reviewed by Ivy on February 2, 2014</div>
                <p>WORLDS KEPT THEM APART.<br/>DESTINY BROUGHT THEM TOGETHER.</p>

<p>Aria has lived her whole life in the protected dome of Reverie. Her entire world confined to its spaces, she’s never thought to dream of what lies beyond its doors. So when her mother goes missing, Aria knows her chances of surviving in the outer wasteland long enough to find her are slim.</p>

<p>Then Aria meets an outsider named Perry. He’s searching for someone too. He’s also wil...</p>
                <p><a href="page.php?review_id=22">Read Post</a></p>
             </div><!--end post-content-->
    	</div><!--end post-block-->
   
    
   		 <h4 class="sectiontitle"><span>Recent Reviews</span></h4>
    	<?php
		$result_review = query($sql_reviews); //calling query function
		$count = 0;
		$page = 1;
		while($arr_row_review = mysql_fetch_array($result_review)) 
		{//begin while
			if($count<4)//display only 4 recent reviews
			{//begin if
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
				
			}//end if
		$count++;
		}//end while
		
    ?>
    
  </div><!--end content-->
    <?php include("admin/includes/sidebar.php"); ?>
    <?php include("admin/includes/front_footer.php"); ?>
    
</div><!--end wrapper-->

</body>
</html>