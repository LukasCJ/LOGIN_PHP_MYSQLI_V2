<?php 

    include_once('inc/dbh.php')

    if(isset($_GET['type'] && isset($_GET['id'])){

        // hindrar skadliga strängar i get-metoden
        $type = mysqli_real_escape_string($conn, $_GET['type'])
        $id = mysqli_real_escape_string($conn, $_GET['id'])

        $sql = "SELECT * FROM `items` WHERE `type` = $type AND `id` = $id"

        $result = mysqli_query($conn, $sql);

        $
    }
?>

<?php include_once 'header.php'; ?>