<?php
include('./inc/php/dbconnection.php');
include('./inc/php/functions.php');

session_start();

headerFunction();
head("Custom");
mobileNav();

if ($_SESSION['loginInfo']['userLoginState'] && isset($_SESSION['walletInfo'])) {
    $walletInfo = $_SESSION['walletInfo'];
    $crypto = api(100, [], 'EUR');
?>
    <div class="sellCustomBackgroundBlur">
        <div class="sellCustom accentShadow">
            <div class="sellCustomTitle">
                <h1>
                    Choose custom amount
                </h1>
            </div>
            <form action="" class="sellCustomForm" method="post">
                <ul class="noStyleUL">
                    <li>
                        <input type="hidden" name="customSell" value="true">
                        <input type="number" name="customNumber" class="sellCustomInput removeArrow input" min="1" required>
                    </li>
                    <li>
                        <input type="submit" class="btn" value="Sell">
                    </li>
                </ul>
            </form>
        </div>
    </div>
<?php
    if (isset($_POST['customSell'])) {
        $amountCredits = (float)$_POST['customNumber']; // Ensure this is a float or int

        if ($amountCredits > 0 && $amountCredits <= (float)$walletInfo['amountCredits']) {
            foreach ($crypto as $cryptos) {
                if ($cryptos['id'] == $walletInfo['currencyFull']) {
                    $profitPercentage = calculatePercentageChange($walletInfo['initialPaid'], $cryptos['priceUsd']);
                    $cryptoPriceUsd = (float)$cryptos['priceUsd']; // Ensure this is a float or int

                    // Calculate the profit/loss based on custom amount and current crypto price
                    if ($profitPercentage >= 0) {
                        // If profit is positive, calculate new credits left
                        $profitAmount = $amountCredits * ($profitPercentage / 100);
                        $creditsLeft = $amountCredits + $profitAmount;
                    } else {
                        // If profit is negative, calculate new credits left
                        $lossAmount = $amountCredits * (abs($profitPercentage) / 100);
                        $creditsLeft = max(0, $amountCredits - $lossAmount);
                    }

                    // Fetch user's current credits
                    $userCredits = getUserCredits($_SESSION['loginInfo']['userId']);
                    $userPreviousCredits = 0; // Initialize to avoid undefined variable issue
                    foreach ($userCredits as $userCredit) {
                        $userPreviousCredits = (int)$userCredit['userCredits']; // Ensure this is an int
                    }

                    // Calculate new credit amount
                    $newCreditAmount = $userPreviousCredits + $creditsLeft;

                    // Update user's credits
                    $creditUpdateSucces = updateCredits($_SESSION['loginInfo']['userId'], $newCreditAmount);
                    if ($creditUpdateSucces) {
                        $walletId = $_SESSION['walletInfo']['walletId'];
                        $walletCredits = (float)$walletInfo['amountCredits']; // Ensure this is a float or int
                        $newWalletCredits = $walletCredits - $amountCredits;

                        // Update wallet with the new amount of credits
                        updateWalletFromId($newWalletCredits, $walletId);

                        // Update the session with new wallet info
                        $_SESSION['walletInfo']['amountCredits'] = $newWalletCredits;

                        // Provide success message
                        customMessageBox("Transaction Successful", "Your credits have been updated.", $buttons = [
                            ['label' => 'Close', 'url' => 'wallet.php']
                        ]);
                    } else {
                        customMessageBox("Update Failed", "Failed to update credits. Please try again.", $buttons = [
                            ['label' => 'Try Again', 'url' => '']
                        ]);
                    }
                }
            }
        } else {
            customMessageBox("Invalid amount", "Amount is either less than 1, or exceeds the amount of credits in your wallet.", $buttons = [
                ['label' => 'Try Again', 'url' => ''],
                ['label' => 'Close Menu', 'url' => 'wallet.php']
            ]);
        }
    }
}
?>
