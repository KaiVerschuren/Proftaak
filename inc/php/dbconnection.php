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

function loginWithInfo($userEmail, $userPassword)
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


function addWalletToId($userId, $currency, $creditAmount, $amountCrypto, $initialPay)
{
    $con = connectDB();

    // check if the connection is successful
    if ($con->connect_error) {
        echo "Connection failed: " . $con->connect_error;
        return; // exit the function or handle the error appropriately
    }

    // define the SQL with placeholders
    $sql = "INSERT INTO `userWallet` (currency, amountCredits, amountCrypto, initialPayed, userId) VALUES (?, ?, ?, ?, ?)";

    // prepare the statement
    $stmt = $con->prepare($sql);

    // check for errors during preparation
    if ($stmt->error) {
        echo "Error preparing statement: " . $stmt->error;
        $con->close(); // close the connection
        return; // exit the function or handle the error appropriately
    }

    // bind parameters
    $stmt->bind_param("sdddi", $currency, $creditAmount, $amountCrypto, $initialPay, $userId);

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

    // return array of links
    return $userInfoFromId;
}


function updateCredits($userId, $newCredits) {
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





?>