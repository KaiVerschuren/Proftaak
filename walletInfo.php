<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

session_start();

head("Wallet");
headerFunction();

if (isset($_SESSION['walletInfo'])) {
<<<<<<< Updated upstream
}
?>

<body>
    <pre class="container">
        <?php
        var_dump($_SESSION['walletInfo']);
        ?>
    </pre>
=======
    $info = $_SESSION['walletInfo'];
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

>>>>>>> Stashed changes

    <div class="info container">
        <div class="cryptoInfo walletInfoCard">
            <div class="walletBigDisplay">
                <h1>BTC</h1>
                <p>Amount of coins: 0.11</p>
                <p>Amount of Credits paid: 7700</p>
                <p>Initial amount per coin: 68480.72</p>
            </div>
            <div class="walletSmallDisplay">
                <ul class="noStyleUL">
                    <li>
                        <h1>BTC</h1>
                    </li>
                    <label>Amount of coins:</label>
                    <li>
                        <p>0.11</p>
                    </li>
                    <label for="">Amount of credits paid:</label>
                    <li>
                        <p>7700</p>
                    </li>
                    <label for="">Initial amount per coin:</label>
                    <li>
                        <p>68480.72</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sellCrypto walletInfoCard">
            <h1>Sell this crypto</h1>
            <div class="walletSellButtonWrapper">
                <button class="btn">Sell all</button>
                <button class="btn">Sell custom amount</button>
            </div>
        </div>
        <div class="cryptoGraph walletInfoCard">
<<<<<<< Updated upstream
            (insert some graph)
        </div>
=======
            <canvas id="myChart"></canvas>
        </div>

>>>>>>> Stashed changes
    </div>
</body>