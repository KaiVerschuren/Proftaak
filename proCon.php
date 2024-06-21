<?php
include("inc/php/functions.php");

session_start();

head("Homepage");
?>

<body>
    <?php
    mobileNav();
    HeaderFunction();
    ?>

    <body>
        <h2>Pros and Cons of Cryptocurrency</h2>
        <table>
            <thead>
                <tr>
                    <th>Pros</th>
                    <th>Cons</th>
                </tr>
            </thead>
            <tbody>
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


    <div class="teamFooter">
        <?php
        footer();
        ?>
    </div>
</body>