<?php
include("./inc/php/dbconnection.php");
include("./inc/php/functions.php");

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['removeSingleMessage'])) {
    deleteSingularChat($_POST['messageId']);
    header("location: admin.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['removeMessage'])) {
    deleteChat($_POST['messagesId']);
    header("location: admin.php");
}

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
            "userId" => "All Users",
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

                        <form action="" method="post" class="removeForm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="adminMessageUserDelete">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            <input type="hidden" name="messagesId" value="<?php echo $openChat['userId']; ?>">
                            <input type="submit" name="removeMessage" value="" class="removeSubmit">
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
                        <h2><?= $user['userStatus']; ?></h2>
                        <h2><?= $user['createdAt']; ?></h2>
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

                        <form action="" method="post" class="removeForm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="adminMessageUserDelete">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            <input type="hidden" name="messageId" value="<?php echo $message['id'] ?>">
                            <input type="submit" name="removeSingleMessage" value="" class="removeSubmit">
                        </form>


                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </main>
</body>