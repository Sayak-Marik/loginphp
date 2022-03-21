<?php
    require "header.php";
    ?>
<main>
    <div class="wrap-main">
    <h1>Signup</hi>
    <form class="signup-form" action="includes/signup.inc.php" method="post">
        <input type="text" name="uid" placeholder="User ID">
        <input type="text" name="mail" placeholder="Email">
        <input type="password" name="pwd" placeholder="Password">
        <input type="password" name="pwd-repeat" placeholder="Confirm Password">
        <button type="submit" name="signup-submit">Sign up</button>
</form>
</div>
</main>
   
    <?php
    require "footer.php";
    ?>