<?php
$dsn = "mysql:host=localhost;dbname=arenasets";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

        // Generates API key
        $apiKey = bin2hex(random_bytes(16));

        $stmt = $db->prepare("INSERT INTO users (email, api_key) VALUES (:email, :api_key)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':api_key', $apiKey);
        $stmt->execute();

        echo "API Key: " . $apiKey;
        echo '<p><a href="index.php">Back</a></p>';
    }
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo("<p>Error Message: $error_message");
}

?>
