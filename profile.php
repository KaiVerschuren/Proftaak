<?php
include("./inc/php/functions.php");
include("./inc/php/dbconnection.php");

session_start();

$profileId = null;
$isset = false;
$users = [];
$userSettings = null;
$userInfo = [];
$userPreferences = [];
$notFound = false;

// Handle GET request
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['profileId'])) {
    $profileId = $_GET['profileId'];

    if (is_numeric($profileId)) {
        $profileId = (int) $profileId;

        list($isset, $users) = getUserInfo($profileId);
        if (is_array($users) && !empty($users)) {
            foreach ($users as $user) {
                $userInfo = $user;
            }

            if ($isset) {
                $userSettings = getUserSettings($profileId);
                if (is_array($userSettings) && !empty($userSettings)) {
                    foreach ($userSettings as $userSetting) {
                        $userPreferences = $userSetting;
                    }
                }
            }
        }

        if (isset($userInfo['userId'])) {
            $favoriteCrypto = getFavoriteCrypto($profileId);
            $crypto = api(100, [], 'EUR');

            $history = getCreditHistory($userInfo['userId']);
            $labels = [];
            $values = [];
            if (is_array($history)) {
                foreach ($history as $creditHistory) {
                    $labels[] = substr($creditHistory['historyTime'], 0, 10);
                    $values[] = $creditHistory['historyCredits'];
                }
            }
        } else {
            $notFound = true;
        }
    }
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $displayNameSearch = $_POST['displayName'];

    list($success, $userId) = getUserIdFromDisplayName($displayNameSearch);
    if ($success) {
        foreach ($userId as $userInfo) {
            $newId = $userInfo['userId'];
        }
        // Redirect to the new profile ID
        header("Location: ?profileId=$newId");
        exit;
    } else {
        $notFound = true;
    }
}

head("Profile");
headerFunction();
mobileNav();
?>
<script>
    $(document).ready(function() {
        let labels = <?php echo json_encode($labels); ?>;
        let values = <?php echo json_encode($values); ?>;

        const rootStyles = getComputedStyle(document.documentElement);
        const primaryClr = rootStyles.getPropertyValue('--primary').trim();
        const secondaryClr = rootStyles.getPropertyValue('--secondary').trim();

        const ctx = document.getElementById('profileCreditsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Credits',
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
    });
</script>

<body>
    <?php
    if (isset($profileId) && $isset && !empty($users) && (isset($userPreferences['profilePublic']) && ($userPreferences['profilePublic'] == 1 || $_SESSION['loginInfo']['userStatus'] == 'admin'))) {
    ?>
        <main class="container profile">
            <div class="profileCard accentShadow profileInfo slide-in hidden">
                <h2>Profile info</h2>
                <h3><?= $userInfo['userDisplayName']; ?>'s info</h3>
                <ul class="noStyleUL">
                    <li class="profileInfoList">
                        <p>Display name: </p><strong><?= $userInfo['userDisplayName'] ?></strong>
                    </li>
                    <li class="profileInfoList">
                        <p>Account status: </p><strong><?= $userInfo['userStatus'] ?></strong>
                    </li>
                    <?php
                    if ($userPreferences['profileCredits'] == 1 || $_SESSION['loginInfo']['userStatus'] == "admin") {
                    ?>
                        <li class="profileInfoList">
                            <p>Amount of credits: </p><strong><?= formatNumber($userInfo['userCredits']); ?></strong>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="profileInfoList">
                            <p>Users credits are not public</p>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="profileCard accentShadow ProfileCreditHistory slide-in hidden">
                <?php
                if ($userPreferences['profileCredits'] == 1 || $_SESSION['loginInfo']['userStatus'] == 'admin') {
                ?>
                    <canvas id="profileCreditsChart"></canvas>
                <?php
                }
                ?>
            </div>
            <div class="profileCard accentShadow profileMoreInfo slide-in hidden">
                <h2>More info</h2>
                <h3>More info on <?= $userInfo['userDisplayName']; ?></h3>
                <ul class="noStyleUL">
                    <?php
                    if ($userPreferences['profileLeaderboard'] == 1 || $_SESSION['loginInfo']['userStatus'] == 'admin') {
                    ?>
                        <li class="profileFavoriteCryptoList">
                            <p>Leaderboard position:</p><strong>#1</strong>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="profileFavoriteCryptoList">
                            <p>Leaderboard position is private.</p>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="profileFavoriteCryptoList">
                        <p>Last user login:</p><strong><?= substr($userInfo['lastInlog'], 0, 10); ?></strong>
                    </li>
                    <li class="profileFavoriteCryptoList">
                        <p>Account created on:</p><strong><?= substr($userInfo['createdAt'], 0, 10); ?></strong>
                    </li>
                </ul>

            </div>
            <div class="profileCard accentShadow profileFavoriteCrypto slide-in hidden">
                <h2>Favorite crypto</h2>
                <ol class="noStyleUL">
                    <?php
                    foreach ($favoriteCrypto as $favoriteCryptos) {
                        foreach ($crypto as $cryptos) {
                            $class = $cryptos['changePercent24Hr'] >= 0 ? 'yes' : 'no';
                            if ($cryptos['id'] == $favoriteCryptos['currencyFull']) {
                    ?>
                                <li>
                                    <h3><?= $favoriteCryptos['currencyFull']; ?></h3>
                                    <ul class="noStyleUL">
                                        <li class="profileFavoriteCryptoList">
                                            <p>Type:</p><strong><?= $favoriteCryptos['currency']; ?></strong>
                                        </li>
                                        <li class="profileFavoriteCryptoList">
                                            <p>Price:</p><strong>&euro;<?= number_format($cryptos['priceUsd'], 2); ?></strong>
                                        </li>
                                        <li class="profileFavoriteCryptoList">
                                            <p>Changed in 24 Hours:</p><strong style="color: var(--<?php echo $class; ?>);"><?= number_format($cryptos['changePercent24Hr'], 2) ?>%</strong>
                                        </li>
                                    </ul>
                                </li>
                    <?php
                            }
                        }
                    }
                    ?>
                </ol>
            </div>
        </main>
    <?php
    } else if (isset($profileId) && isset($userPreferences['profilePublic']) && $userPreferences['profilePublic'] == 0 && $_SESSION['loginInfo']['userStatus'] != 'admin') {
    ?>
        <main class="container">
            <h1>Users profile isn't public.</h1>
            <button onclick="history.go(-1)" class="btn">Go back</button>
        </main>
    <?php
    } else {
    ?>
        <main class="container">
            <form action="" method="post" class="profileSearchForm">
                <ul class="noStyleUL">
                    <li>
                        <?php
                        if (!isset($_GET['profileId']) && !$notFound) {
                        ?>
                            <h1>No user selected.</h1>
                        <?php
                        } elseif ($notFound) {
                        ?>
                            <h1>User not found.</h1>
                        <?php
                        } else {
                        ?>
                            <h1>User not found or invalid profile ID.</h1>
                        <?php
                        }
                        ?>
                    </li>
                    <li>
                        <input name="displayName" type="text" class="input profileInput" placeholder="Enter display name">
                    </li>
                    <li>
                        <input type="submit" class="input profileInput" value="Search">
                    </li>
                </ul>
            </form>
        </main>
    <?php
    }
    ?>
</body>

</html>