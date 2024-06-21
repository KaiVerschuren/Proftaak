<?php
include("inc/php/functions.php");

session_start();

head("Homepage");
?>

<body>
    <?php 
    mobileNav(); 
    HeaderFunction(); 
    ?>

    <div class="teamFooter">
        <?php 
        footer();
        ?>
    </div>
</body>