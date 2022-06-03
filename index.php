<?php 

require_once 'inc/dbh.inc.php';
require_once 'inc/functions.inc.php';

include_once 'header.php';

if (isset($_SESSION["useruid"])) {
    include_once 'list_recent.php';
} 

?>

<section>

    <div class="sub_header">
        <h2>Popular</h2>
        <p>This Week</p>
    </div>

    <div class="poster_list horizontal">
        <?php $row = retrieveMostPopular($conn, 15);
        
        foreach($row as $item): ?>
            <a href="item.php?type=<?php echo $item['type'] ?>?id=<?php echo $item['id'] ?>" class="poster_container"><img src=<?php echo $item['poster_path'] ?> alt="Poster"></a>
        <?php endforeach; ?>
        <a href="#" class="poster_container"><img src="" alt="Poster"></a>
        <a href="#" class="poster_container show_more"><div><h3>Show More</h3></div></a>
    </div>

</section>

<?php include_once 'footer.php' ?>