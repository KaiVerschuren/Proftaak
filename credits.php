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

?>

<body class="credits">
    <div class="container creditsWrap">
        <section class="creditsCard">
            <form action="" method="POST">
                <h1>1000 credits</h1>
                <p><strong>&euro;1000,-</strong></p>
                <ol>
                    <li>You get 1000 credits.</li>
                    <li>Nice amount to start.</li>
                </ol>
                <button class="btn creditsSection" type="submit">Buy</button>
            </form>
        </section>

        <section class="creditsCard">
            <form action="" method="POST">
                <h1>10000 credits</h1>
                <p><strong>&euro;10000,-</strong></p>
                <ol>
                    <li>You get 10000 credits.</li>
                    <li>It's a little bit cheaper</li>
                </ol>
                <button class="btn creditsSection" type="submit">Buy</button>
            </form>
        </section>

        <section class="creditsCard">
            <form action="" method="POST">
                <h1>custom amount</h1>
                <p><strong>1 euro per credit</strong></p>
                <ol>
                    <li>
                        You get the amount of
                        <br> credits you want.
                    </li>
                </ol>
                <input class="input creditsInput" type="number" name="customAmount" min="1" max="99999999">
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