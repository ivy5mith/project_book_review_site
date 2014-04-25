<?php 
session_start();
include("admin/includes/mysql_functions.php"); //include mysql_functions which also includes config.php
include("admin/includes/functions.php");
$review_id = $_GET['review_id'];
$sql_books = "SELECT isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover FROM books"; //Select books table, sql query
$sql_review = "SELECT review.review_id,review,rating,review_date,review.isbn,reviewer.reviewer_uname,books.cover,books.title,books.author FROM review INNER JOIN reviewer ON review.reviewer_id = reviewer.reviewer_id INNER JOIN books ON review.isbn = books.isbn WHERE review.review_id=".$review_id; //Select review table, sql query
$result = query($sql_review); //calling query function
$arr_row = mysql_fetch_array($result);
date_default_timezone_set("America/Vancouver"); //setting the timezone
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $arr_row['title']; ?> by <?php echo $arr_row['author']; ?> - YA Reads Book Reviews</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper"><!--begin wrapper-->
	<?php include("admin/includes/header.php"); ?>
    <div id="feature"><!--begin feature-->
    	<div class="breadcrumbs"><a href="index.php">Home</a> > <a href="reviews.php">Reviews</a> > <?php echo $arr_row['title']; ?> by <?php echo $arr_row['author']; ?> </div>
    </div><!--end feature-->
  <div id="content"><!--begin content-->
    <div class="content-header"><!--begin content-header-->
            <h1 class="content-title"><?php echo $arr_row['title']; ?> by <?php echo $arr_row['author']; ?></h1>
            <div class="small">Reviewed by <?php  echo ($arr_row['reviewer_uname']." on ".date("F j, Y",strtotime($arr_row['review_date']))); ?>
            <?php 
			if(isset($_SESSION['reviewer']))//check if logged in
			{
				echo ("&nbsp;&nbsp;&nbsp;&nbsp;<a href='admin/edit_review_form.php?review_id=".$arr_row['review_id']."'>Edit Review</a>");
			}
			
			?>
            </div>
        </div><!--end content-header-->
        <div class="content-body"><!--begin content-body-->
        <img src="admin/<?php echo $arr_row['cover']; ?>" width="200" align="left"/>
        <?php 
		$file = "admin/".$arr_row['review'];//file path
		$review_text = file_get_contents($file); //get review contents from file
		echo $review_text;
		
		?>
        <div>Rating: <?php echo fun_rating($arr_row['rating']); ?></div>
        </div><!--end content-body-->
    
  </div><!--end content-->
    <?php include("admin/includes/sidebar.php"); ?>
    <?php include("admin/includes/front_footer.php"); ?>
    
</div><!--end wrapper-->

</body>
</html>