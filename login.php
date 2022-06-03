<?php include_once 'header.php'; ?>

<section>

    <div class="sub_header"><h2>Log In</h2></div>

    <ul id="form_choice">
        <li><a href="login_temp.html" class="button">Log in</a></li>
        <li><a href="signup_temp.html" class="button">Sign up</a></li>
    </ul>

    <form action="inc/login.inc.php" method="post" id="login_form">
        <input type="text" name="uid" placeholder="Username/Email...">
        <input type="password" name="pwd" placeholder="Password...">
        <button type="submit" name="submit" class="button">Log In</button>
    </form>

</section>

<?php include_once 'footer.php' ?>