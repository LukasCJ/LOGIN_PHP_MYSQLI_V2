<?php include_once 'header.php'; ?>

<section>
    <div class="section_header"><h2>Sign Up</h2></div>
    <div class="section_main">
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="name" placeholder="Full Name...">
            <input type="text" name="email" placeholder="Email..">
            <input type="text" name="uid" placeholder="Username..">
            <input type="password" name="pwd" placeholder="Password..">
            <input type="password" name="pwdrepeat" placeholder="Repeat Password...">
            <button type="submit" name="submit"><p>Sign Up</p></button>
        </form>

        <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo '<p>Fill in all fields</p>';
                }
                else if ($_GET["error"] == "invaliduid") {
                    echo '<p>Invalid username</p>';
                }
                else if ($_GET["error"] == "invalidemail") {
                    echo '<p>Invalid email</p>';
                }
                else if ($_GET["error"] == "differentpasswords") {
                    echo '<p>Passwords do not match</p>';
                }
                else if ($_GET["error"] == "stmtfailed") {
                    echo '<p>Something went wrong</p>';
                }
                else if ($_GET["error"] == "usernametaken") {
                    echo '<p>Username or email is already taken</p>';
                }
                else if ($_GET["error"] == "none") {
                    echo '<p>You have signed up</p>';
                }
            }
        ?>

    </div>
</section>

<?php include_once 'footer.php' ?>