<?php
include("inc/php/functions.php");

head("Homepage");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php mobileNav(); ?>
    <?php HeaderFunction(); ?>
        <div class = "calculator">
            <img class= "calculator_photo" src= "./assets/Calculator.png" alt="A photo off the calculator. Our first object">
                <div class = "calculator_description">
                    This was  our first project we had to make. Its a basic calculator
                </div>
        </div>

    <?php footer(); ?>
    
</body>
</html>