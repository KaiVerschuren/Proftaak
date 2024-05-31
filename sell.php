<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

session_start();


head('Sell');
headerFunction();
mobileNav();

if (isset($_SESSION['walletInfo'])) {
    $walletInfo = $_SESSION['walletInfo'];
    $crypto = api(5, [], 'EUR');
} else {
    customMessageBox(
        "Whoopsie!",
        "Info has not been found.",
        $buttons = [
            ['label' => 'Take me back', 'url' => 'javascript:history.go(-1);']
        ]
    );
    exit();
}

if (!isset($_SESSION['loginInfo']['userLoginState']) || !$_SESSION['loginInfo']['userLoginState']) {
    customMessageBox(
        "Whoopsie!",
        "You need to be logged in to access our buying page",
        $buttons = [
            ['label' => 'Take me back', 'url' => 'javascript:history.go(-1);'],
            ['label' => 'Let me log in', 'url' => 'loginSignup.php?method=logIn']
        ]
    );
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['sellAllButton'])) {
        foreach ($crypto as $cryptos) {
            if ($cryptos['id'] == $walletInfo['currencyFull']) {
                // Calculate profit percentage
                $profitPercentage = calculatePercentageChange($walletInfo['initialPaid'], $cryptos['priceUsd']);

                // Calculate the amount to add or subtract from wallet credits
                $cryptoValue = $walletInfo['amountCrypto'] * $cryptos['priceUsd'];
                if ($profitPercentage >= 0) {
                    // If profit is positive, add to wallet credits
                    $amountToUpdate = $cryptoValue - $_SESSION['walletInfo']['amountCredits'];
                    $creditsLeft = $_SESSION['walletInfo']['amountCredits'] + $amountToUpdate;
                } else {
                    // If profit is negative, subtract from wallet credits
                    $amountToSubtract = $_SESSION['walletInfo']['amountCredits'] - $cryptoValue;
                    $creditsLeft = max(0, $amountToSubtract);
                }
                echo $creditsLeft;
            }
        }
    } elseif (isset($_POST['customAmountButton'])) {
        $_SESSION['walletInfo']['sellType'] = "sellAmount";
    } elseif (isset($_POST['toSellAll'])) {
        $_SESSION['walletInfo']['sellType'] = "sellAll";
    } elseif (isset($_POST['sellCustomButton'])) {
        echo "something something too";
    }
}

$history = getCreditHistory($_SESSION['loginInfo']['userId']);

$labels = [];
$values = [];
foreach ($history as $creditHistory) {
    $labels[] = $creditHistory['historyTime'];
    $values[] = $creditHistory['historyCredits'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<script>
    $(document).ready(function () {
        let labels = <?php echo json_encode($labels); ?>;
        let values = <?php echo json_encode($values); ?>;

        const rootStyles = getComputedStyle(document.documentElement);
        const primaryClr = rootStyles.getPropertyValue('--primary').trim();
        const secondaryClr = rootStyles.getPropertyValue('--secondary').trim();

        const ctx = document.getElementById('walletChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Price (USD)',
                    data: values,
                    borderWidth: 2,
                    borderColor: primaryClr,
                    pointRadius: 0,
                    pointBackgroundColor: primaryClr,
                    cubicInterpolationMode: 'monotone'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: true,
                    },
                    y: {
                        display: false,
                        beginAtZero: false
                    }
                },
                plugins: {
                    tooltip: {
                        enabled: true,
                        mode: 'index',
                        intersect: false
                    },
                    legend: {
                        display: false,
                        position: 'top'
                    }
                },
                animation: {
                    duration: 300,
                    easing: 'linear'
                },
                hover: {
                    mode: 'nearest',
                    intersect: false
                }
            }
        });
    });
</script>
<pre>
    <?php
    var_dump($_SESSION['walletInfo']);

    ?>
</pre>
<main class="container">
    <div class="sellTitle">
        <h1>Sell yourdd <span class="gradientText">crypto</span></h1>
    </div>
    <div class="sellInfoWrapper">
        <div class="sellInfoCard sellInfoUser accentShadow">
            <ul class="noStyleUL">
                <?php
                foreach ($crypto as $cryptos) {
                    if ($cryptos['id'] == $walletInfo['currencyFull']) {
                        $profit = calculatePercentageChange($walletInfo['initialPaid'], $cryptos['priceUsd']);
                        $class = $profit >= 0 ? 'yes' : 'no';
                    }
                }
                ?>
                <li>
                    <h1>Info on <?= $_SESSION['loginInfo']['userDisplayName'] . "'s wallet"; ?></h1>
                </li>
                <li>
                    <p>Amount of coins: <strong>€<?= number_format($walletInfo['amountCrypto'], 5); ?></strong></p>
                </li>
                <li>
                    <p>Amount of credits paid: <strong>€<?= formatNumber($walletInfo['amountCredits']); ?></strong></p>
                </li>
                <li>
                    <p>Initial price per coin: <strong>€<?= number_format($walletInfo['initialPaid'], 2); ?></strong>
                    </p>
                </li>
                <li>
                    <p>Date of payment: <strong><?= substr($walletInfo['timeOfPayment'], 0, 10); ?></strong></p>
                </li>
                <li>
                    <p>Profit: <strong style="color: var(--<?php echo $class; ?>);"><?= number_format($profit, 2); ?>
                            %</strong></p>
                </li>
            </ul>
        </div>
        <div class="sellInfoCard sellInfoCrypto accentShadow">
            <ul class="noStyleUL">
                <?php
                foreach ($crypto as $cryptos) {
                    if ($walletInfo['currencyFull'] == $cryptos['id']) {
                        $profit = calculatePercentageChange($cryptos['priceUsd'], $walletInfo['initialPaid']);
                        $class = $profit >= 0 ? 'yes' : 'no';
                        ?>
                        <li>
                            <h1>Info on <?= $cryptos['symbol']; ?></h1>
                        </li>
                        <li>
                            <p><?= $cryptos['name']; ?></p>
                        </li>
                        <li>
                            <p>Current price: <strong>€<?= number_format($cryptos['priceUsd'], 2); ?></strong></p>
                        </li>
                        <li>
                            <p>Current supply: <strong>€<?= formatNumber($cryptos['supply']); ?></strong></p>
                        </li>
                        <li>
                            <p>Current market cap: <strong>€<?= formatNumber($cryptos['marketCapUsd']); ?></strong>
                            </p>
                        </li>
                        <li>
                            <p>Changed in the last 24Hr
                                <strong style="color: var(--<?php echo $class; ?>);"><?= number_format($cryptos['changePercent24Hr'], 2); ?>
                                    %</strong></p>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <?php
        if ($_SESSION['walletInfo']['sellType'] == 'sellAll') {
            ?>
            <section class="sellCard sellInfoCard accentShadow">
                <h1>Choose an option</h1>
                <form action="" class="sellAllForm" method="post">
                    <button type="submit" name="sellAllButton" class="btn">Sell all</button>
                    <button type="submit" name="customAmountButton" class="btn">To custom amount</button>
                </form>
            </section>
            <?php
        } else if ($_SESSION['walletInfo']['sellType'] == 'sellAmount') {
            ?>
            <section class="sellCard sellInfoCard accentShadow">
                <h1>Choose an option</h1>
                <form action="" class="sellAllForm" method="post">
                    <button type="submit" name="sellCustomButton" class="btn">Sell custom amount</button>
                    <button type="submit" name="toSellAll" class="btn">To sell all</button>
                </form>
            </section>
            <?php
        }
        ?>
        <div class="userCreditsGraph sellInfoCard accentShadow">
            <canvas id="walletChart"></canvas>
        </div>
    </div>
</main>
</body>
</html>
