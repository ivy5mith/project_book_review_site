<div id="header"><a href="index.php"><img src="images/logo.png" /></a></div>
    <div id="nav"><!--begin nav-->
    	<div class="menu-link"><!--begin menu-link-->
        <?php
		//This will display the menu link at the fron-end of the site
		include("admin/includes/links.php");//links array declaration
		echo("<span class='menu-border'><a href='index.php'>Home</a></span>"); //display home link
		$array_count = count($arr_links);//get array count
		for($num_cnt=0;$num_cnt<$array_count;$num_cnt++)
		{//begin for
			echo("<span class='menu-border'><a href='".$arr_links[$num_cnt].".php'>".ucwords($arr_links[$num_cnt])."</a></span>"); //display links
		}//end for
		//echo("<span class='menu-border'><a href='admin/login.php'>Login</a></span>"); //display home link
        ?>
        </div><!--end menu-link-->
    </div><!--end nav-->