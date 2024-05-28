<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

session_start();

head("Wallet");
headerFunction();

if (isset($_SESSION['walletInfo'])) {
}
?>

<body>
    <pre class="container">
        <?php
        var_dump($_SESSION['walletInfo']);
        ?>
    </pre>

    <div class="info container">
        <div class="cryptoInfo walletInfoCard">
            <div class="walletBigDisplay">
                <h1>BTC</h1>
                <p>Amount of coins: 0.11</p>
                <p>Amount of Credits paid: 7700</p>
                <p>Initial amount per coin: 68480.72</p>
            </div>
            <div class="walletSmallDisplay">
                <ul class="noStyleUL">
                    <li>
                        <h1>BTC</h1>
                    </li>
                    <label>Amount of coins:</label>
                    <li>
                        <p>0.11</p>
                    </li>
                    <label for="">Amount of credits paid:</label>
                    <li>
                        <p>7700</p>
                    </li>
                    <label for="">Initial amount per coin:</label>
                    <li>
                        <p>68480.72</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sellCrypto walletInfoCard">
            <h1>Sell this crypto</h1>
            <div class="walletSellButtonWrapper">
                <button class="btn">Sell all</button>
                <button class="btn">Sell custom amount</button>
            </div>
        </div>
        <div class="cryptoGraph walletInfoCard">
            (insert some graph)
        </div>
    </div>
</body>