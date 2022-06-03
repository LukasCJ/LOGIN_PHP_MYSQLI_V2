<?php

if (isset($_POST["submit"])){
    
    // $id och $type är redan skapade i item.php (tror jag)
    $rating = $_POST["rating"];
    $date = $_POST["date"];
    $user_id = $_SESSION["userid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (invalidRating($rating)) {
        header("location: ../item.php?type=?id=?error=invalid");
        exit();
    }

    if ($date) {
        createEntry($conn, $rating, 0, $user_id, $type, $id, 0, $date, 0)
    } else {
        rate($conn, $user_id, $type, $id, $rating, 0)
    }
}
else {
    header("location: ../signup.php");
    exit();
}