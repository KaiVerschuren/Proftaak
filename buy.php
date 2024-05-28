<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

$crypto = api(5, [], 'EUR');

session_start();

head("Buy/Sell");
headerFunction();
mobileNav();

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
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['method'] == 'buy') {
        $userCreditsData = getUserCredits($_POST['userId']);
        
        // Extract the user credits from the result
        $userCredits = 0;
        foreach ($userCreditsData as $userCredit) {
            $userCredits = $userCredit['userCredits'];
        }
        
        $userId = $_POST['userId'];
        $creditAmount = $_POST['creditAmount'];
        $cryptoCurrency = $_POST['cryptoCurrency'];
        $cryptoCurrencyFull = $_POST['cryptoCurrencyFull'];
        $initialPay = $_POST['priceUsd'];
        $cryptoAmount = divide($creditAmount, $initialPay);
        
            if (!isset($_SESSION['order'])) {
                $_SESSION['order'] = array(
                    'userId' => $userId,
                    'creditAmount' => $creditAmount,
                    'cryptoCurrency' => $cryptoCurrency,
                    'cryptoCurrencyFull' => $cryptoCurrencyFull,
                    'initialPay' => $initialPay,
                    'cryptoAmount' => $cryptoAmount,
                    'newCreditAmount' => ($userCredits - $creditAmount)
                );
            }
            
            if ($userCredits >= $creditAmount) {
                customMessageBox(
                    "Order confirmation",
                    "You've ordered: " . $creditAmount . " Credits of " . $cryptoCurrency . " at " . $initialPay . ". Is this correct? You will have " . ($userCredits - $creditAmount) . " Credits left.",
                    $buttons = [
                        ['label' => 'Yes, it is', 'url' => 'confirmedOrder.php'],
                        ['label' => 'No, take me back', 'url' => 'buy.php?method=buy&cryptoCurrency=' . $cryptoCurrency]
                        ]
                    );
                    exit;
                } else {
                    customMessageBox(
                        "Not enough Credits",
                        "Your wallet doesn't have enough Credits inside.",
                        $buttons = [
                            ['label' => 'Back', 'url' => 'buy.php?method=buy&cryptoCurrency=BTC']
                            ]
                        );
                    }
                }
                
                
                ?>

<body>
    <?php
    if (isset($_GET['method'])) {
        ?>
        <main class="container">
            <?php
            if (!isset($_GET['cryptoCurrency'])) {
                ?>
                <p>Something went wrong.</p>
                <button class="btn" onclick="window.location.href='buy.php?method=buy&cryptoCurrency=BTC'">Go to the correct page</button>
                <?php
            } else if (isset($_GET['cryptoCurrency']) && $_GET['method'] == 'buy') {
                ?>
            <div class="buyCryptoTitle">
                <h1 class="buyTitle">Buy Crypto</h1>
                <?php
                $currentUserCredits = getUserCredits($_SESSION['loginInfo']['userId']);
                foreach ($currentUserCredits as $userCredit)
                ?>
                <h4>You have: <?php echo $userCredit['userCredits'];?> Credits</h4>
                <?php
                
                ?>
            </div>
            <div class="buyCrypto">
                <form class="buyCryptoChoose" action="<?php echo "buy.php?method=buy"; ?>" method="get">
                        <input type="hidden" name="method" value="buy">
                        <select class="input" name="cryptoCurrency">
                            <option disabled>Choose currency</option>
                            <?php
                            foreach ($crypto as $cryptoCurrencies) {
                            ?>
                                <option <?php if ($_GET['cryptoCurrency'] == $cryptoCurrencies['symbol']) {
                                            echo "selected";
                                        } ?> value="<?php echo $cryptoCurrencies['symbol']; ?>"><?php echo $cryptoCurrencies['symbol']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <input class="input" type="submit" value="Set currency">
                    </form>
                    <form class="buyCryptoAmount" action="" method="post">
                        <input type="hidden" name="method" value="buy">
                        <?php
                        foreach ($crypto as $cryptoCurrencies) {
                            if ($_GET['cryptoCurrency'] == $cryptoCurrencies['symbol']) {
                        ?>

                                <h2>Insert amount of credits</h2>
                                <input name="creditAmount" class="input" type="number" placeholder="Credits" min="1">

                                <input type="hidden" name="userId" value="<?php echo $_SESSION['loginInfo']['userId'] ?>">
                                <input type="hidden" name="cryptoCurrency" value="<?php echo $cryptoCurrencies['symbol']; ?>" ?>
                                <input type="hidden" name="cryptoCurrencyFull" value="<?php echo $cryptoCurrencies['id']; ?>" ?>
                                <input type="hidden" name="priceUsd" value="<?php echo $cryptoCurrencies['priceUsd']; ?>" ?>
                                <input class="input" type="submit" value="Buy Crypto">

                                <label for="Conversion"><?php echo number_format($cryptoCurrencies['priceUsd'], 2); ?> Credits will get you 1 <?php echo $cryptoCurrencies['name']; ?></label>

                        <?php
                            }
                        }
                        ?>
                    </form>
                </div>
            <?php
            }
            ?>
        </main>
    <?php
    }
    ?>
</body>