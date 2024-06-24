<?php
include('./inc/php/dbconnection.php');
include('./inc/php/functions.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['contact'] == "set") {
    $contactContent = $_POST['contactContent'];
    $contactType = $_POST['contactType'];
    $userId = $_SESSION['loginInfo']['userId'];

    $success = sendContact($contactContent, $contactType, $userId);
    if ($success) {
        header("location: dashboard.php");
    }
}
?>