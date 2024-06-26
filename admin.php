<?php
include("./inc/php/dbconnection.php");
include("./inc/php/functions.php");

session_start();

head("Admin");
headerFunction();
mobileNav();

if ($_SESSION['loginInfo']['userStatus'] == "user") {
    customMessageBox(
        "Invalid user Status",
        "You arent an admin.",
        $buttons = [
            ['label' => 'Back', 'url' => 'javascript:history.go(-1)']
        ]
    );
    exit;
}

$openChats = getUsersWithContact();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user'])) {
    $messages = getMessagesById($_POST['user']);
    $userDetail = getUserInfo($_POST['user']);
    foreach ($userDetail as $user) {
        $userInfo = $user;
    }
} else {
    $messages = getMessages();
    $userInfo = [
        [
            "userId" => "All users",
            "userDisplayName" => "",
            "userEmail" => "",
            "userStatus" => "",
            "createdAt" => "",
        ]
    ];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset'])) {
    unset($_POST['user']);
    unset($_POST['reset']);
}
?>

<body>
    <main class="admin container">
        <div class="adminInfo adminCard accentShadow">
            <h1>Admin account:</h1>
            <h2><?= $_SESSION['loginInfo']['userDisplayName'] ?></h2>
        </div>
        <div class="adminUserList adminCard accentShadow">
            <h2>Users:</h2>
            <div class="adminUserListWrapper">
                <div class="adminUserHead">
                    <div class="adminUserId">Id:</div>
                    <div class="adminUserName">Name:</div>
                    <div class="adminUserAmount">Message Amount:</div>
                    <form action="" method="post" class="adminUserBtn">
                        <input type="hidden" name="reset">
                        <input type="submit" class="btnNoShadow" value="Reset">
                    </form>
                </div>
                <?php
                foreach ($openChats as $openChat) {
                    $amount = getMessageAmount($openChat['userId']);
                ?>
                    <div class="adminUserRow">
                        <div class="adminUserId"><?= $openChat['userId']; ?></div>
                        <div class="adminUserName"><?= $openChat['userDisplayName']; ?></div>
                        <div class="adminUserAmount"><?= $amount; ?></div>
                        <form action="" method="post" class="adminUserBtn">
                            <input type="hidden" name="user" value="<?= $openChat['userId']; ?>">
                            <input type="submit" class="btnNoShadow" value="Messages">
                        </form>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="adminMessages adminCard accentShadow">
            <div>
                <h1>Messages</h1>
                <div class="adminMessagesUserInfo">
                    <?php
                    foreach ($userInfo as $user) {
                    ?>
                        <h2><?= $user['userDisplayName']; ?></h2>
                        <h2><a href="mailto:<?= $user['userEmail']; ?>"><?= $user['userEmail']; ?></a></h2>
                        <h2 class="adminMessageUserCreatedAt"><?= $user['createdAt']; ?></h2>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="adminMessagesWrapper">
                <?php
                foreach ($messages as $message) {
                ?>
                    <div class="adminMessageUser">
                        <p class="adminMessageUserMessage"><?= $message['content']; ?></p>
                        <p class="adminMessageUserType"><?= $message['type']; ?></p>
                        <p class="adminMessageUserTime"><?= $message['timeSent']; ?></p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </main>
</body>