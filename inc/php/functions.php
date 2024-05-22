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
        <title><?php echo $page ?> | Coin Cove</title>
    </head>
<?php
}

function headerFunction()
{
?>
    <header class="container">
        <div class="title">
            <h1>Coin Cove</h1>
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
                <!-- <li class="navList3"><a class="resetAnchorTag" href="">Wallet</a></li> -->
            </ul>
        </nav>
        <div class="loginButtons">
            <a class="resetAnchorTag" href="">Sign up</a>
            <a class="resetAnchorTag btn" href="">Log in</a>
        </div>
    </header>
    <!-- ik wist niet welke links hier in moesten dus ik bedenk maar wat -->
    <div class="dropdownMenu dropdownProducts">
        <ul class="noStyleUL">
            <li>
                <a href="" class="dropdown dropdownLink1 resetAnchorTag">
                    Pricing
                </a>
            </li>
            <li>
                <a href="" class="dropdown dropdownLink2 resetAnchorTag">
                    Buy/Sell crypto
                </a>
            </li>
            <li>
                <a href="" class="dropdown dropdownLink3 resetAnchorTag">
                    Statistics
                </a>
            </li>
        </ul>
    </div>
    <div class="dropdownMenu dropdownAccount">
        <ul class="noStyleUL">
            <li>
                <a href="" class="dropdown dropdownLink1 resetAnchorTag">
                    Account
                </a>
            </li>
            <li>
                <a href="" class="dropdown dropdownLink2 resetAnchorTag">
                    Wallet
                </a>
            </li>
            <li>
                <a href="" class="dropdown dropdownLink3 resetAnchorTag">
                    Credits
                </a>
            </li>
        </ul>
    </div>
<?php
}

function top3Card($placement)
{
?>
    <div class="top3Wrapper <?php echo 'top3Card' . $placement; ?>">
        <div class="top3Picture">
            <img src="./assets/Placeholder881-1000x1000.jpg" alt="Picture" />
        </div>
        <div class="top3Info">
            <h2 class="top3InfoTitle">Spongebob</h2>
            <p class="top3Credits">999,999 Credits</p>
            <span class="top3Placement"><?php echo $placement + 1; ?>st</span>
        </div>
    </div>
<?php
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
?>