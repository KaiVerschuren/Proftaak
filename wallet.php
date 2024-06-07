<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

session_start();
if (isset($_SESSION['loginInfo']) || $_SESSION['loginInfo']['userLoginState']) {
    $walletContent = getWalletFromId($_SESSION['loginInfo']['userId']);

    if (isset($_SESSION['walletInfo']) && !isset($_POST['walletForm'])) {
        unset($_SESSION['walletInfo']);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['walletForm'])) {
        $walletId = $_POST['walletId'];    
        $currency = $_POST['currency'];
        $currencyFull = $_POST['currencyFull'];
        $amountCrypto = $_POST['amountCrypto'];
        $amountCredits = $_POST['amountCredits'];
        $initialPaid = $_POST['initialPaid'];
        $timeOfPayment = $_POST['timeOfPayment'];
        
        $currency = $_POST['currency'];
        $_SESSION['walletInfo'] = array(
            'walletId' => $walletId,
            'currency' => $currency,
            'currencyFull' => $currencyFull,
            'amountCrypto' => $amountCrypto,
            'amountCredits' => $amountCredits,
            'initialPaid' => $initialPaid,
            'timeOfPayment' => $timeOfPayment
        );
        header("Location: walletInfo.php");
    }
}
head("Wallet");
headerFunction();
mobileNav();

if (!isset($_SESSION['loginInfo']['userLoginState']) || !$_SESSION['loginInfo']['userLoginState']) {
    customMessageBox(
        "Whoopsie!",
        "You need to be logged in to access your wallet",
        $buttons = [
            ['label' => 'Take me back', 'url' => 'javascript:history.go(-1);'],
            ['label' => 'Let me log in', 'url' => 'loginSignup.php?method=logIn']
        ]
    );
    exit();
}

$crypto = api(100, [], 'EUR');
?>

<body>
    <div class="container">
        <div class="wallet">
            <header class="walletHeader">
                <h1>Wallet</h1>
                <h3>Hello, <?php echo $_SESSION['loginInfo']['userDisplayName']; ?>!</h3>
            </header>
            <div class="walletContents">
                <table class="walletTable accentShadow">
                    <thead>
                        <tr>
                            <th>Currency</th>
                            <th class="walletCurrentPrice">Current price</th>
                            <th class="amountOfCrypto">Amount of crypto</th>
                            <th class="walletCreditsPaid">Credits paid</th>
                            <th class="walletInitialAmount">Initial per coin</th>
                            <th class="walletTimeOfPayment">Time of payment</th>
                            <th class="walletProfit">Profit</th>
                        </tr>
                    </thead>
                    <tbody class="walletTableBody">
                        <?php
                        foreach ($walletContent as $walletContents) {
                            $profit = 0;
                            $currentPrice = 0;
                            foreach ($crypto as $cryptoData) {
                                if ($cryptoData['symbol'] == $walletContents['currency']) {
                                    $profit = calculatePercentageChange($walletContents['initialPayed'], $cryptoData['priceUsd']);
                                    $class = $profit >= 0 ? 'yes' : 'no';
                                    $currentPrice = $cryptoData['priceUsd'];
                                    break;
                                }
                            }
                        ?>
                            <tr>
                                <td><?php echo $walletContents['currency']; ?></td>
                                <td class="walletCurrentPrice"><?php echo "€" . number_format($currentPrice, 1); ?></td>
                                <td class="amountOfCrypto"><?php echo number_format($walletContents['amountCrypto'], 2) . " Coins"; ?></td>
                                <td class="walletCreditsPaid"><?php echo $walletContents['amountCredits']; ?></td>
                                <td class="walletInitialAmount"><?php echo number_format($walletContents['initialPayed'], 2) ?></td>
                                <td class="walletTimeOfPayment"><?php echo $walletContents['timeOfPayment']; ?></td>
                                <td  class="walletProfit"><strong style="color: var(--<?php echo $class; ?>);"><?php echo number_format($profit, 2) . '%'; ?></strong></td>
                                <td>
                                    <form class="walletInfoForm" method="post" name="walletPosted">
                                        <input type="hidden" name="walletForm">
                                        <input name="walletId" type="hidden" value="<?php echo $walletContents['id']; ?>">
                                        <input name="currency" type="hidden" value="<?php echo $walletContents['currency']; ?>">
                                        <input name="currencyFull" type="hidden" value="<?php echo $walletContents['currencyFull']; ?>">
                                        <input name="amountCrypto" type="hidden" value="<?php echo $walletContents['amountCrypto']; ?>">
                                        <input name="amountCredits" type="hidden" value="<?php echo $walletContents['amountCredits']; ?>">
                                        <input name="initialPaid" type="hidden" value="<?php echo $walletContents['initialPayed']; ?>">
                                        <input name="timeOfPayment" type="hidden" value="<?php echo $walletContents['timeOfPayment']; ?>">
                                        <input type="submit" value="Info" class="btn">
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>