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
   <h1 class="teamTitle">Team</h1>
    <div class="teamGrid container">
        <div class="jamieImgBox">
            <img class="jamieImg teamImg" src="assets/jamie.jpg" alt="Picture of Jamie">
        </div>
        <div class="jamie">
            <p class="teamText">
                Hi, I'm Jamie van der Maat, a 17 year old <strong>software development student</strong> 
                at ROC Ter AA Helmond located in the Netherlands.
                <br>
                I'm in my first year, aiming to become a 
                <strong>frontend/fullstack developer</strong>.
                <br>
                I enjoy learning how things work behind the scenes and I'm looking forward to learn more.
            </p>
        </div>
        <div class="kaiImgBox">
            <img class="kaiImg teamImg" src="assets/kai.webp" alt="Picture of Kai">
        </div>
        <div class="kai">
            <p class="teamText">
                Hi, I'm Kai Verschuren, a 16-year-old
                <strong> software development student</strong> at ROC Ter AA in the
                Netherlands.
                <br>
                I'm in my first year, aiming to become a
                <strong> frontend/fullstack developer</strong>.
                <br>
                I'm passionate about technology and eager to start my career in
                software development.   
            </p>
        </div>
        <div class="lucasImgBox">
            <img class="lucasImg teamImg" src="assets/lucas.png" alt="Picture of Lucas">
        </div>
        <div class="lucas">
            <p class="teamText">
                Hi, I'm Lucas Knol, a 17-year-old
                <strong> software development student</strong> at ROC Ter AA in the
                Netherlands. 
                <br>
                I'm in my first year, aiming to become a
                <strong> frontend/fullstack developer</strong>.
                <br>
                I'm passionate about technology and looking forward to start my career in
                software development.
            </p>
        </div>
    </div>

    <div class="teamFooter">
        <?php 
        footer();
        ?>
    </div>
</body>