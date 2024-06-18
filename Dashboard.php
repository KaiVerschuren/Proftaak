<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

session_start();

head("Dashboard");
headerFunction();

if (!isset($_SESSION['loginInfo']['userLoginState']) || !$_SESSION['loginInfo']['userLoginState']) {
    customMessageBox(
        "Whoopsie!",
        "You need to be logged in to access our buying page",
        $buttons = [
            ['label' => 'Take me back', 'url' => 'javascript:history.go(-1);'],
            ['label' => 'Let me log in', 'url' => 'loginSignup.php?method=logIn']
        ]
    );
    exit();
}

$getSettings = getUserSettings($_SESSION['loginInfo']['userId']);
foreach ($getSettings as $getSetting) {
    if ($getSetting['userId'] == $_SESSION['loginInfo']['userId']) {
        $userSettings = $getSetting;
    }
}

list($usersSuccess, $getUsers) = getUserInfo($_SESSION['loginInfo']['userId']);
foreach ($getUsers as $getUser) {
    if ($getUser['userId'] == $_SESSION['loginInfo']['userId']) {
        $userInfo = $getUser;
    }
}

$history = getCreditHistory($_SESSION['loginInfo']['userId']);

$labels = [];
$values = [];
foreach ($history as $creditHistory) {
    $labels[] = substr($creditHistory['historyTime'], 0, 10);
    $values[] = $creditHistory['historyCredits'];
}

$favoriteCrypto = getFavoriteCrypto($_SESSION['loginInfo']['userId']);
$crypto = api(100, [], 'EUR');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['changePreferences']) {
    $profilePublic = isset($_POST['profilePublic']) ? 1 : 0;
    $profileCredits = isset($_POST['profileCredits']) ? 1 : 0;
    $profileLeaderboard = isset($_POST['profileLeaderboard']) ? 1 : 0;

    $succes = updatePreferences($_SESSION['loginInfo']['userId'], $profilePublic, $profileCredits, $profileLeaderboard);
    if ($succes) {
        customMessageBox("Successfully hanldel update",
        "Successfully changed to your preferences",
        $buttons = [
            ['label' => 'Continue', 'url' => 'dashboard.php']
        ]   
    );
    }
}
?>

<body>

    <script>
        $(document).ready(function() {
            let labels = <?php echo json_encode($labels); ?>;
            let values = <?php echo json_encode($values); ?>;

            const rootStyles = getComputedStyle(document.documentElement);
            const primaryClr = rootStyles.getPropertyValue('--primary').trim();
            const secondaryClr = rootStyles.getPropertyValue('--secondary').trim();

            const ctx = document.getElementById('dashboardChart').getContext('2d');
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
                            display: true,
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
    <main class="container dashboardMain">
        <div class="dashboardWelcome">
            <h1>
                Welcome, <?php echo $userInfo['userDisplayName']; ?>
            </h1>
        </div>
        <div class="dashboard">
            <div class="dashboardCard dashboardUserInfo accentShadow">
                <h2>User Info</h2>
                <ul class="noStyleUL">
                    <li class="dashboardUserInfoList">Display name: <span class="dashboardBoldText"><?= $userInfo['userDisplayName']; ?></span></li>
                    <li class="dashboardUserInfoList">email: <span class="dashboardBoldText"><?= $userInfo['userEmail']; ?></span></li>
                    <li class="dashboardUserInfoList">Account status: <span class="dashboardBoldText"><?= $userInfo['userStatus']; ?></span></li>
                    <li class="dashboardUserInfoList">Credits: <span class="dashboardBoldText"><?= $userInfo['userCredits']; ?></span></li>
                    <li class="dashboardUserInfoList">

                        <a href="profile.php?profileId=<?= $userInfo['userId'];?>" class="dashboardUserInfoBtn btn">Go to profile</a>

                    </li>
                </ul>
            </div>
            <div class="dashboardCard dashboardPreferences accentShadow">
                <h2>Public Settings</h2>
                <ul class="noStyleUL dashboardUl">
                    <form action="" method="post">
                        <input type="hidden" name="changePreferences" value="true">
                        <li class="dashboardSettingList">
                            <span>Profile Public:</span>
                            <?php
                            $userProfilePublic = $userSettings['profilePublic'];
                            echo customSlider("Off", "On", $userProfilePublic, "profilePublic");
                            ?>
                        </li>
                        <li class="dashboardSettingList">
                            <span>Profile Credits Public:</span>
                            <?php
                            $userProfileCredits = $userSettings['profileCredits'];
                            echo customSlider("Off", "On", $userProfileCredits, "profileCredits");
                            ?>
                        </li>
                        <li class="dashboardSettingList">
                            <span>Profile on leaderboard:</span>
                            <?php
                            $userProfileLeaderboard = $userSettings['profileLeaderboard'];
                            echo customSlider("Off", "On", $userProfileLeaderboard, "profileLeaderboard");
                            ?>
                        </li>
                        <li>
                            <input type="submit" class="btn" value="Change">
                        </li>
                    </form>
                </ul>

            </div>
            <div class="dashboardCard dashboardFavoriteCrypto accentShadow">
                <h2>Favorite crypto</h2>
                <div>
                    <ol class="dashboardFavoriteCryptoOl">
                        <?php
                        foreach ($favoriteCrypto as $favoriteCryptos) {
                            foreach ($crypto as $cryptos) {
                                $class = $cryptos['changePercent24Hr'] >= 0 ? 'yes' : 'no';
                                if ($cryptos['id'] == $favoriteCryptos['currencyFull']) {
                        ?>
                                    <li>
                                        <h3><?= $favoriteCryptos['currencyFull']; ?></h3>
                                        <ul class="noStyleUL">
                                            <li class="dashboardFavoriteCryptoList">
                                                <p>Type:</p><strong><?= $favoriteCryptos['currency']; ?></strong>
                                            </li>
                                            <li class="dashboardFavoriteCryptoList">
                                                <p>Current price: </p><strong>&euro;<?= number_format($cryptos['priceUsd'], 5); ?></strong>
                                            </li>
                                            <li class="dashboardFavoriteCryptoList">
                                                <p>24 Hour change: </p><strong style="color: var(--<?php echo $class; ?>);"><?= number_format($cryptos['changePercent24Hr'], 2) ?>%</strong>
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
            </div>
            <div class="dashboardCard userCreditsGraph accentShadow">
                <canvas id="dashboardChart"></canvas>
            </div>
            <div class="dashboardCard dashboardContact accentShadow">
                <h1>Contact</h1>
                <div class="dashboardComingSoon">
                    <h2 style="color: var(--no);">⚠️ - Coming Soon - ⚠️</h2>
                </div>
            </div>
        </div>
    </main>
</body>

</html>

<?php
footer();
?>