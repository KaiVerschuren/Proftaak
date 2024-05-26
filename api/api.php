<?php
$url = 'https://api.coincap.io/v2/assets';
$parameters = [
    'limit' => '5'  // Limit to top 5 cryptocurrencies
];

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
    CURLOPT_CAINFO => __DIR__ . '/cacert.pem', // Path to the CA bundle file in the same directory
));

$response = curl_exec($curl); // Send the request, save the response

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

// Extract and use the data
$cryptocurrencies = $data['data'] ?? [];

if (!empty($cryptocurrencies)) {
    ?>
<html>

<head>
    <title>Top 5 Cryptocurrencies</title>
</head>

<body>
    <h1>Top 5 Cryptocurrencies</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Symbol</th>
                <th>Price (USD)</th> <!-- Note: CoinCap provides prices in USD by default -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cryptocurrencies as $crypto): ?>
            <tr>
                <td><?= htmlspecialchars($crypto['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($crypto['symbol'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= number_format($crypto['priceUsd'], 2) ?> USD</td> <!-- Ensure proper number formatting -->
            </tr>
            <?php
             endforeach;
             echo hash('sha256', "Admin123");
             ?>
        </tbody>
    </table>
</body>

</html>
<?php
} else {
    echo 'No data available';
}
?>
