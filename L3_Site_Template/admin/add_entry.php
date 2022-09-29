<?php 

//check user is logged in...
if(isset($_SESSION['admin'])){

    $author_ID = $_SESSION['Add_Quote'];
    echo "AuthorID: ".$author_ID;

    //get subject / topic list from database
    $all_tags_sql = "SELECT * FROM `subject` ORDER BY `Subject` ASC ";
    $all_subjects = autocomplete_list($dbconnect, $all_tags_sql, 'Subject');

    //initialise form variables for quote
    $quote = "Please type your quote here";
    $notes = "";
    $tags_1 = "";
    $tags_2 = "";
    $tags_3 = "";

    //initialise tag ID's
    $tag_1_ID = $tag_2_ID = $tag_3_ID = 0;

    $has_errors = "no";

    // set up error fields / visibility
    $quote_error = $tag_1_error = "no-error";
    $quote_field = "form-ok";
    $tag_1_field = "tag-ok";
    $tag_2_field = "tag-ok";
    $tag_3_field = "tag-ok";

    

// code below executes when the form is submitted...
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //get data from form
    $quote = mysqli_real_escape_string($dbconnect, $_POST['quote']);
    $notes = mysqli_real_escape_string($dbconnect, $_POST['notes']);
    $tag_1 = mysqli_real_escape_string($dbconnect, $_POST['Subject_1']);
    $tag_2 = mysqli_real_escape_string($dbconnect, $_POST['Subject_2']);
    $tag_3 = mysqli_real_escape_string($dbconnect, $_POST['Subject_3']);
    //check data is valid

    //check quote is not blank
    if($quote == "Please type your quote here" or $quote == ""){
        $has_errors="yes";
        $quote_error="error-text";
        $quote_field="form-error";
    }

    // check that first subject has been filled in
    if($tag_1 == ""){
        $has_errors="yes";
        $tag_1_error="error-text";
        $tag_1_field="tag-error";
    }

    if($has_errors != "yes"){

        // get subject ID's via get_ID function...
        $subjectID_1 = get_ID($dbconnect, 'subject', 'Subject_ID', 'Subject', $tag_1);
        $subjectID_2 = get_ID($dbconnect, 'subject', 'Subject_ID', 'Subject', $tag_2);
        $subjectID_3 = get_ID($dbconnect, 'subject', 'Subject_ID', 'Subject', $tag_3);
        
        // add entry to database
        $addentry_sql = "INSERT INTO `quotes` (`ID`, `Author_ID`, `Quote`, `Notes`, `Subject1_ID`, `Subject2_ID`, `Subject3_ID`) VALUES ('0', '$author_ID', '$quote', '$notes', '$subjectID_1', '$subjectID_2', '$subjectID_3');";
        $addentry_query = mysqli_query($dbconnect, $addentry_sql);

    }   // end add entry to database if

}   // end submit button if

} //end user logged in if



else{

    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");

} // end user not logged in else

?>

<h1>Add Quote...</h1>

<form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/add_entry");?>" enctype="multipart/form-data">

<!-- Quote text areas -->
<div class="<?php echo $quote_error; ?>">
This field can't be blank
</div>

<textarea class="add-field <?php echo $quote_field?>" name="quote" rows="6"><?php echo $quote; ?></textarea>

<br/><br/>
<input class="add-field <?php echo $notes; ?>" type="text" name="notes" value="<?php echo $notes; ?>" placeholder="Notes (optional)..."/>

<br/><br/>

<div class="<?php echo $tag_1_error ?>">
    Please enter at least one subject tag
</div>
<div class="autocomplete">
    <input class="<?php echo $tag_1_field; ?>" id="subject1" type="text" value="<?php echo $tag_1 ?>" name="Subject_1" placeholder="Subject 1 (Start Typing)...">
</div>

<br/><br/>

<div class="autocomplete">
    <input class="<?php echo $tag_2_field; ?>" id="subject2" type="text" name="Subject_2" placeholder="Subject 2 (Start Typing, optional)...">
</div>

<br/><br/>

<div class="autocomplete">
    <input class="<?php echo $tag_3_field; ?>" id="subject3" type="text" name="Subject_3" placeholder="Subject 3 (Start Typing, optional)...">
</div>

<br/><br/>
<!-- submit button -->
<p>
    <input type="submit" value="Submit" />
</p>

</form>

<!-- script to make autocomplete work -->
<script>
    <?php include("autocomplete.php"); ?>

    /* arrays containing lists */
    var_all_tags = <?php print("$all_subjects"); ?>;
    autocomplete(document.getElementById("subject1"), all_tags);
    autocomplete(document.getElementById("subject2"), all_tags);
    autocomplete(document.getElementById("subject3"), all_tags);

</script>