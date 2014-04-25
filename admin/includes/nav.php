<div id="nav">
<?php
//Admin Navigation
//Declaring an array of links
$arr_links[] = array();
$arr_links[0] = "books";
$arr_links[1] = "reviews";
$arr_links[2] = "reviewers";

echo("<div class='sidebar-link'><span><a href='index.php'>Home</a></span></div>"); //Link to home page
if(!isset($this_page))
{//begin if
	$this_page=""; //if this page is not set then declare it as blank
}//end if



//Loop that will output the links
for($num_cnt=0;$num_cnt<=2;$num_cnt++)
{//begin for loop

	echo("<div class='sidebar-link'><span><a href='".$arr_links[$num_cnt].".php'>Manage ".ucwords($arr_links[$num_cnt])."</a></span></div>");
	if($arr_links[$num_cnt]==$this_page) //if link is equal to this_page
	{//begin if
		if($this_page=="books")
		{//begin if
			echo ("<div class='sidebar-child'><span class='link-child'><a href='add_book_form.php'>Add Book</a></span></div>");
			echo ("<div class='sidebar-child'><span class='link-child'><a href='search_books.php'>Search</a></span></div>");
		
		}//end if
		if($this_page=="reviewers")
		{//begin if
			echo ("<div class='sidebar-child'><span class='link-child'><a href='add_reviewer_form.php'>Add Reviewer</a></span></div>");
		
		}//end if
		if($this_page=="reviews")
		{//begin if
			echo ("<div class='sidebar-child'><span class='link-child'><a href='add_review_booklist.php'>Add Review</a></span></div>");
		
		}//end if
	}//end if
}//end for loop

echo("<div class='sidebar-link'><span><a href='logout.php'>Logout</a></span></div>"); //Logout
?>
</div>