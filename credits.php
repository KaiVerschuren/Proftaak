<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

head("Credits");
headerFunction();
?>
<body>  
    <div class="container creditsWrap">
        <section class="creditsCard">
            <H1>1000 credits</H1>
            <p><strong> &euro;1000,- </strong></p>
            <ol>
                <li>
                    You get 1000 credits.
                </li>
                <li>
                    Nice amount to start.
                </li>
            </ol>
            <button class="btn">Buy</button>
        </section>
        <section class="creditsCard">
            <h1>10000 credits</h1>
            <p><strong> &euro;10000,- </strong></p>
            <ol>
                <li>
                    You get 10000 credits.
                </li>
                <li>
                    It's a little bit cheaper
                </li>
            </ol>
            <button class="btn">Buy</button>
        </section>
        <section class="creditsCard">
            <h1>custom amount</h1>
            <p><strong> 1 euro per credit </strong></p>
            <ol>
                <li>
                    You get the amount of credits you want.
                </li>
            </ol>
            <input type="number" min="1" max="99999999">
            <br>
            <button class="btn">Buy</button> 
        </section>
    </div>
</body>
</html>

<?php
footer()
?>