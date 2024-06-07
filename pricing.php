<?php

include('./inc/php/functions.php');

session_start();


head("Prices");
headerFunction();
mobileNav();

// api(nummer van limiet, [als gespecificeerd, kun je kiezen welke maar als deze array leeg is], welke valuta)
$cryptocurrencies = api(100, [], 'EUR');

if (!empty($cryptocurrencies)) {
    ?>
    <div class="container">
        <h1 class="pricingTitle">Top Cryptocurrencies</h1>
        <table class="pricingTable">
            <thead class="pricingTableHead">
            <tr class="pricingTableHeadRow">
                <th class="pricingTableRank">Rank</th>
                <th class="pricingTableName">Name</th>
                <th class="pricingTableSymbol">Symbol</th>
                <th class="pricingTablePrice">Price (EUR)</th>
                <th class="pricingTableChange">Changed last 24 Hr</th>
            </tr>
            </thead>
            <tbody class="pricingTableBody">
            <?php foreach ($cryptocurrencies as $crypto):
                $class = $crypto['changePercent24Hr'] >= 0 ? 'yes' : 'no';
                ?>
                <tr class="pricingTableBodyRow">
                    <td class="pricingTableRank"><?= htmlspecialchars($crypto['rank'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="pricingTableName"><?= htmlspecialchars($crypto['name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="pricingTableSymbol"><?= htmlspecialchars($crypto['symbol'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="pricingTablePrice"><?= number_format($crypto['priceUsd'], 2) ?> EUR</td>
                    <td class="pricingTableChange"><strong
                                style="color: var(--<?php echo $class; ?>);"><?= number_format($crypto['changePercent24Hr'], 2) ?>
                            %</strong></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php footer(); ?>


    </body>
    </html>

    <?php
} else {
    echo 'No data available';
}
?>