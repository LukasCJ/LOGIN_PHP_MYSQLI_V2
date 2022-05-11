<?php

if (isset($_POST["submit"])) {
    $username = $_POST["uid"]; //the variable username works for both email and username
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);
}
else {
    header("location: ../login.php");
    exit();
}