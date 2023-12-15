<?php

$dsn = "mysql:host=localhost;arenasets";
$username = "root";
$password = "";

try {
    // Database connection
    $db = new PDO($dsn, $username, $password);

    // Function to validate API key for a given user ID
    function validateApiKey($db, $apiKey, $userId)
    {
        // Validate and sanitize the user ID
        $userId = filter_var($userId, FILTER_VALIDATE_INT);

        // Check if the user ID is valid
        if ($userId === false || $userId <= 0) {
            return false;
        }

        // Sanitize the APIkey
        $apiKey = filter_var($apiKey, FILTER_SANITIZE_STRING);

    
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :userId AND api_key = :apiKey");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':apiKey', $apiKey);
        $stmt->execute();

        // Return true if valid APIkey
        return $stmt->rowCount() > 0;
    }

    // Check if in the URL
    if (isset($_GET['api_key']) && isset($_GET['user_id'])) {
        $apiKey = $_GET['api_key'];
        $userId = $_GET['user_id'];

        // Validate the APIkey and user ID
        if (validateApiKey($db, $apiKey, $userId)) {
            echo "APIkey & user_id valid.";
        } else {
            echo "Invalid APIkey or user_id.";
        }
    } else {
        // if not provided
        echo "APIkey & user_id required.";
    }
} catch (PDOException $e)
{
    $error_message = $e->getMessage();
    echo ("<p>Error Message: $error_message");
}
?>