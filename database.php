<?php

$dsn = "mysql:host=localhost;dbname=arenasets";
$username = "root";
$password = "";

try
{
    $db = new PDO($dsn, $username, $password);

} catch (PDOException $e) 
{
    $error_message = $e->getMessage();
    echo("<p>Error Message: $error_message");
}