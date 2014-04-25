<?php 
session_start();
if(!isset($_SESSION['reviewer']))
{
	header("location:login.php");
}
$this_page="books"; //setting this_page for the nav
?>
<?php $title="Search for Books" //Declaring the meta title?>
<?php include("includes/head.php"); //inluding head.php in indcludes folder ?>
<?php include("includes/nav.php"); //inluding nav.php in indcludes folder ?>
<?php include("includes/content.php"); //inluding content.php in indcludes folder ?>



<div id="header"><h2>Search for Books</h2></div>
    <div id="content">
    <form action="book_search_result.php" method="POST">
    <table>
        <tr>
            <th class="label">ISBN</th>
            <td><input type="text" name="isbn" maxlength="13"  class="form-text" /></td>
        </tr>
        <tr>
            <th class="label">Title</th>
            <td><input type="text" name="title" maxlength="50"  class="form-text" /></td>
        </tr>
        <tr>
            <th class="label">Author</th>
            <td><input type="text" name="author" maxlength="30"  class="form-text" /></td>
        </tr>
        <tr>
			<td colspan="2" align="center"><input type="submit" name="search" value="Search" /></td>
		</tr>
    </table>
    </form>
    
    </div>
<?php include("includes/footer.php"); //inluding footer.php in indcludes folder ?>