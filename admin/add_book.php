<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}
?>
<?php $title="Book Added" //Declaring the meta title  ?>

<?php
include("includes/mysql_functions.php"); //include mysql_functions which also includes config.php
include("includes/functions.php");
//Declaring the values
$isbn = $_POST['isbn'];
$title = $_POST['title'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$publish_date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
$summary = $_POST['summary'];
$added_by = $_SESSION['reviewer']['reviewer_id'];
$shelf = $_POST['shelf'];

//the following code will upload a book cover image
$allowed_filetypes = array('.jpg','.jpeg','.png','.gif'); //restrict to only these extensions
$max_filesize = 1048576; //max file size
$upload_path = 'images/'; //upload path

$filename = $_FILES['cover']['name']; //filename

if($filename==NULL)//if there is no cover image uploaded
{//begin if
	$cover="images/nocover.png";
}//end if
else
{//begin else
	$cover=fun_image_upload('cover',$allowed_filetypes,$max_filesize,$upload_path,$filename);//calling function image_upload, see functions.php
}//end else

if($isbn!=NULL) //So that when this page is run without going to the add book form first it would not create an empty row
{//begin if

	$return_result = fun_insert("isbn",$isbn,"books","isbn,title,author,publisher,publish_date,summary,added_by,shelf,cover","'".$isbn."','".$title."','".$author."','".$publisher."','".$publish_date."','".htmlspecialchars($summary, ENT_QUOTES)."','".$added_by."','".$shelf."','".$cover."'"); //calling function insert, see functions.php

}//end if

else
{
	die("Please enter an ISBN.");	
}

?>

<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>


    
<?php
if($return_result==0)
{?>
<div id="header"><!-- begin  -->
 Book already exist. 
</div><!-- end  -->
<?php	
}
else
{
?>
<div id="header"><!-- begin  -->
 <h2>Thank You</h2>
</div><!-- end  -->
<div id="content"> <!-- begin  -->
<p>You have submitted the following information:</p>
<table align="center" class="narrowform"><!-- Begin table -->

<tr>
	<th class="label">Cover</th>
	<td ><?php echo("<img src='".$cover."' width='150' />"); //Display Cover ?></td>
</tr>

<tr>
	<th class="label">ISBN</th>
	<td ><?php echo($isbn); //Display ISBN ?></td>
</tr>

<tr>
	<th class="label">Title</th>
	<td><?php echo($title); //Display Title ?></td>
</tr>

<tr>
	<th class="label">Author</th>
	<td><?php echo($author); //Display Author ?></td>
</tr>

<tr>
	<th class="label">Publisher</th>
	<td><?php echo($publisher); //Display Publisher ?></td>
</tr>

<tr>
	<th class="label">Published</th>
	<td><?php echo($publish_date); //Display Publish Date ?></td>
</tr>

<tr>
	<th class="label">Summary</th>
	<td><?php echo($summary); //Display Summary ?></td>
</tr>

<tr>
	<th class="label">Shelf</th>
	<td>
	<?php 
	//Display Shelf 
	if($shelf==2){
		echo("Currently Reading");
	}
	elseif($shelf==3){
		echo("Read");
	}
	else{
		echo("To Read");
	}
	?>
    </td>
</tr>


</table><!-- End table -->
<?php	
}
?>
<p><a href="books.php">Go back to Admin page</a></p>
</div>
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>