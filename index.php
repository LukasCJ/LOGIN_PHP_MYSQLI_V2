<?php include_once 'header.php'; ?>

<?php
    if (isset($_SESSION["useruid"])) {
        echo '<h2>Welcome ' . $_SESSION["useruid"] . '</h2>';
        echo '<section>
            <div class="section_header"><h2>Recent Activity</h2><p>From Friends</p></div>
            <ul class="content_list posters">
            <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster_2.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
                <li class="poster_container final"><a href="#">
                    <p class="sm-plus">+</p>
                    <p>Show More</p>
                </a></li>
            </ul>
        </section>';
    }
?>

<section>
<div class="section_header"><h2>Popular</h2><p>This Week</p></div>
    <ul class="content_list posters">
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster_2.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container"><a href="#"><img src="img/metadata/poster.jpg" alt="poster"></a></li>
        <li class="poster_container final"><a href="#">
            <p class="sm-plus">+</p>
            <p>Show More</p>
        </a></li>
    </ul>
</section>

<?php include_once 'footer.php' ?>