<?php
include("inc/php/functions.php");
include("inc/php/dbconnection.php");

session_start();

head("Homepage");
?>

<body>
    <?php mobileNav(); ?>
    <?php HeaderFunction(); ?>
    <main class="">
        <section class="hero container slide-in hidden">
            <div class="heroTextWrapper">
                <div>
                    <h1 class="heroTitle">Coin Cove</h1>
                </div>
                <div class="heroParagraph">
                    <strong>Buy, sell, and store</strong> over 250 digital assets at one of Europe’s<strong> leading exchanges</strong>.
                </div>
                <button onclick="window.location.href='buy.php?method=buy&cryptoCurrency=BTC'" class="heroButton btn">Start Trading!</button>
            </div>
            <img class="heroImage" src="./assets/logo.png" alt="Our logo">
        </section>
    </section>
    <section class="userCounter slide-in hidden">
        <div class="container">
            <h2 class="userCounterTitle">Trusted by <span class="userCounterAmount"><?php userCounter()?></span> users!</h2>
        </div>
    </section>
    <section class="container">
    <div class="top3Cards">
    <?php
    $i = 0;
    top3Card($i);

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