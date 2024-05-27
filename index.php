<?php
include("inc/php/functions.php");

session_start();

head("Homepage");
?>

<body>
    <?php mobileNav(); ?>
    <?php HeaderFunction(); ?>
    <main class="">
        <section class="hero container">
            <div class="heroTextWrapper">
                <div>
                    <h1 class="heroTitle">Coin Cove</h1>
                </div>
                <div class="heroParagraph">
                    <strong>Buy, sell, and store</strong> over 250 digital assets at one of Europe’s<strong> leading exchanges</strong>.
                </div>
                <button onclick="window.location.href='buySell.php'" class="heroButton btn">Start Trading!</button>
            </div>
            <img class="heroImage" src="./assets/logo.png" alt="Our logo">
        </section>
        <section class="userCounter">
            <div class="container">
                <h2 class="userCounterTitle">Trusted by <span class="userCounterAmount">999,999,999</span> users!</h2>
            </div>
        </section>
        <section class="container">
            <div class="top3Cards">
                <?php
                for ($i = 0; $i < 3; $i++) {

                    top3Card($i);
                }
                ?>
            </div>
        </section>
    </main>

    <?php footer(); ?>
    <?php 
    if (isset($_GET['status']) && $_GET['status'] == "success") {
        customMessageBox(
            "Nice!",
            "The proccess has ben completed succesfully.",
            $buttons = [
                ['label' => 'To dashboard', 'url' => 'dashboard.php'],
                ['label' => 'To the buying page', 'url' => 'buy.php?method=buy&cryptoCurrency=BTC'],
                ['label' => 'Home', 'url' => 'index.php']
            ]
        );
    }
    ?>
</body>

</html>