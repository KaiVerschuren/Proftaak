<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

session_start();

if (isset($_SESSION['order'])) {
    $userId = $_SESSION['order']['userId'];
    $creditAmount = $_SESSION['order']['creditAmount'];
    $cryptoCurrency = $_SESSION['order']['cryptoCurrency'];
    $cryptoCurrencyFull = $_SESSION['order']['cryptoCurrencyFull'];
    $initialPay = $_SESSION['order']['initialPay'];
    $cryptoAmount = $_SESSION['order']['cryptoAmount'];
    $newCreditAmount = $_SESSION['order']['newCreditAmount'];

    if (addWalletToId($userId, $cryptoCurrency, $cryptoCurrencyFull, $creditAmount, $cryptoAmount, $initialPay)) {
        
        $subtractSucces = updateCredits($userId, $newCreditAmount);

        if ($subtractSucces) {
            unset($_SESSION['order']);
            header("Location: index.php?status=success");
        }
        exit;
    } else {
        header("Location: index.php?status=failure");
        exit;
    }
}
?>
