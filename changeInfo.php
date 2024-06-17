<?php
include('./inc/php/dbconnection.php');
include('./inc/php/functions.php');

session_start();

head("Dashboard");
headerFunction();

if (!isset($_SESSION['loginInfo']['userLoginState']) || !$_SESSION['loginInfo']['userLoginState']) {
    customMessageBox(
        "Whoopsie!",
        "You need to be logged in.",
        $buttons = [
            ['label' => 'Take me back', 'url' => 'javascript:history.go(-1);'],
            ['label' => 'Let me log in', 'url' => 'loginSignup.php?method=logIn']
        ]
    );
    exit();
}

$userInfo = getUserInfo($_SESSION['loginInfo']['userId']);
$user = [];
foreach ($userInfo as $userInfos) {
    $user = $userInfos;
}
?>
<body>
    <pre>
        <?php
        var_dump($user);
        ?>
    </pre>
    <main class="container">
        <form action="" method="get">
            <ul>
                <li>
                    <label for=""></label>
                    <input type="text" value="<?= $user['userDisplayName'];?>">
                </li>
            </ul>
        </form>
    </main>
</body>