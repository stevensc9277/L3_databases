<!DOCTYPE HTML>

<?php

session_start();
include("config.php");
include("functions.php");

// Connect to database...
$dbconnect=mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(mysqli_connect_errno()){
    echo "Connection failed:".mysqli_connect_error();
    exit;
}
?>


<html lang="en">

<?php include("content/head.php"); ?>
    
<body>
    
    <div class="wrapper">
    
            <?php include("content/heading_navigation.php"); ?>
        
        <div class="box banner">
            
    
            <h1><a href="index.php">Quick Quotes</a></h1>
        </div>    <!-- / banner -->

       
        <div class="box main">
            <?php 
            
            if(!isset($_REQUEST['page'])){
                include("content/home.php");
            } //end of if that includes home page
            
            else{
                //prevents users from navigating through file system
                $page=preg_replace('/[^0-9a-zA-Z]-/', '', $_REQUEST['page']);
                include("content/$page.php");
            } // end of else that includes requested content
            
            ?>
        </div>    <!-- / main -->
        

        <div class="box footer">
            CC stevensc9277 2022
        </div>    <!-- / footer -->
    
    </div>  <!-- / wrapper  -->
    
</body>        
