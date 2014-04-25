<?php

//This function will create a date dropdown menu
function fun_date($num_first,$num_last,$str_name,$selected) 
{//begin fun_date function
	
$str_menu = "<select name='".$str_name."'>";//Begin SELECT tag
for($num_count=$num_first;$num_count<=$num_last;$num_count++) 
{ //Begin FOR loop
	if ($num_count == $selected)
	{
	$str_menu .="<option value='".$num_count."' selected>".$num_count."</option>";
	}
	else{
	$str_menu .="<option value='".$num_count."'>".$num_count."</option>";
	}
} //End FOR loop 

$str_menu .="</select>";//End SELECT tag
return $str_menu; //return menu
}//end fun_date function

//This function will insert a row into the database
//fun_insert(the unique entity in db to check if exist, the unique entity entered by user,the table where the row will be inserted, the entities to be inserted, the values to be inserted)
function fun_insert($id1,$id2,$table,$into,$values)
{//begin fun_insert
$num_rows = 0;
if($id1&&$id2!==0)
{
	//check if entity already exist
	$sql_select = "SELECT ".$id1." FROM ".$table." WHERE ".$id1."='".$id2."'"; //select entity to be checked if already exist
	$select_result = query($sql_select);
	$num_rows = mysql_num_rows($select_result);
}

if($num_rows>0)//check if $num_rows is not empty
{//begin if
//$arr_row = mysql_fetch_array($select_result);
	$return_result=0; //return 0 if not empty
}//end if
else
{//begin else
	
	$sql = "INSERT INTO ".$table."(".$into.") VALUES(".$values.")"; 
	$result = query($sql); //calling query function in mysql_functions.php	
	$return_result=1;
}//end else	


return $return_result;

}//end fun_insert

//This function will select a row from the database
//array fun_select(select string,table,condition)
function fun_select($str_select,$table,$condition)
{//begin fun_select
$sql = "SELECT ".$str_select." FROM ".$table." WHERE ".$condition; //Select table with condition, sql query
$result = query($sql); //calling query function
$arr_row = mysql_fetch_array($result);	
return $arr_row;//return array
}//end fun_select



//This function will upload an image
function fun_image_upload($str_photo,$allowed_filetypes,$max_filesize,$upload_path,$filename)
{//begin fun_image_upload

$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); //extension
if(!in_array($ext,$allowed_filetypes))//check if extension is allowed
  die('The file you attempted to upload is not allowed.');

if(filesize($_FILES[$str_photo]['tmp_name']) > $max_filesize)//check if image is within the allowed file size
  die('The file you attempted to upload is too large.');

if(!is_writable($upload_path))//check if path is writable
  die('You cannot upload to the specified directory, please CHMOD it to 777.');

if(move_uploaded_file($_FILES[$str_photo]['tmp_name'],$upload_path.$filename)) //move the image to designated folder
{//begin if
   $image = $upload_path.$filename;
} //end if

return $image;	
}//end fun_image_upload

//This function will display 3 or less books in the sidebar per shelf
function fun_sidebar_shelf($shelf,$sql_books)
{
	//display books in shelf --- shelf 1 = "To Read", shelf 2 = "Currently Reading", shelf 3 = "Read"
			$result = query($sql_books); //calling query function
			$str_left = "left"; //class float left
			$str_right = "right";//class float right
			$count = 0;
			while($arr_row = mysql_fetch_array($result)) 
			{
			if ($arr_row['shelf'] == $shelf) //if in shelf
			{//begin if $arr_row['shelf'] == $shelf
				if($count < 3) //display only 3 books from shelf 2
				{//begin if $count < 3
					if($count%2==0) //alternate class left and right
					{//begin if $count%2==0
						echo("<div class='sidebar-items'><a href='book.php?isbn=".$arr_row['isbn']."'><img src='admin/".$arr_row['cover']."' class='".$str_right."' /></a><a href='book.php?isbn=".$arr_row['isbn']."'>".$arr_row['title']." - ".$arr_row['author']."</a><br/><div class='small'>".date("F j, Y",strtotime($arr_row['date_added']))."</div></div>");
					}//enf if $count%2==0
					else {//begin else
						echo("<div class='sidebar-items'><a href='book.php?isbn=".$arr_row['isbn']."'><img src='admin/".$arr_row['cover']."' class='".$str_left."' /></a><a href='book.php?isbn=".$arr_row['isbn']."'>".$arr_row['title']." - ".$arr_row['author']."</a><br/><div class='small'>".date("F j, Y",strtotime($arr_row['date_added']))."</div></div>");
					}//end else
				$count++;
				}//end if $count < 3
			}//end if $arr_row['shelf'] == $shelf
			}
			$result = array();
			$arr_row = array();
}

//this funtion will display the rating stars
function fun_rating($rating) 
{//begin fun_rating
	
	for($count=0;$count<$rating;$count++)
	{//begin for
		echo("<img src='images/star.png' width='14px' height='16px' />");
	}//end for
	
}//end fun_rating


?>