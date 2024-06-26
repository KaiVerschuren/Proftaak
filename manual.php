<?php
include("inc/php/functions.php");

head("User manual");
mobileNav();
HeaderFunction();
?>

<body>
<<<<<<< Updated upstream
    <?php 
    mobileNav(); 
    HeaderFunction(); 
    ?>



    <div>
        <?php 
        footer();
        ?>
    </div>
=======
    <div class="container">
        <div class="manualWrapper">
            <div class="manualLinks">
                <ul class="noStyleUL">
                    <li><h1>Timestamps:</h1></li>
                    <li><a class="manualAnchorTag" onclick="skipTo(7)">Sign up</a></li>
                    <li><a class="manualAnchorTag" onclick="skipTo(24)">Log in</a></li>
                    <li><a class="manualAnchorTag" onclick="skipTo(46)">Buy credits</a></li>
                    <li><a class="manualAnchorTag" onclick="skipTo(55)">Dashboard and profile</a></li>
                    <li><a class="manualAnchorTag" onclick="skipTo(71)">Change settings</a></li>
                    <li><a class="manualAnchorTag" onclick="skipTo(88)">Contact</a></li>
                    <li><a class="manualAnchorTag" onclick="skipTo(100)">Buy crypto</a></li>
                    <li><a class="manualAnchorTag" onclick="skipTo(125)">Wallet</a></li>
                    <li><a class="manualAnchorTag" onclick="skipTo(132)">Sell crypto</a></li>
                </ul>
            </div>
            <div class="videoWrapper">
                <video id="manualVideo" controls>
                    <source src="./assets/manualCoinCove.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
    <?php footer(); ?>
    <script>
        function skipTo(seconds) {
            var video = document.getElementById('manualVideo');
            video.currentTime = seconds;
        }
    </script>
>>>>>>> Stashed changes
</body>