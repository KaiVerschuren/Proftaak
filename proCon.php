<?php
include("inc/php/functions.php");

session_start();

head("Pros en Cons");
?>

<body>
    <?php
    mobileNav();
    HeaderFunction();
    ?>

    <body class="container">
        <h2 class="proConTableTitle">Pros and Cons of Cryptocurrency</h2>
        <table class="proConTable">
            <thead class="proConTableHead">
                <tr>
                    <th>Pros</th>
                    <th>Cons</th>
                </tr>
            </thead>
            <tbody class="proConTableBody">
                <tr>
                    <td>Decentralization</td>
                    <td>Volatility</td>
                </tr>
                <tr>
                    <td>Transparency and Security</td>
                    <td>Lack of Regulation</td>
                </tr>
                <tr>
                    <td>Low Transaction Fees</td>
                    <td>Security Risks</td>
                </tr>
                <tr>
                    <td>Speed</td>
                    <td>Complexity</td>
                </tr>
                <tr>
                    <td>Accessibility</td>
                    <td>Limited Acceptance</td>
                </tr>
                <tr>
                    <td>Innovation and Flexibility</td>
                    <td>Environmental Impact</td>
                </tr>
                <tr>
                    <td>Potential for High Returns</td>
                    <td>Potential for Illegal Activities</td>
                </tr>
            </tbody>
        </table>
    </body>

    </html>


    <div class="proConFooter">
        <?php
        footer();
        ?>
    </div>
</body>