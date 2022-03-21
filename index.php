<?php
    require "header.php";
    ?>

    <main>
        <?php
            if(isset($_SESSION['userid'])){
                echo '<p>Logged in</p>';
            }
            else{
                echo '<p>Logged out</p>';
            }
        ?>
    </main>