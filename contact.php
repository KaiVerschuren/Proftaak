<?php
include("inc/php/functions.php");

session_start();

head("Homepage");
mobileNav();
HeaderFunction();
?>

<body>
    <div class="container">
        <div class="contact">
            <div class="contactTitle">
                <h1>Contact us.</h1>
            </div>
            <div class="contactList">
                <h3>Our info:</h3>
                <ul class="noStyleUL contactUL">
                    <li><label>Email:</label><a href="mailto:CoinCove@gmail.com"><strong>CoinCove@gmail.com</strong></a></li>
                    <li><label>Phone number:</label><a href="tel:+31 123 4567890"><strong>+31 123 4567890</strong></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="contactFooter">
        <?php
        footer();
        ?>
    </div>
</body>