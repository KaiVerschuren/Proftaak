<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

session_start();

if (isset($_SESSION['order'])) {
    $userId = $_SESSION['order']['userId'];
    $creditAmount = $_SESSION['order']['creditAmount'];
    $cryptoCurrency = $_SESSION['order']['cryptoCurrency'];
    $initialPay = $_SESSION['order']['initialPay'];
    $cryptoAmount = $_SESSION['order']['cryptoAmount'];
    
    // Call the function and check its return value
    if (addWalletToId($userId, $cryptoCurrency, $creditAmount, $cryptoAmount, $initialPay)) {
        // Success: Redirect to index.php with success parameter
        header("Location: index.php?status=success");
        exit;
    } else {
        // Failure: Redirect to index.php with failure parameter
        header("Location: index.php?status=failure");
        exit;
    }
}

?>
