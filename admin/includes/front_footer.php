 <div id="footer"><!--begin main site footer-->
   <div> 
   <?php
		include("admin/includes/links.php");//links array declaration
		echo("<a href='index.php'>Home</a>");//display home link
		$array_count = count($arr_links)-1;//get array count
		for($num_cnt=0;$num_cnt<$array_count;$num_cnt++)
		{//begin for
			echo(" | <a href='".$arr_links[$num_cnt].".php'>".ucwords($arr_links[$num_cnt])."</a>");
		}//end for
		if(isset($_SESSION['reviewer']))//check if logged in
		{//begin if
			echo(" | <a href='admin/index.php'>Admin</a>");//display admin link if already logged in
		}//enf if
		else
		{//begin else
		echo(" | <a href='admin/login.php'>Login</a>");//display login link
		}//end else
        ?>
 
   </div>
     <div>© Copyright <?php echo(date("Y")); ?>. Site by <a href="#">Ivy Smith</a></div>
     </div><!--end footer-->