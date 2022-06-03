<?php 

require_once 'inc/dbh.inc.php';
require_once 'inc/functions.inc.php';

include_once 'header.php';

if(isset($_GET['type'])){

    $type = mysqli_real_escape_string($conn, $_GET['type'])

    $items = retrieveSortedList($conn, $type, "rating", "desc", 160);
}

?>

<section>
    <div class="sub_header">
        <h2></h2>
        <p></p>
    </div>
    <div class="poster_list grid">
        <?php foreach($items as $item): ?>
        <a href="item.php?type=<?php echo $item['type']; ?>?id=<?php echo $item['id']; ?>" class="poster_container"><img src="<?php echo $item['poster_path']; ?>" alt="Poster"></a>
        <?php endforeach; ?>
    </div>
</section>

<?php include_once 'footer.php'; ?>