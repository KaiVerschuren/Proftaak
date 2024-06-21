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
                    <th class="leaderboardTableData">
                        <p class="leaderboardRank">rank: </p>
                    </th>
                    <th class="leaderboardTableName leaderboardTableData">
                        <p>Name: </p>
                    </th>
                    <th class="leaderboardTableStatus leaderboardTableData">
                        <p>Status: </p>
                    </th>
                    <th class="leaderboardTableData">
                        <p>Credits: </p>
                    </th>
                    <th class="leaderboardTableCreatedAt leaderboardTableData">
                        <p>Created at: </p>
                    </th>
                </tr>
            </thead>
            <tbody class="leaderboardTableBody">
                <?php
                foreach ($allUsers as $user) { 
                ?>
                    <tr>
                        <td class="leaderboardRank leaderboardTableData">
                        <?= $numbering; ?>
                        </td>
                        <td class="leaderboardTableData">
                            <?php echo $user['userDisplayName']; ?>
                        </td>
                        <td class="leaderboardTableStatus leaderboardTableData">
                            <?php echo $user['userStatus']; ?>
                        </td>
                        <td  class="leaderboardTableData">
                            <?php echo $user['userCredits']; ?>
                        </td>
                        <td class="leaderboardTableCreatedAt leaderboardTableData">
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