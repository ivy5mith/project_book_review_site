<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}

?>
<?php
//update book info
include("includes/mysql_functions.php"); 
include("includes/functions.php");
//Declaring the values
$isbn = $_POST['isbn'];
$title = $_POST['title'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$publish_date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
$summary = $_POST['summary'];
//$date_added = $_POST['date_added'];
//$added_by = $_POST['added_by'];
$shelf = $_POST['shelf'];
$cover = $_POST['cover'];

//script for uploading book cover images
$allowed_filetypes = array('.jpg','.jpeg','.png','.gif'); //restrict to only these extensions
$max_filesize = 1048576; //max file size
$upload_path = 'images/'; //upload path

$filename = $_FILES['cover']['name']; //filename

if($filename!=NULL)
{//begin else
	$cover=fun_image_upload('cover',$allowed_filetypes,$max_filesize,$upload_path,$filename);//calling function image_upload, see functions.php
}//end else



//sql query to modify row 
$sql_update = "UPDATE books SET title='".$title."',author='".$author."',publisher='".$publisher."',publish_date='".$publish_date."',summary='".htmlspecialchars($summary, ENT_QUOTES)."',shelf='".$shelf."',cover='".$cover."' WHERE isbn='".$isbn."'"; 
//echo $sql_update;
query($sql_update); //calling query function
header("location:books.php"); //browser redirection
?>