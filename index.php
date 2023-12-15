<?php
$dsn = "mysql:host=localhost;dbname=arenasets";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->query("SELECT * FROM users");
    $entries = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Data Entries</title>
</head>
<body>
    <h2>API Data Entries</h2>
    
    <!-- Display information -->
    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>API Key</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($entries as $entry): ?>
            <tr>
                <td><?= $entry['id']; ?></td>
                <td><?= $entry['email']; ?></td>
                <td><?= $entry['api_key']; ?></td>
                <td><a href="edit.php?id=<?= $entry['id']; ?>">Edit</a></td>
                <td><a href="delete.php?id=<?= $entry['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- register link -->
    <p><a href="register.php">Register</a></p>
</body>
</html>
