<?php
$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
$parameters = [
    'start' => '1',
    'limit' => '5000',
    'convert' => 'EUR'
];

$headers = [
    'Accepts: application/json',
    'X-CMC_PRO_API_KEY: 4ae1c817-cef7-484a-8228-3c584d919d51'
];

$qs = http_build_query($parameters); // Query string encode the parameters
$request = "{$url}?{$qs}"; // Create the request URL

$curl = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => $request,            // Set the request URL
    CURLOPT_HTTPHEADER => $headers,     // Set the headers
    CURLOPT_RETURNTRANSFER => true,     // Ask for raw response instead of bool
    CURLOPT_CAINFO => __DIR__ . '/cacert.pem', // Path to the CA bundle file
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
    <title></title>
</head>

<body>
    <h1>Top 5 Cryptocurrencies</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Symbol</th>
                <th>Price (EUR)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cryptocurrencies as $crypto): ?>
            <tr>
                <td><?= $crypto['name'] ?></td>
                <td><?= $crypto['symbol'] ?></td>
                <td><?= $crypto['quote']['EUR']['price'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
<?php
} else {
    echo 'No data available';
}
?>