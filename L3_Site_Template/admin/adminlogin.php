<?php 

if(isset($_REQUEST['login'])){

    //get username from form
    $username = $_REQUEST['username'];

    $options = ['cost' => 8,];

    //get username and hashed password from database
    $login_sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $login_query=mysqli_query($dbconnect, $login_sql);
    $login_rs=mysqli_fetch_assoc($login_query);

    // Hash password and comapre with password in database
    if(password_verify($_REQUEST['password'], $login_rs['password'])){

        //password matches
        echo 'Password is valid!';
        $_SESSION['admin']=$login_rs['username'];
        header("Location: index.php?page=../admin/new_quote");

    } // end valid password if
    
    // invalid password
    else{
        echo 'Invalid password';
        unset($_SESSION);
        $login_error="Incorrect username / password";
        header("Location: index.php?page=../admin/login&error=$login_error");
    } //end invalid password else

} //end isset login if

?>