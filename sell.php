<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

session_start();

head('Sell');
headerFunction();
mobileNav();

if (isset($_SESSION['walletInfo'])) {
    $walletInfo = $_SESSION['walletInfo'];
    $crypto = api(100, [], 'EUR');
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
        "You need to be logged in to access our selling page",
        $buttons = [
            ['label' => 'Take me back', 'url' => 'javascript:history.go(-1);'],
            ['label' => 'Let me log in', 'url' => 'loginSignup.php?method=logIn']
        ]
    );
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['sellAllButton'])) {
        $sellAllSuccess = false;
        foreach ($crypto as $cryptos) {
            if ($cryptos['id'] == $walletInfo['currencyFull']) {
                // Calculate profit percentage
                $profitPercentage = calculatePercentageChange($walletInfo['initialPaid'], $cryptos['priceUsd']);
                $cryptoPriceUsd = (float)$cryptos['priceUsd']; // Ensure this is a float

                // Calculate the profit/loss based on the current crypto price
                if ($profitPercentage >= 0) {
                    // If profit is positive, calculate new credits left
                    $profitAmount = $walletInfo['amountCredits'] * ($profitPercentage / 100);
                    $creditsLeft = $walletInfo['amountCredits'] + $profitAmount;
                } else {
                    // If profit is negative, calculate new credits left
                    $lossAmount = $walletInfo['amountCredits'] * (abs($profitPercentage) / 100);
                    $creditsLeft = max(0, $walletInfo['amountCredits'] - $lossAmount);
                }

                // Fetch user's current credits
                $userCredits = getUserCredits($_SESSION['loginInfo']['userId']);
                $userPreviousCredits = 0;
                foreach ($userCredits as $userCredit) {
                    $userPreviousCredits = (int)$userCredit['userCredits']; // Ensure this is an int
                }

                // Calculate new credit amount
                $newCreditAmount = $userPreviousCredits + $creditsLeft;

                // Update user's credits
                $creditUpdateSuccess = updateCredits($_SESSION['loginInfo']['userId'], $newCreditAmount);
                if ($creditUpdateSuccess) {
                    $walletId = $_SESSION['walletInfo']['walletId'];
                    // Remove wallet from DB
                    removeWalletFromId($walletId);

                    // Remove wallet info from session
                    unset($_SESSION['walletInfo']);

                    $sellAllSuccess = true;
                }
            }
        }

        if (!$sellAllSuccess) {
            customMessageBox(
                "Whoopsie!",
                "Failed to sell all crypto.",
                $buttons = [
                    ['label' => 'Try again', 'url' => '']
                ]
            );
            exit();
        } else {
            customMessageBox(
                "Success!",
                "All crypto sold successfully. There are now: " . number_format($newCreditAmount, 2) . " credits in your wallet.",
                $buttons = [
                    ['label' => 'Go to wallet', 'url' => 'wallet.php']
                ]
            );
            exit();
        }
    } elseif (isset($_POST['customAmountButton'])) {
        $_SESSION['walletInfo']['sellType'] = "sellAmount";
    } elseif (isset($_POST['toSellAll'])) {
        $_SESSION['walletInfo']['sellType'] = "sellAll";
    }
}

$history = getCreditHistory($_SESSION['loginInfo']['userId']);

$labels = [];
$values = [];
foreach ($history as $creditHistory) {
    $labels[] = substr($creditHistory['historyTime'], 0, 10);
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
        $(document).ready(function() {
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
                        label: 'Credits',
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
    <main class="container">
        <div class="sellWalletWrapper">
            <div class="sellTitle">
                <h1>Sell your <span class="gradientText">crypto</span></h1>
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
                            <p>Initial price per coin:
                                <strong>€<?= number_format($walletInfo['initialPaid'], 2); ?></strong>
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
                                            %</strong>
                                    </p>
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
                        <form action="customSell.php" class="sellAllForm" method="post">
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
        </div>
    </main>
</body>

</html>
