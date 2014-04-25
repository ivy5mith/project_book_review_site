<?php //this will display the sidebar at the front end of the site ?>
<div id="sidebar"><!--begin sidebar-->
    
        <div class="sidebar-group"><!--begin sidebar-group-->
            
            <center><a href="http://twitter.com" target="_blank"><img src="images/twitter.png" /></a> <a href="http://facebook.com" target="_blank"><img src="images/facebook.png" /></a> <a href="http://goodreads.com" target="_blank"><img src="images/goodreads.png" /></a></center>
        </div><!--end sidebar-group-->
        <div class="sidebar-group"><!--begin sidebar-group-->
            <h4 class="sectiontitle"><span>Currently Reading</span></h4>
            <?php 
			fun_sidebar_shelf(2,$sql_books); //calling function fun_sidebar_shelf to display 3 or less books in shelf currently reading. see functions.php
            ?>
        </div><!--end sidebar-group-->
        
        <div class="sidebar-group"><!--begin sidebar-group-->
            <h4 class="sectiontitle"><span>To Read</span></h4>
            <?php 
			fun_sidebar_shelf(1,$sql_books); //calling function fun_sidebar_shelf to display 3 or less books in shelf to read. see functions.php
            ?>
            
        </div><!--end sidebar-group-->
        

    
    </div><!--end sidebar-->