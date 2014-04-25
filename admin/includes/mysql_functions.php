<?php
include("config.php");//include config.php which containes all variables to connect to the DB

function dbconnect()
{//begin dbconnect function

	global $db_name,$db_host,$db_username,$db_password,$link; //keyword "global" makes the variable outside the function available inside the function and vice versa

//mysql_pconnect() function that connects to the server.  Returns a resource ID
	if(!$link = @mysql_pconnect($db_host,$db_username,$db_password))
	{//begin if $link
		$str_error = "Sorry we are having trouble with our servers. Please try again later.";
		err_msg($str_error);	
		return 0; //get out of function because you can't connect to server, the server is not working
	}//end if $link
	
	if(!(@mysql_select_db($db_name,$link))) //if you don't have access to database
	{//begin if connection to db
		$str_error="Sorry the database cannot be accessed at this time. Please try again later.";
		err_msg($str_error);
		return 1; // return 1 so that you would know what the outcome of the connection is. you can return any value to let you know if you connected or not
	}//end if connection to db
	
	return $link;
	
}//end dbconnect function

function err_msg($str_msg)
{
	echo("<h2 align='center'><strong>".$str_msg."</strong></h2>");
}

function query($sql)
{//begin query fuction
	
	global $link; //make $link global in dbconnect function and define it as global in this function as well
	
	if(!$result=@mysql_query($sql,$link))//function to execute the query
	{//begin if cannot access database
		$str_error="Sorry cannot access information at this time.  Please try again later.";		
		err_msg($str_error);
		return 1;
	}//enf if cannot access database
	return $result;
}//end query function



dbconnect();

?>