<?php 

require_once 'inc/dbh.inc.php';
require_once 'inc/functions.inc.php';

include_once 'header.php';

if(isset($_GET['type'])){

    $type = mysqli_real_escape_string($conn, $_GET['type'])

    $items = retrieveSortedList($conn, $type, "rating", "desc", 160);

} else if(isset($_POST['submit-search'])){

    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $sql = "SELECT * FROM `items` WHERE `name` LIKE '%$search%' OR `date` LIKE '%$search%';";

    $result = mysqli_query($conn, $sql);

    // $count = mysqli_num_rows($result); -- ifall man vill ge ett meddelande om det inte blir några resultat eller säga hur många resultat det blev

    $items = mysqli_fetch_assoc($result);
}
?>

<section>
    <div class="sub_header">
        <h2></h2>
        <p></p>
    </div>
    <div class="poster_list grid">
        <?php 
            foreach($items as $item){
                echo '<a href="item.php?type='.$item['type'].'&id='.$item['id'].'" class="poster_container"><img src='.$item['poster_path'].' alt="Poster"></a>'
            }
        ?>
    </div>
</section>

<?php include_once 'footer.php'; ?>