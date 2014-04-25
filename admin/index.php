<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}

?>
<?php $title="Welcome" //Declaring the meta title?>
<?php 
include("includes/mysql_functions.php");
include("includes/functions.php");


$sql_books = "SELECT cover,isbn FROM books ORDER BY date_added DESC";
$result=query($sql_books);


?>
<?php include("includes/head.php"); //inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>

<div id="header"><h2>Welcome back <?php echo $_SESSION['reviewer']['reviewer_uname']; ?>!</h2></div>
    <div id="content">
    <h3 align="left">Recently added books:</h3>
    <?php
	while($arr_row = mysql_fetch_array($result)) 
            {//begin while
            		
						echo ("<a href='../book.php?isbn=".$arr_row['isbn']."'><img src='".$arr_row['cover']."' width='100px' /></a> ");
					
                
            }//end while
	
	?>
    </div>
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>
