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

    <div class="slideshow-container">
        <div class="projectGrid">
            <div class="project">
                <img class="photo" src="./assets/Calculator.png" alt="A photo of the calculator, our first project">
                <div class="description">
                    This was our very first project. In this project we learned how to use Css, php and html.
                    With the information we got from the lessons we had to make a calculator that can multiply, divide, subtract, add, square root,
                    <br><br> Hold shift and scroll down to go the next page.
                </div>
            </div>
            <div class="project">
                <img class="photo" src="./assets/Radio.png" alt="A photo of the radio, our second project">
                <div class="description">
                    This was our second project. In this project we learned how to insert and use a database.
                    With this information we had to make a basic radio where the user will see three artist and when they click on a artist 3 random songs will show up.
                    Also there will be a music video off on off the songs
                    <br><br> hold shift and scroll down to go to the next page and hold shift and scroll up to go back
                </div>
            </div>
            <div class="project">
                <img class="photo" src="./assets/Shop.png" alt="A photo of the shop, our third project">
                <div class="description">
                    This was our third project. In this project we learned how to make a webshop using php, html, css and a database.
                    In the database we added pictures, prices, descriptions, item name, item id and a filter bar.
                    When the user selects the filter bar and chooses for example: Porsche. only the cars with item id Porsche will be shown.
                    <br><br> hold shift and scroll up to go back
                </div>
            </div>
        </div>
    </div>
    <div class="mobileHistory container">
        <div class="project">
            <img class="photo" src="./assets/Calculator.png" alt="A photo of the calculator, our first project">
            <div class="description">
                This was our very first project. In this project we learned how to use Css, php and html.
                With the information we got from the lessons we had to make a calculator that can multiply, divide, subtract, add, square root,
                <br><br> Hold shift and scroll down to go the next page.
            </div>
        </div>
        <div class="project">
            <img class="photo" src="./assets/Radio.png" alt="A photo of the radio, our second project">
            <div class="description">
                This was our second project. In this project we learned how to insert and use a database.
                With this information we had to make a basic radio where the user will see three artist and when they click on a artist 3 random songs will show up.
                Also there will be a music video off on off the songs
                <br><br> hold shift and scroll down to go to the next page and hold shift and scroll up to go back
            </div>
        </div>
        <div class="project">
            <img class="photo" src="./assets/Shop.png" alt="A photo of the shop, our third project">
            <div class="description">
                This was our third project. In this project we learned how to make a webshop using php, html, css and a database.
                In the database we added pictures, prices, descriptions, item name, item id and a filter bar.
                When the user selects the filter bar and chooses for example: Porsche. only the cars with item id Porsche will be shown.
                <br><br> hold shift and scroll up to go back
            </div>
        </div>
    </div>
    </div>

    <div class="history_footer">
        <?php footer(); ?>
    </div>

</body>

</html>