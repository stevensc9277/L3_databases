<h2>All Results</h2>

<?php

$find_sql = "SELECT * FROM `quotes` 
JOIN author ON (`author`.`Author_ID` = `quotes`.`Author_ID`)";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);

// Loop through results and display them
do {

    $quote = preg_replace('/[^A-Za-z0-9.,\s\'\-]/', ' ', $find_rs['Quote']);
    
    //author name...
    $first = $find_rs['First'];
    $middle = $find_rs['Middle'];
    $last = $find_rs['Last'];

    $full_name = $first." ".$middle." ".$last;
    ?>
<div class="results">
    <p>
    <?php echo $quote; ?> <br />
    <a href="index.php?page=author&authorID=<?php echo $find_rs['Author_ID']?>">
    <?php echo $full_name; ?>
    </a>
    </p>

    <!-- subject tags go here -->
    <p>


    </p>
</div>

<br/>

<?php
}   // end of display results do

while($find_rs = mysqli_fetch_assoc($find_query))


?>