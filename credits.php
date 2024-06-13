<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

session_start();

head("Credits");
headerFunction();

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $success = false;
    if (isset($_POST['addCredits'])) {
        $userPreviousCredits = getUserCredits($_SESSION['loginInfo']['userId']);
        foreach ($userPreviousCredits as $userCredit) {
            $userCredits = $userCredit['userCredits'];
        }
        $amount = $_POST['amount'];
        
        if ($amount > 0) {
            $userCredits = intval($userCredits);
            $amount = intval($amount);
            $newCredits = $userCredits + $amount;

            $success = updateCredits($_SESSION['loginInfo']['userId'], $newCredits);
        } else {
            customMessageBox(
                'Invalid Amount',
                'Amount exceeded parameters',
                $buttons = [
                    ['label' => 'Back', 'url' => 'javascript:history.go(-1);']
                ]
            );
            exit(); // Exit after displaying error message
        }
    } elseif (isset($_POST['custom'])) {
        $userPreviousCredits = getUserCredits($_SESSION['loginInfo']['userId']);
        $amount = $_POST['amount'];
        
        if ($amount > 0) {
            $userPreviousCredits = intval($userPreviousCredits);
            $amount = intval($amount);
            $newCredits = $userCredits + $amount;

            $success = updateCredits($_SESSION['loginInfo']['userId'], $newCredits);
        } else {
            customMessageBox(
                'Invalid Amount',
                'Amount exceeded parameters',
                $buttons = [
                    ['label' => 'Back', 'url' => 'javascript:history.go(-1);']
                ]
            );
            exit(); // Exit after displaying error message
        }
    }
    if ($success) {
        customMessageBox(
            'Success',
            'Successfully inserted credits',
            $buttons = [
                ['label' => 'To Wallet', 'url' => 'wallet.php']
            ]
        );
        exit(); // Exit after displaying success message
    }
}


?>

<body class="credits">
    <div class="container creditsWrap">
        <section class="creditsCard slide-in hidden">
            <form action="" method="post">
                <h1>1000 credits</h1>
                <p><strong>&euro;1000,-</strong></p>
                <ol>
                    <li>You get 1000 credits.</li>
                    <li>Nice amount to start.</li>
                </ol>
                <input type="hidden" name="addCredits" value="set">
                <input type="hidden" name="amount" value="1000">
                <button class="btn creditsSection" type="submit">Buy</button>
            </form>
        </section>

        <section class="creditsCard slide-in hidden">
            <form action="" method="post">
                <h1>10000 credits</h1>
                <p><strong>&euro;10000,-</strong></p>
                <ol>
                    <li>You get 10000 credits.</li>
                    <li>It's a little bit cheaper</li>
                </ol>
                <input type="hidden" name="addCredits" value="set">
                <input type="hidden" name="amount" value="10000">
                <button class="btn creditsSection" type="submit">Buy</button>
            </form>
        </section>

        <section class="creditsCard slide-in hidden">
            <form action="" method="post">
                <h1>custom amount</h1>
                <p><strong>1 euro per credit</strong></p>
                <ol>
                    <li>
                        You get the amount of
                        <br> credits you want.
                    </li>
                </ol>
                <input type="hidden" name="addCredits" value="set">
                <input type="hidden" name="custom">
                <input class="input creditsInput" type="number" name="amount" min="1" max="99999999">
                <br>
                <button class="btn creditsSection" type="submit">Buy</button>
            </form>
        </section>

    </div>

    <div class="creditsFooter">
        <?php
        footer()
        ?>
    </div>

</body>

</html>