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
    $sql = "SELECT * FROM `users` WHERE `uid` = ? OR `email` = ?;";
    $stmt = mysqli_stmt_init($conn);
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
    $uidExists = uidExists($conn, $username, $username);

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
    $sql = "SELECT `rating` FROM `ratings` WHERE `id` = $item_id AND `item_type` = $item_type AND `rating` >= 1;";
    
    // utför, hämta resultat
    $result = mysqli_query($conn, $sql);

    // fetch:ar resulterande värden som en array, ett format vi kan använda
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
    if ($rating <= 0 || $rating >= 5) {
        // något i stil med: header("location: ../log.php?error=wronglogin");
        exit();
    }

    // räknar antalet rader i ratings som uppfyller angivna kriterier
    $sql = "SELECT * FROM `ratings` WHERE `user_id` = $user_id AND `item_type` = $item_type AND `item_id` = $item_id;";
    
    $result = mysqli_query($conn, $sql);

    // bestämmer om det finns en rad som ska uppdateras eller om en ny rad ska skapas
    if(mysqli_fetch_array($conn, $sql)){
        $sql = "UPDATE `ratings` SET `rating` = ? AND `like` = ? WHERE `user_id` = ? AND `item_type` = ? AND `item_id` = ?;";
    } else {
        $sql = "INSERT INTO `ratings` (`rating`, `like`, `user_id`, `item_type`, `item_id`) VALUES (?, ?, ?, ?, ?);";
    }

    // initierar mysql statement
    $stmt = mysqli_stmt_init($conn);
    // används för att hindra sql injection
    // behövs främst vid användning av input-fält
    // används i denna funktion ifall input-fält används för att betygsätta

    // förbereder statement, samt kollar om något går fel. innebär i princip att query:n skickas till databasen i förväg för att hindra injection
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        //header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    // binder variabler till query:n
    mysqli_stmt_bind_param($stmt, "diisi", $rating, $like, $user_id, $item_type, $item_id);
    // "diisi" innebär datatyperna på de insatta variablerna -- double, integer, integer, string, integer

    // utför
    mysqli_stmt_execute($stmt);

    // stänger statement
    mysqli_stmt_close($stmt);
}

function popularityAllTime($conn, $item_type, $item_id){
    
    $sql = "SELECT COUNT(*) FROM `entries` WHERE `item_id` = $item_id AND `item_type` = $item_type;";

    $result = mysqli_query($conn, $sql);

    $array = mysqli_fetch_array($result);
    $value = intval($array[0]);

    $sql = "UPDATE $item_type SET `popularity_all` = $value WHERE `item_id` = $item_id;";
    
    mysqli_query($conn, $sql);
}

function popularityThisWeek($conn, $item_type, $item_id){

    // hämtar tiden för en vecka sedan och gör till passande format
    $tmp = strtotime("-1 Week")
    $date_lim = date("Y-m-d H:i:s", $tmp)
    // hur fixar man för tidszoner?

    $sql = "SELECT COUNT(*) FROM `entries` WHERE `item_id` = $item_id AND `item_type` = $item_type AND `date_completion` >= $date_lim;";

    $result = mysqli_query($conn, $sql);

    $array = mysqli_fetch_array($result);
    $value = intval($array[0]);

    $sql = "UPDATE $item_type SET `popularity_week` = $value WHERE `item_id` = $item_id;";
    
    mysqli_query($conn, $sql);
}

function retrieveMostPopular($conn, $lim){

    $sql = "SELECT * FROM `feature_films` ORDER BY `popularity_week` DESC LIMIT $lim;";
    $result = mysqli_query($conn, $sql);
    $row_films = mysqli_fetch_assoc($result);

    $sql = "SELECT * FROM `series` ORDER BY `popularity_week` DESC LIMIT $lim;";
    $result = mysqli_query($conn, $sql);
    $row_series = mysqli_fetch_assoc($result);

    $sql = "SELECT * FROM `games` ORDER BY `popularity_week` DESC LIMIT $lim;";
    $result = mysqli_query($conn, $sql);
    $row_games = mysqli_fetch_assoc($result);

    // append arrays
    $row_full = array_merge($row_films, $row_series, $row_games)

    // kollar om 'popularity_week' för det första array-elementet är mindre än det för det andra
    function sortByPopularity($a, $b) {
        return $a['popularity_week'] < $b['popularity_week'];
    }

    // sorterar med hjälp av funktionen ovan
    usort($row_full, 'sortByPopularity');

    // tar successivt bort sista elementet i listan tills efterfrågad mängd återstår
    while (count($row_full) > $lim) {
        array_pop($row_full)
    }

    return $row_full
}