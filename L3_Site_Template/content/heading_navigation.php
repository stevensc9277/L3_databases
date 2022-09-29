<!-- Navigation goes here.  Edit BOTH the file name and the link name -->
<div class="box nav">
    
    <div class="linkwrapper">
        <div class="commonsearches">
            <a href="index.php?page=showall">All</a> | 
            <a href="index.php?page=recent">Recent</a> | 
            <a href="index.php?page=random">Random</a> 
        </div>  <!-- / common searches -->
    
        <div class="topsearch">
            
            <!-- Quick Search -->           
            <form method="post" action="index.php?page=quick_search" enctype="multipart/form-data">

                <input class="search quicksearch" type="text" name="quick_search" size="40" value="" required placeholder="Quick Search..." />

                <input class="submit" type="submit" name="find_quick" value="&#xf002;" />

            </form>     <!-- / quick search -->
            
        </div>  <!-- / top search -->
        
        <div class="topadmin">
            
            <?php 
            if(isset($_SESSION['admin'])) {

            ?>

            <a href="index.php?page=../admin/new_quote" title="Add a quote"><i class="fa fa-plus fa-2x"></i></a> &nbsp; &nbsp;
            <a href="index.php?page=../admin/logout" title="Log out"><i class="fa fa-sign-out fa-2x"></i></a>

            <?php

            } // end user is logged in if

            else{
                ?>
                <a href="index.php?page=../admin/login" title="Login"><i class="fa fa-sign-in fa-2x"></i></a>
                <?php
            }
            ?>
            
        </div>  <!-- / top admin -->
        
    </div>  <!--- / link wrapper -->
    
</div>    <!-- / nav -->        
