<?php
include('./inc/php/functions.php');
include('./inc/php/dbconnection.php');

$pageState = "";

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['method']) && $_GET['method'] == "logIn") {
        $pageState = "Login";
    } else if (isset($_GET['method']) && $_GET['method'] == "signUp") {
        $pageState = "Sign up";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['method']) && $_GET['method'] == "logIn") {
        $userEmail = filter_var(trim($_POST['loginEmail']), FILTER_SANITIZE_EMAIL);
        $userPassword = trim($_POST['loginPassword']);
        $userHashedPassword = password_hash($userPassword, PASSWORD_BCRYPT);

        $loginInfo = loginWithInfo($userEmail, $userHashedPassword);

        if (isset($loginInfo)) {
            $_SESSION['loginInfo'] = array(
                'userLoginState' => true,
                'userId' => $loginInfo['userId'],
                'userDisplayName' => $loginInfo['userDisplayName'],
                'userEmail' => $loginInfo['userEmail'],
            );

            customMessageBox(
                "Login succesful",
                "You're now succesfully logged into your account.",
                $buttons = [
                    ['label' => 'Home', 'url' => 'index.php'],
                    ['label' => 'Dashboard', 'url' => 'dashboard.php']
                ]
            );
        }
    } else if (isset($_GET['method']) && $_GET['method'] == "signUp") {
        $userDisplayName = htmlspecialchars(trim($_POST['signUpDisplayName']));
        $userEmail = filter_var(trim($_POST['signUpEmail']), FILTER_SANITIZE_EMAIL);
        $userPassword = trim($_POST['signUpPassword']);

        $signUpSuccesfull = signUp($userDisplayName, $userPassword, $userEmail, "user");

        if ($signUpSuccesfull) {
            customMessageBox(
                "Sign up succesful",
                "You're now succesfully signed up",
                $buttons = [
                    ['label' => 'Home', 'url' => 'index.php'],
                    ['label' => 'Log in', 'url' => 'loginSignup.php?method=logIn']
                ]
            );
        } else if (!$signUpSuccesfull) {
            customMessageBox(
                "Email exists",
                "The email youve entered already exists",
                $buttons = [
                    ['label' => 'Log in', 'url' => 'loginSignup.php?method=signUp'],
                    ['label' => 'Home', 'url' => 'index.php']
                ]
            );
        }
    }
}

if (isset($_SESSION['loginInfo']) && $_GET['method'] == "signOut") {

    $_SESSION['loginInfo'] = array(
        'userLoginState' => false,
        'userId' => null,
        'userDisplayName' => "",
        'userEmail' => "",
    );

    customMessageBox(
        "Logged out",
        "The signing out process has been completed succesfully",
        $buttons = [
            ['label' => 'Okay', 'url' => 'index.php']
        ]
    );
}

head($pageState);
mobileNav();
headerFunction();
?>

<body>
    <script defer src="./inc/js/password.js"></script>
    <main class="container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['method']) && $_GET['method'] == "logIn") {
        ?>
                <form class="loginForm" action="" method="post">
                    <ul class="noStyleUL loginUL">
                        <li class="loginInputList">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                            </svg>
                            <input name="loginEmail" class="loginFormInput loginFormEmail" type="text" placeholder="Enter your email">
                        </li class="loginInputList">
                        <li class="loginInputList">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="loginPasswordSvg">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                            </svg>

                            <input name="loginPassword" class="loginFormInput loginPassword" type="password" name="Password" placeholder="Password">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="loginShowPasswordSvg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </li>
                        <li class="loginInputList">
                            <input class="loginFormInput loginformSubmit" type="submit" value="<?= $pageState; ?>">
                        </li>
                    </ul>
                </form>
            <?php
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['method']) && $_GET['method'] == "signUp") {
            ?>
                <form class="loginForm" action="" method="post">
                    <ul class="noStyleUL loginUL">
                        <li class="loginInputList">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>

                            <input required name="signUpDisplayName" class="loginFormInput loginFormDisplay" type="text" placeholder="Enter your display name">
                        </li>
                        <li class="loginInputList">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                            </svg>

                            <input required name="signUpEmail" class="loginFormInput loginFormEmail" type="text" placeholder="Enter your email">
                        </li>
                        <li class="loginInputList">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="loginPasswordSvg">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                            </svg>

                            <input required name="signUpPassword" class="loginFormInput loginPassword" type="password" name="Password" placeholder="Password">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="loginShowPasswordSvg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </li>
                        <li>
                            <input class="loginFormInput loginFormSubmit" type="submit" value="<?= $pageState; ?>">
                        </li>
                    </ul>
                </form>
        <?php
            }
        }
        ?>
    </main>
</body>