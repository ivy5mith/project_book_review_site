<?php 
session_start();
include("admin/includes/mysql_functions.php"); //include mysql_functions which also includes config.php
include("admin/includes/functions.php");
$isbn = $_GET['isbn'];
$sql_books = "SELECT isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover FROM books"; //Select books table for sidebar
$sql_book = "SELECT isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover,review_id FROM books WHERE books.isbn ='".$isbn."'";
/*$sql_book = "SELECT books.isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover,books.review_id,review.review,review.rating,review.review_date,reviewer.reviewer_uname FROM books RIGHT JOIN review ON books.review_id = review.review_id INNER JOIN reviewer ON review.reviewer_id = reviewer.reviewer_id WHERE books.isbn ='".$isbn."'";*/
$result = query($sql_book); //calling query function
$arr_row = mysql_fetch_array($result);
$sql_book_review = "SELECT books.isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover,books.review_id,review.review,review.rating,review.review_date,reviewer.reviewer_uname FROM books RIGHT JOIN review ON books.review_id = review.review_id INNER JOIN reviewer ON review.reviewer_id = reviewer.reviewer_id WHERE books.isbn ='".$isbn."'";
/*$sql_book_review = "SELECT books.isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover,review.review_id,review.review,review.rating,review.review_date,reviewer_uname FROM books INNER JOIN review ON books.isbn = review.isbn INNER JOIN reviewer ON review.reviewer_id = reviewer.reviewer_id WHERE books.isbn ='".$isbn."'";*/
$result_review = query($sql_book_review); //calling query function
$arr_row_review = mysql_fetch_array($result_review);
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
    	<div class="breadcrumbs"><a href="index.php">Home</a> > <a href="books.php">Books</a> > <?php echo $arr_row['title']; ?> by <?php echo $arr_row['author']; ?></div>
    </div><!--end feature-->
  <div id="content"><!--begin content-->
    <div class="content-body"><!--begin content-body-->
        <div id="book">
        	<img src="admin/<?php echo $arr_row['cover']; ?>" height="300" align="left"/><h2><?php echo $arr_row['title']; ?></h2>
        	<p>by <?php echo $arr_row['author']; ?></p>
        	<p><?php echo $arr_row['summary']; ?></p>
			<?php
            if(isset($_SESSION['reviewer']))//check if logged in
			{
				echo ("<p><a href='admin/edit_book_form.php?isbn=".$arr_row['isbn']."'>Edit Book</a></p>");
			}
			?>
        </div>
		<div class="book-info">
			<p>Published <?php echo date("F j, Y",strtotime($arr_row['publish_date'])); ?> by <?php echo $arr_row['publisher']; ?></p>
			<p>ISBN <?php echo $arr_row['isbn']; ?></p>
            
        </div>

<h4 class="sectiontitle"><span>Review</span></h4>
<?php 
if($arr_row['review_id']==NULL)
{
	echo "No review for this book yet.";
	if(isset($_SESSION['reviewer']))
	{
		echo "<br/><a href='admin/add_review_form.php?isbn=".$arr_row['isbn']."'>Add a Review</a>";
	}	
}
else
{
?>
<div class="content-header"><!--begin content-header-->

            
            <div><?php  echo ("review by ".$arr_row_review['reviewer_uname']." on ".date("F j, Y",strtotime($arr_row_review['review_date']))); ?></div><div><?php echo fun_rating($arr_row_review['rating']);?></div>
            <div>
			<?php 
			if(isset($_SESSION['reviewer']))//check if logged in
			{
			echo ("<a href='admin/edit_review_form.php?review_id=".$arr_row['review_id']."'>Edit Review</a>"); 
			}
			?>
			</div>
        </div><!--end content-header-->

		<?php
        $file = "admin/".$arr_row_review['review'];//file path
		$review_text = file_get_contents($file); //get review contents from file
		echo $review_text;
        ?> 
        
 <?php } ?>       
        </div><!--end content-body-->
    
  </div><!--end content-->
    <?php include("admin/includes/sidebar.php"); ?>
    <?php include("admin/includes/front_footer.php"); ?>
    
</div><!--end wrapper-->

</body>
</html>