<?php

function head($page)
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/utils.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title><?php echo $page ?> | Coin Cove</title>
    </head>
<?php
}

function headerFunction()
{
?>
    <script defer src="./inc/js/main.js"></script>
    <script src="./inc/js/slidein.js"></script>
    <script defer src="./inc/js/accordion.js"></script>
    <header class="container">
        <div class="title">
            <a href="index.php" class="resetAnchorTag">
                <h1 class="titleH1">Coin Cove</h1>
            </a>
        </div>
        <nav class="nav">
            <ul class="navUL noStyleUL">
                <li class="navList1"><span class="navLinkSpan">Products
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="navLinkSvg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span></li>
                <li class="navList2">
                    <span class="navLinkSpan">Account
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="navLinkSvg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>

                    </span>
                </li>
                <li class="navList3">
                    <span class="navLinkSpan">Us
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="navLinkSvg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>

                    </span>
                </li>
                <!-- <li class="navList3"><a class="resetAnchorTag" href="">Wallet</a></li> -->
            </ul>
        </nav>
        <div class="loginButtons">
            <?php
            if (!isset($_SESSION['loginInfo']['userLoginState']) || !$_SESSION['loginInfo']['userLoginState']) {
            ?>
                <a class="resetAnchorTag" href="loginSignup.php?method=signUp">Sign up</a>
                <a class="resetAnchorTag btn" href="loginSignup.php?method=logIn">Log in</a>
            <?php
            } else if (isset($_SESSION['loginInfo']['userLoginState']) || $_SESSION['loginInfo']) {
            ?>
                <a class="resetAnchorTag btn" href="loginSignup.php?method=signOut">Sign out</a>
            <?php
            }
            ?>
        </div>
    </header>
    <div class="dropdownMenu dropdownProducts">
        <ul class="noStyleUL">
            <li>
                <a href="pricing.php" class="dropdown dropdownLink1 resetAnchorTag">
                    Pricing
                </a>
            </li>
            <li>
                <a href="buy.php?method=buy&cryptoCurrency=BTC" class="dropdown dropdownLink2 resetAnchorTag">
                    Buy/Sell crypto
                </a>
            </li>  
            <li>
                <a href="credits.php" class="dropdown dropdownLink3 resetAnchorTag">
                    Credits
                </a>
            </li>
        </ul>
    </div>
    <div class="dropdownMenu dropdownAccount">
        <ul class="noStyleUL">
            <li>
                <a href="profile.php" class="dropdown dropdownLink1 resetAnchorTag">
                    Profiles
                </a>
            </li>
            <li>
                <a href="dashboard.php" class="dropdown dropdownLink1 resetAnchorTag">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="wallet.php" class="dropdown dropdownLink2 resetAnchorTag">
                    Wallet
                </a>
            </li>
            <li>
                <a href="leaderboard.php" class="dropdown dropdownLink2 resetAnchorTag">
                    leaderboard
                </a>
            </li>
        </ul>
    </div>

    <div class="dropdownMenu dropdownUs">
        <ul class="noStyleUL">
            <li>
                <a href="aboutUs.php" class="dropdown dropdownLink1 resetAnchorTag">
                    About us
                </a>
            </li>
            <li>
                <a href="team.php" class="dropdown dropdownLink2 resetAnchorTag">
                    Team
                </a>
            </li>
            <li>
                <a href="history.php" class="dropdown dropdownLink3 resetAnchorTag">
                    History
                </a>
            </li>
        </ul>
    </div>
    <?php
}




function top3Card($placement)
{
    $con = mysqli_connect("localhost", "root", "", "coincove");


    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Mysqli query to fetch rows in descending order of userCredits, limiting to top 3
    $result = mysqli_query($con, "SELECT userDisplayName, userCredits FROM userinfo ORDER BY userCredits DESC, userId DESC LIMIT 3");


    if (mysqli_num_rows($result) > 0) {
        $ranking = 1;
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
            <div class="top3Wrapper slide-in hidden <?php echo 'top3Card' . $placement; ?>">
                <div class="top3Info ">
                    <h2 class="top3InfoTitle"><?php echo htmlspecialchars($row['userDisplayName']); ?></h2>
                    <p class="top3Credits"><?php echo number_format($row['userCredits']); ?> Credits</p>
                    <span class="top3Placement"><?php echo $ranking; ?><?php echo ($ranking == 1 ? 'st' : ($ranking == 2 ? 'nd' : 'rd')); ?></span>
                </div>
            </div>
    <?php
            $ranking++;
            $placement++;
        }
    } else {
        echo "No results found.";
    }
    // Close the database connection
    mysqli_close($con);
}

function footer()
{
    ?>
    <footer>
        <div class="container">
            <p class="footerText">- CoinCove - <br> - 2024 &copy; -</p>
        </div>
    </footer>
<?php
}

function mobileNav()
{
?>
    <div class="mobileNav" onclick="window.location.href='index.php';">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>

    </div>
<?php
}

function customMessageBox($title, $message, $buttons = [])
{
?>
    <div class="customMessageBoxBlur">
        <div class="customMessageBox accentShadow">
            <div class="customMessageBoxInner">
                <header class="customMessageBoxHeader">
                    <h2><?= htmlspecialchars($title); ?></h2>
                </header>
                <main class="customMessageBoxMain">
                    <p><?= htmlspecialchars($message); ?></p>
                    <div class="customMessageBoxButtonWrapper">

                        <?php
                        foreach ($buttons as $button) {
                            if (isset($button['url'])) {
                        ?>
                                <button onclick="window.location.href='<?php echo $button['url']; ?>'" class="customMessageBoxButton btn"><?php echo htmlspecialchars($button['label']); ?></button>
                            <?php
                            } else {
                            ?>
                                <button onclick="history.go(-1)" class="customMessageBoxButton btn"><?php echo htmlspecialchars($button['label']); ?></button>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </main>
            </div>
        </div>
    </div>
<?php
}

function divide($num1, $num2)
{
    return $num1 / $num2;
}

function calculatePercentageChange($purchasePrice, $currentPrice)
{
    // Calculate the difference between the current price and the purchase price
    $difference = $currentPrice - $purchasePrice;

    // Calculate the percentage change
    $percentageChange = ($difference / $purchasePrice) * 100;

    return $percentageChange;
}

function formatNumber($num)
{
    if ($num >= 1000000000) {
        return number_format($num / 1000000000, 1) . 'b';
    } elseif ($num >= 1000000) {
        return number_format($num / 1000000, 1) . 'm';
    } elseif ($num >= 1000) {
        return number_format($num / 1000, 1) . 'k';
    }

    return $num;
}

function sellCustomAmount()
{
?>
    <div class="sellCustomBackgroundBlur">
        <div class="sellCustom accentShadow">
            <div class="sellCustomTitle">
                <h1>
                    Choose custom amount
                </h1>
            </div>
            <form action="" class="sellCustomForm">
                <ul class="noStyleUL">
                    <li>
                        <input type="hidden" name="customSell">
                        <input type="number" name="customNumber" class="sellCustomInput removeArrow input">
                    </li>
                    <li>
                        <input type="submit" class="btn" value="Sell">
                    </li>
                </ul>
            </form>
        </div>
    </div>
<?php
}

function customSlider($off, $on, $state, $checkboxName)
{
    $checked = $state ? "checked" : "";
?>
    <div class="customSlider">
        <label class="switch">
            <input value="1" name="<?= $checkboxName; ?>" type="checkbox" <?= $checked; ?>>
            <span class="slider">
                <span class="slider-text off"><?= $off; ?></span>
                <span class="slider-text on"><?= $on; ?></span>
            </span>
        </label>
    </div>
<?php
}

function api($limit = 5, $ids = [], $convert = 'USD')
{
    $url = 'https://api.coincap.io/v2/assets';
    $parameters = [
        'limit' => $limit
    ];

    if (!empty($ids)) {
        $parameters['ids'] = implode(',', $ids); // Join the IDs with commas
    }

    $qs = http_build_query($parameters); // Query string encode the parameters
    $request = "{$url}?{$qs}"; // Create the request URL

    $curl = curl_init(); // Get cURL resource
    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => $request,            // Set the request URL
        CURLOPT_HTTPHEADER => [
            'Accepts: application/json'
        ],     // Set the headers
        CURLOPT_RETURNTRANSFER => true,     // Ask for raw response instead of bool
        CURLOPT_CAINFO => __DIR__ . '../../../api/cacert.pem', // Path to the CA bundle file in the same directory
    ));

    $response = curl_exec($curl); // Send the request, save the response

    if ($response === false) {
        $error = curl_error($curl);
        curl_close($curl);
        // die('Curl error: ' . $error);
    }

    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($statusCode !== 200) {
        curl_close($curl);
        // die('Request failed: HTTP status code ' . $statusCode);
    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        curl_close($curl);
        // die('JSON decode error: ' . json_last_error_msg());
    }

    curl_close($curl);

    // Extract and use the data
    $cryptocurrencies = $data['data'] ?? [];

    // Convert prices to the requested currency if needed
    if (strtoupper($convert) !== 'USD' && !empty($cryptocurrencies)) {
        $cryptocurrencies = convertCurrency($cryptocurrencies, $convert);
    }

    return $cryptocurrencies;
}

function convertCurrency($cryptocurrencies, $convert)
{
    $convertUrl = 'https://api.coincap.io/v2/rates/' . strtolower($convert);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $convertUrl,
        CURLOPT_HTTPHEADER => [
            'Accepts: application/json'
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CAINFO => __DIR__ . '../../../api/cacert.pem',
    ));

    $response = curl_exec($curl);

    if ($response === false) {
        $error = curl_error($curl);
        curl_close($curl);
        die('Curl error: ' . $error);
    }

    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($statusCode !== 200) {
        curl_close($curl);
        die('Request failed: HTTP status code ' . $statusCode);
    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        curl_close($curl);
        die('JSON decode error: ' . json_last_error_msg());
    }

    curl_close($curl);

    $rate = $data['data']['rateUsd'] ?? 1;

    foreach ($cryptocurrencies as &$crypto) {
        $crypto['priceUsd'] = $crypto['priceUsd'] * $rate;
    }

    return $cryptocurrencies;
}
?>