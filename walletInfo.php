<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

session_start();

head("Wallet");
headerFunction();

if (isset($_SESSION['walletInfo'])) {
    $info = $_SESSION['walletInfo'];
    $crypto = api(5, [], 'EUR');
}

foreach ($crypto as $cryptos) {
    if($cryptos['symbol'] == $info['currency']) {
        $profit = calculatePercentageChange($info['initialPaid'], $cryptos['priceUsd']);
        $class = $profit >= 0 ? 'yes' : 'no';
    }
}

?>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // Set parameters for the AJAX request
            var name = '<?php echo $info['currencyFull']; ?>'; // Example asset name
            var interval = 'd1'; // Example interval

            // Make AJAX request
            $.ajax({
                url: 'https://api.coincap.io/v2/assets/' + name + '/history?interval=' + interval, // Adjusted URL
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Handle successful response
                    console.log(response);

                    // Extract labels and values for the chart
                    let labels = response.data.map((item, index) => index % 1 === 0 ? new Date(item.time).toLocaleDateString() : null).filter(item => item);
                    let values = response.data.map((item, index) => index % 1 === 0 ? item.priceUsd : null).filter(item => item);

                    const rootStyles = getComputedStyle(document.documentElement);
                    const primaryClr = rootStyles.getPropertyValue('--primary').trim();
                    const secondaryClr = rootStyles.getPropertyValue('--secondary').trim();

                    // Create chart
                    const ctx = document.getElementById('myChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Price (USD)',
                                data: values,
                                borderWidth: 2,
                                borderColor: primaryClr,
                                pointRadius: 0,
                                pointBackgroundColor: primaryClr,
                                cubicInterpolationMode: 'monotone'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    display: true,
                                },
                                y: {
                                    display: false,
                                    beginAtZero: false
                                }
                            },
                            plugins: {
                                tooltip: {
                                    enabled: true,
                                    mode: 'index',
                                    intersect: false
                                },
                                legend: {
                                    display: false,
                                    position: 'top'
                                }
                            },
                            animation: {
                                duration: 300,
                                easing: 'linear'
                            },
                            hover: {
                                mode: 'nearest',
                                intersect: false
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
    <div class="info container">
        <div class="cryptoInfo walletInfoCard accentShadow">
            <div class="walletBigDisplay">
                <div class="walletBigWrapper">
                    <div class="walletBigLeft">
                        <h1>Your Info</h1>
                        <h2><?php echo $info['currency']; ?></h2>
                        <p>Amount of coins: <strong><?php echo number_format($info['amountCrypto'], 3); ?></strong></p>
                        <p>Amount of Credits paid: <strong><?php echo $info['amountCredits']; ?></strong></p>
                        <p>Initial amount per coin: <strong><?php echo number_format($info['initialPaid'], 2); ?></strong></p>
                        <p>Percentage changed: <strong style="color: var(--<?php echo $class; ?>);"><?php echo number_format($profit, 2) . "%"; ?></strong></p>
                    </div>
                    <div class="walletBigRight">
                        <h1>Crypto Info</h1>
                        <?php 
                        foreach($crypto as $cryptos) {
                            if ($cryptos['symbol'] == $info['currency']) {
                                $profit = calculatePercentageChange($info['initialPaid'], $cryptos['priceUsd']);
                        ?>
                        <h2><?php echo $cryptos['symbol']; ?></h2>
                        <p>Current amount per coin: <strong><?php echo number_format($cryptos['priceUsd'], 2); ?></strong></p>
                        <p>Current supply: <strong><?php echo formatNumber($cryptos['supply']); ?></strong></p>
                        <p>Market cap: <strong><?php echo formatNumber($cryptos['marketCapUsd']); ?></strong></p>
                        <p>Change in price 24hr: <strong style="color: var(--<?php echo $class; ?>);"><?php echo number_format($cryptos['changePercent24Hr'], 2) . "%"; ?></strong></p>
                        <?php
                        }}
                        ?>
                    </div>
                </div>
            </div>
            <div class="walletSmallDisplay">
                <ul class="noStyleUL">
                    <li>
                        <h1>Your info</h1>
                        <h2><?php echo $info['currency']; ?></h2>
                    </li>
                    <label>Amount of coins:</label>
                    <li>
                    <p><strong><?php echo number_format($info['amountCrypto'], 3); ?></strong></p>
                    </li>
                    <label for="">Amount of credits paid:</label>
                    <li>
                    <p><strong><?php echo $info['amountCredits']; ?></strong></p>
                    </li>
                    <label for="">Initial amount per coin:</label>
                    <li>
                        <p><strong></strong></p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sellCrypto walletInfoCard accentShadow">
            <h1>Sell this crypto</h1>
            <div class="walletSellButtonWrapper">
                <button class="btn">Sell all</button>
                <button class="btn">Sell custom amount</button>
            </div>
        </div>
        <div class="cryptoGraph walletInfoCard accentShadow">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</body>