<?php

// SIGNUP & LOGIN

function emptyInputSignup($name, $email, $username, $pwd, $pwdRe) {
    $result;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRe)) {
        $result = true;
    } 
    else {
        $result = false;
    }
    return $result;
}

function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } 
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } 
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRe) {
    $result;
    if ($pwd !== $pwdRe) {
        $result = true;
    } 
    else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM `users` WHERE `uid` = ? OR `email` = ?;"; //checks whether either username or email are taken; checks wether they already exists in the "users" table
    $stmt = mysqli_stmt_init($conn); //prevents visitors from damaging the website by writing stuff in the input-fields. explained at 1:10:30 in the video
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd) {
    $sql = "INSERT INTO `users` (`name`, `email`, `uid`, `pwd`) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    } 
    else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $username); //the variable username works for both email and username, which is why it is included twice

    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["pwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["id"];
        $_SESSION["useruid"] = $uidExists["uid"];
        header("location: ../index.php");
        exit();
    }
}

// RATING

function avgRating($conn, $item_type, $item_id){ // tänkt att uppdatera varje gång någon betygsätter saken. borde man kanske göra så att den inte börjar från början varje gång?
    
    // skriven query för att hämta värden
    $sql = "SELECT `rating` FROM `ratings` WHERE `id` = $item_id AND `item_type` = $item_type AND `rating` >= 1;"; //
    
    // utför, hämta resultat
    $result = mysqli_query($conn, $sql);

    // fetch resulterande värden som en array, ett format vi kan använda
    $ratings = mysqli_fetch_array($result);
    
    // summera ratings
    $sum = array_sum($ratings);

    // medelvärde
    $avg = $sum / count($ratings);

    // för att uppdatera avg
    $sql = "UPDATE $item_type SET `rating` = $avg WHERE `id` = $item_id;";
    
    // utför
    mysqli_query($conn, $sql);
}

function rate($conn, $user_id, $item_type, $item_id, $rating, $like){

    // vet inte om nödvändigt men försäkrar att inga felaktiga betygsättningar smiter igenom
    if ($rating <= 0 || $ratings >= 5) {
        // något i stil med: header("location: ../log.php?error=wronglogin");
        exit();
    }

    // räknar antalet rader i ratings som uppfyller angivna kriterier
    $sql = "SELECT COUNT(*) FROM `ratings` WHERE `user_id` = $user_id AND `item_type` = $item_type AND `item_id` = $item_id;";
    
    // bestämmer om det finns en rad som ska uppdateras eller om en ny rad ska skapas
    if(mysqli_query($conn, $sql) >= 1){
        $sql = "UPDATE `ratings` SET `rating` = $rating AND `like` = $like WHERE `user_id` = $user_id AND `item_type` = $item_type AND `item_id` = $item_id;";
    } else {
        $sql = "INSERT INTO `ratings` (`user_id`, `item_type`, `item_id`, `rating`, `like`) VALUES ($user_id, $item_type, $item_id, $rating, $like);";
    }

    mysqli_query($conn, $sql);
}


function popularityAllTime(){
    //tar in hur många som sett via entries table
    //tar in när den släpptes
    //tar in genomsnittligt betyg (?)
    //formel: 
}

function popularityThisWeek(){
    //tar in hur många som sett denna veckan
    //tar in genomsnittligt betyg för denna veckan
    //formel:
    //$sql = "SELECT * FROM `entries` WHERE `uid` = ? OR `email` = ?;";
}