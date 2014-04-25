<?php 
session_start();
include("admin/includes/mysql_functions.php"); //include mysql_functions which also includes config.php
include("admin/includes/functions.php");
$sql_books = "SELECT isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover FROM books"; //Select books table, sql query
$sql_reviews = "SELECT review_id,review,rating,review_date,review.isbn,reviewer.reviewer_uname,books.cover,books.title,books.author FROM review INNER JOIN reviewer ON review.reviewer_id = reviewer.reviewer_id INNER JOIN books ON review.isbn = books.isbn"; //Select books table, sql query

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
    	<div class="breadcrumbs"><a href="index.php">Home</a> > About Us</div>
    
    </div><!--end feature-->
  <div id="content"><!--begin content-->
        <h4 class="sectiontitle"><span>Contact Us</span></h4>
        
       <p align="justify">Email us at <a href="mailto:yareaders@gmail.com">yareaders@gmail.com</a></p>
    
  </div><!--end content-->
    <?php include("admin/includes/sidebar.php"); ?>
    <?php include("admin/includes/front_footer.php"); ?>
    
</div><!--end wrapper-->

</body>
</html>