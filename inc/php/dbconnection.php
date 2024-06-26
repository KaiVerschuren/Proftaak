<?php

function connectDB()
{
    //
    $mysqli = new mysqli("localhost", "root", "", "coincove");

    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }
    return $mysqli;
}

function loginWithInfo($userEmail)
{
    $con = connectDB();

    // Use a prepared statement to prevent SQL injection
    $sql = "SELECT * FROM `userInfo` WHERE `userEmail` = ?";

    // Prepare the statement
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        die("Statement preparation failed: " . $con->error);
    }

    // Bind the userEmail parameter
    $stmt->bind_param("s", $userEmail);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result->num_rows == 0) {
        customMessageBox(
            "Error",
            "It seems like you've entered a combination of values that dont exist",
            $buttons = [
                ['label' => 'Let me try again', 'url' => 'loginSignup.php?method=logIn'],
                ['label' => 'Take me to sign up', 'url' => 'loginSignup.php?method=signUp']
            ]
        );
    }

    // Fetch data from the result
    $userInfo = $result->fetch_assoc();

    $currentTime = date("Y-m-d H:i:s");
    $updateSql = "UPDATE `userInfo` SET `lastInlog` = ? WHERE `userEmail` = ?";
    $updateStmt = $con->prepare($updateSql);
    $updateStmt->bind_param("ss", $currentTime, $userEmail);
    $updateStmt->execute();

    return $userInfo;
}



function signUp($userDisplayName, $userPassword, $userEmail, $userStatus)
{
    $con = connectDB();

    // Check if the connection is successful
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Check if the email already exists
    $sqlCheck = "SELECT userID FROM `userinfo` WHERE userEmail = ?";
    $stmtCheck = $con->prepare($sqlCheck);

    if (!$stmtCheck) {
        die("Error preparing check statement: " . $con->error);
    }

    $stmtCheck->bind_param("s", $userEmail);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        $stmtCheck->close();
        $con->close();
        return false; // Email already exists
    }

    $stmtCheck->close();

    // Hash the password before storing it
    $hashedPassword = password_hash($userPassword, PASSWORD_BCRYPT);

    // Define the SQL with placeholders
    $sql = "INSERT INTO `userinfo` (userDisplayName, userPassword, userEmail, userStatus) VALUES (?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $con->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $userDisplayName, $hashedPassword, $userEmail, $userStatus);

    // Execute the statement
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }

    // Retrieve the last inserted ID
    $userID = $con->insert_id;

    // Now insert into another table with the retrieved userID
    $sql2 = "INSERT INTO `usersettings` (userID) VALUES (?)";

    // Prepare the second statement
    $stmt2 = $con->prepare($sql2);

    if (!$stmt2) {
        die("Error preparing second statement: " . $con->error);
    }

    // Bind the userID parameter
    $stmt2->bind_param("i", $userID);

    // Execute the second statement
    if (!$stmt2->execute()) {
        die("Error executing second statement: " . $stmt2->error);
    }

    // Close the statements and connection
    $stmt->close();
    $stmt2->close();
    $con->close();

    return true;
}


function addWalletToId($userId, $currency, $currencyFull, $creditAmount, $amountCrypto, $initialPay)
{
    $con = connectDB();

    // check if the connection is successful
    if ($con->connect_error) {
        echo "Connection failed: " . $con->connect_error;
        return; // exit the function or handle the error appropriately
    }

    // convert currencyFull to lowercase
    $currencyFull = strtolower($currencyFull);

    // define the SQL with placeholders
    $sql = "INSERT INTO `userWallet` (currency, currencyFull, amountCredits, amountCrypto, initialPayed, userId) VALUES (?, ?, ?, ?, ?, ?)";

    // prepare the statement
    $stmt = $con->prepare($sql);

    // check for errors during preparation
    if ($stmt->error) {
        echo "Error preparing statement: " . $stmt->error;
        $con->close(); // close the connection
        return false; // exit the function or handle the error appropriately
    }

    // bind parameters
    $stmt->bind_param("ssdddi", $currency, $currencyFull, $creditAmount, $amountCrypto, $initialPay, $userId);

    // execute the statement
    $stmt->execute();

    // check for errors during execution
    if ($stmt->error) {
        echo "Error executing statement: " . $stmt->error;
    } else {
        echo "Data inserted successfully!";
        return true;
    }

    // close the statement and connection
    $stmt->close();
    $con->close();
}

function updateCreditHistory($userId, $newCreditAmount,)
{

    $con = connectDB();
    // Define the SQL
    $sql = "INSERT INTO creditHistory (userId, historyCredits) VALUES (?, ?)";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("ii", $userId, $newCreditAmount);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // Return the updated user credits
    return true;
}

function getCreditHistory($userId)
{
    $con = connectDB();
    // define the SQL
    $sql = "SELECT * from creditHistory WHERE userId = ?";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("i", $userId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch data from result
    $creditHistory = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // return array of links
    return $creditHistory;
}


function getUserCredits($userId)
{
    $con = connectDB();
    // define the SQL
    $sql = "SELECT (userCredits)
    FROM userInfo
    WHERE userId = ?";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("i", $userId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch data from result
    $userCreditsFromId = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // return array of links
    return $userCreditsFromId;
}

function getUserSettings($userId)
{
    $con = connectDB();
    // define the SQL
    $sql = "SELECT * 
    FROM userSettings
    WHERE userId = ?";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("i", $userId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch data from result
    $userSettingsFromId = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // return array of links
    return $userSettingsFromId;
}

function getUserIdFromDisplayName($userDisplayName)
{
    $con = connectDB();
    // define the SQL
    $sql = "SELECT userId 
    FROM userInfo
    WHERE userDisplayName = ?";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("s", $userDisplayName);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch data from result
    $userInfoFromDisplayName = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // Check if user info is found
    if ($userInfoFromDisplayName) {
        return [true, $userInfoFromDisplayName];
    }
    return [false, null];
}

function getUserInfo($userId)
{
    $con = connectDB();
    // define the SQL
    $sql = "SELECT * 
    FROM userInfo
    WHERE userId = ?";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("i", $userId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch data from result
    $userInfoFromId = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // Check if user info is found
    if ($userInfoFromId) {
        return [true, $userInfoFromId];
    }
    return [false, null];
}

function getAllUsers()
{
    $con = connectDB();
    
    // Define the SQL with secondary sorting by userId
    $sql = "SELECT *
            FROM userInfo
            ORDER BY userCredits DESC, userId DESC";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch data from result
    $allInfo = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    return $allInfo;
}


function updateCredits($userId, $newCredits)
{
    if ($newCredits < 0) {
        $newCredits = 0;
    }
    updateCreditHistory($userId, $newCredits);
    $con = connectDB();
    // Define the SQL
    $sql = "UPDATE userInfo
    SET userCredits = ?
    WHERE userId = ?";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("si", $newCredits, $userId);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // Return the updated user credits
    return true;
}

function removeWalletFromId($walletId)
{
    $con = connectDB();
    // Define the SQL
    $sql = "DELETE FROM userwallet WHERE id = ?";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("i", $walletId);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // Return the updated user credits
    return true;
}

function updateWalletFromId($newAmount, $walletId)
{
    $con = connectDB();

    // Update the wallet's amountCredits
    $sqlUpdate = "UPDATE userwallet
    SET amountCredits = ?
    WHERE id = ?";

    // Prepare the update statement
    $stmtUpdate = $con->prepare($sqlUpdate);

    // Bind the parameters for the update
    $stmtUpdate->bind_param("di", $newAmount, $walletId); // Use "di" for double and integer types

    // Execute the update statement
    $stmtUpdate->execute();

    // Close the update statement
    $stmtUpdate->close();

    // Delete wallet rows where amountCredits is 0
    $sqlDelete = "DELETE FROM userwallet WHERE amountCredits = 0";

    // Prepare the delete statement
    $stmtDelete = $con->prepare($sqlDelete);

    // Execute the delete statement
    $stmtDelete->execute();

    // Close the delete statement
    $stmtDelete->close();

    // Close the connection
    $con->close();

    return true;
}

function getFavoriteCrypto($userId)
{
    $con = connectDB();

    // Define the SQL
    $sql = "
        WITH favoriteCrypto AS (
            SELECT
                *,
                ROW_NUMBER() OVER (PARTITION BY currencyFull ORDER BY amountCredits DESC) AS rn
            FROM
                userwallet
            WHERE
                userId = ?
        )
        SELECT
            *
        FROM
            favoriteCrypto
        WHERE
            rn = 1
        ORDER BY
            amountCredits DESC
        LIMIT 3;
    ";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("i", $userId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch data from result
    $threeWallets = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // Return array of links
    return $threeWallets;
}


function getWalletFromId($userId)
{
    $con = connectDB();
    // define the SQL
    $sql = "SELECT *
    FROM userwallet
    WHERE userId = ?";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("i", $userId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch data from result
    $userWallet = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // return array of links
    return $userWallet;
}

function userCounter()
{
    $con = connectDB();


    // Fetch the user count
    $sql = "SELECT COUNT(*) as total FROM userinfo";
    $result = $con->query($sql);

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $multipliedCount = $row["total"];
        echo " " . $multipliedCount;
    } else {
        echo "0 results";
    }
    $stmt->close();
    $con->close();
}

function updateLastInlogFromId($newTime, $userId)
{
    $con = connectDB();

    // Update the wallet's amountCredits
    $sqlUpdate = "UPDATE userinfo
    SET lastInlog = ?
    WHERE userId = ?";

    // Prepare the update statement
    $stmtUpdate = $con->prepare($sqlUpdate);

    // Bind the parameters for the update
    $stmtUpdate->bind_param("si", $newTime, $userId); // Use "di" for double and integer types

    // Execute the update statement
    $stmtUpdate->execute();

    // Close the update statement
    $stmtUpdate->close();

    // Close the connection
    $con->close();

    return true;
}

function getUsersWithContact()
{
    $con = connectDB();
    // define the SQL
    $sql = "SELECT DISTINCT u.*
    FROM userinfo u
    JOIN adminchat c ON u.userId = c.userId
    ";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch data from result
    $users = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // return array of links
    return $users;
}

function getMessageAmount($userId)
{
    $con = connectDB(); // Establish database connection (assuming connectDB() function handles this)

    // Define the SQL query to fetch messages for the given userId
    $sql = "SELECT *
            FROM adminChat
            WHERE userId = ?";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("i", $userId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Count the number of rows (messages)
    $messageCount = $result->num_rows;

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // Return the message count
    return $messageCount;
}

function getMessagesById($userId)
{
    $con = connectDB(); // Establish database connection (assuming connectDB() function handles this)

    // Define the SQL query to fetch messages for the given userId
    $sql = "SELECT *
            FROM adminChat
            WHERE userId = ?
            ORDER BY timeSent DESC";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("i", $userId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $message = $stmt->get_result();

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // Return the message count
    return $message;
}

function getMessages()
{
    $con = connectDB();
    // Define the SQL query to fetch messages for the given userId
    $sql = "SELECT *
            FROM adminChat
            ORDER BY timeSent DESC";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $messages = $stmt->get_result();

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // Return the message count
    return $messages;
}

function getUserLeaderboardPosition($userId)
{
    // Connect to the database
    $con = connectDB();

    // Define the SQL query with subquery for ranking
    $sql = "SELECT
                userId,
                userDisplayName,
                userCredits,
                leaderboardPosition
            FROM (
                SELECT 
                    userId,
                    userDisplayName,
                    userCredits,
                    DENSE_RANK() OVER (ORDER BY userCredits DESC, userId DESC) AS leaderboardPosition
                FROM 
                    userinfo
            ) AS ranked_users
            WHERE userId = ?";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the userId parameter
    $stmt->bind_param("i", $userId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch data from result
    $userLeaderboardPosition = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // Return the array of leaderboard positions for the specified user
    return $userLeaderboardPosition;
}


function updatePreferences($userId, $profilePublic = 0, $profileCredits = 0, $profileLeaderboard = 0)
{
    $con = connectDB();
    $sql = "UPDATE userSettings
    SET profilePublic = ?,
            profileCredits = ?,
            profileLeaderboard = ?
    WHERE userId = ?";

    $stmt = $con->prepare($sql);

    $stmt->bind_param("iiii", $profilePublic, $profileCredits, $profileLeaderboard, $userId);

    $stmt->execute();

    $stmt->close();

    $con->close();

    return true;
}

function sendContact($content, $type, $userId)
{
    $con = connectDB();
    // Define the SQL
    $sql = "INSERT INTO `adminchat` (`content`, `type`, `userId`) VALUES (?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("ssi", $content, $type, $userId);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    return true;
}


function deleteSingularChat($id)
{
    $con = connectDB();
    // Define the SQL
    $sql = "DELETE FROM adminchat WHERE id = ?";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Check if the statement was prepared successfully
    if (!$stmt) {
        // Close the connection
        $con->close();
        return false;
    }

    // Bind the parameter
    $stmt->bind_param("i", $id);

    // Execute the statement
    $stmt->execute();

    // Check if the record was successfully deleted
    $success = $stmt->affected_rows > 0;

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // Return true if deletion was successful, false otherwise
    return $success;
}

function deleteChat($userId)    
{
    $con = connectDB();
    // Define the SQL
    $sql = "DELETE FROM adminchat WHERE userId = ?";

    // Prepare the SQL statement
    $stmt = $con->prepare($sql);

    // Check if the statement was prepared successfully
    if (!$stmt) {
        // Close the connection
        $con->close();
        return false;
    }

    // Bind the parameter
    $stmt->bind_param("i", $userId);

    // Execute the statement
    $stmt->execute();

    // Check if the record was successfully deleted
    $success = $stmt->affected_rows > 0;

    // Close the statement
    $stmt->close();

    // Close the connection
    $con->close();

    // Return true if deletion was successful, false otherwise
    return $success;
}
