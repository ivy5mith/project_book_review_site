<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}
$this_page="books";//setting this_page for the nav
?>
<?php $title="Edit Book" //Declaring the meta title  ?>
<?php 
include("includes/mysql_functions.php");
include("includes/functions.php");
$isbn = $_GET['isbn'];

$arr_row = fun_select("isbn,title,author,publisher,publish_date,summary,date_added,added_by,shelf,cover","books","isbn='".$isbn."'");
//call select function see functions.php

list($year,$month,$day)=explode("-", $arr_row['publish_date']); //separate year month and day with the delimeter "-"


?>

<?php include("includes/head.php");//inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>

<div id="header"> <!-- begin header -->
<h2>Update  <?php echo $arr_row['title']; ?> by <?php echo $arr_row['author']; ?></h2></div><!-- end header -->
<div id="content"> <!-- begin content -->
<form method="POST" action="edit_book.php" enctype="multipart/form-data"> <!-- Begin form -->
<table align="center"> <!-- Begin table -->


<tr>
	<th class="label">Title*</th>
	<td><input type="text" name="title" maxlength="50" class="form-text" value="<?php echo($arr_row['title']) ?>" /></td>
</tr>

<tr>
	<th class="label">Author*</th>
	<td><input type="text" name="author" maxlength="30" class="form-text" value="<?php echo($arr_row['author']) ?>" /></td>
</tr>

<tr>
	<th class="label">Publisher</th>
	<td><input type="text" name="publisher" maxlength="30" class="form-text" value="<?php echo($arr_row['publisher']) ?>" /></td>
</tr>

<tr>
	<th class="label">Published</th>
	<td>
    
    Year: <input type="number" name="year" maxlength="4" value="<?php echo($year); ?>" /> Month: <?php echo(fun_date(1,12,"month",$month)); //Display month by calling date function ?> Day: <?php echo(fun_date(1,31,"day",$day)); //Display day by calling date function ?> 
    
    </td>
</tr>

<tr>
	<th class="label">Summary</th>
	<td><textarea rows="10" cols="100" name="summary" class="form-textarea" /><?php echo($arr_row['summary']) ?></textarea></td>
</tr>
<tr>
	<th class="label">Shelf</th>
	<td >
    <?php
	$str_menu = "<select name='shelf' class='form-dropdown'>";//Begin SELECT tag
    for($num_count=1;$num_count<=3;$num_count++) 
{ //Begin FOR loop
	if ($num_count == $arr_row['shelf'])
	{
	$str_menu .="<option value='".$num_count."' selected>";	
	}
	else{
	$str_menu .="<option value='".$num_count."'>";
	}
	if($num_count==1)
	{
		$str_menu .="To Read</option>";	
	}
	if($num_count==2)
	{
		$str_menu .="Currently Reading</option>";	
	}
	if($num_count==3)
	{
		$str_menu .="Read</option>";	
	}
} //End FOR loop 
    echo($str_menu);
    ?>
    </select>
    </td>
</tr>
<tr>
	<th class="label">Update the cover image for this book</th>
	<td >

     <input type="hidden" name="cover" value="<?php echo($arr_row['cover']); ?>" />
     <input type="file" name="cover">
     
     <!--<input type="hidden" name="added_by" value="<?php //echo($arr_row['added_by']); ?>" /> 
     <input type="hidden" name="date_added" value="<?php //echo($arr_row['date_added']); ?>" />-->
     <input type="hidden" name="isbn" value="<?php echo($arr_row['isbn']) ?>" />
    </td>
</tr>
<tr>
	<td colspan="2">
 		<?php echo("<img src='".$arr_row['cover']."' width='150' />"); //Display Cover ?>
 	</td>
</tr>
<tr>
	
	<td colspan="2" Align="center"><input type="submit" name="submit" value="Edit Book" /></td>
</tr>

</table> <!-- End table -->
</form> <!-- End form -->
*denotes required field
<p><a href="books.php">Go back to Admin page</a></p>
</div> <!-- end content -->
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>