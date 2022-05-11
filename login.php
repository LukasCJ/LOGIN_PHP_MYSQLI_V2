<?php include_once 'header.php'; ?>

<section>
    <div class="section_header"><h2>Log In</h2></div>
    <div class="section_main">
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email...">
            <input type="password" name="pwd" placeholder="Password..">
            <button type="submit" name="submit"><p>Log In</p></button>
        </form>

        <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo '<p>Fill in all fields</p>';
                }
                else if ($_GET["error"] == "wronglogin") {
                    echo '<p>Invalid input</p>';
                }
            }
        ?>

    </div>
</section>

<?php include_once 'footer.php' ?>