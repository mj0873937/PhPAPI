<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include "database.php";
global $db;

$sql = "SELECT * FROM pvp_gear_sets";

if (isset($_GET['id'])) 
{
    $sql .= " WHERE Season = :id";

    // Prepare the statement
    $stmt = $db->prepare($sql);

    //  Bind the 'id' parameter to the value from $_GET, ensuring it's an integer
    $stmt->bindValue(':id', filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS));

    // Execute the prepared statement
    $stmt->execute();
    $qry = $stmt->fetchAll();

} else
{
    $qry = $db->query($sql)->fetchAll();
}




echo json_encode($qry);









?>







