<?php

include('./inc/php/dbconnection.php');
include('./inc/php/functions.php');

session_start();

head("Leaderboard");
$allUsers = getAllUsers();

$numbering = 1
?>

<?php mobileNav(); ?>
<?php HeaderFunction(); ?>

<body>
    <main class="container">

        <table class="leaderboardTable">
            <thead class="leaderboardTableHead">
                <tr>
                    <th>
                        <p class="leaderboardRank">rank: </p>
                    </th>
                    <th>
                        <p>name: </p>
                    </th>
                    <th>
                        <p>status: </p>
                    </th>
                    <th>
                        <p>amount of credits: </p>
                    </th>
                    <th>
                        <p>created at: </p>
                    </th>
                </tr>
            </thead>
            <tbody class="leaderboardTableBody">
                <?php
                foreach ($allUsers as $user) { 
                ?>
                    <tr>
                        <td class="leaderboardRank">
                        <?= $numbering; ?>
                        </td>
                        <td>
                            <?php echo $user['userDisplayName']; ?>
                        </td>
                        <td>
                            <?php echo $user['userStatus']; ?>
                        </td>
                        <td>
                            <?php echo $user['userCredits']; ?>
                        </td>
                        <td>
                            <?php echo $user['createdAt']; ?>
                        </td>
                    </tr>
                <?php
                $numbering++;
                }
                ?>
            </tbody>
        </table>
    </main>
</body>