<?php
require_once 'config/database.php';

function getConnection() {
    $database = new Database();
    return $database->connect();
}

// Example usage:
// $conn = getConnection();
// Use $conn for database operations
// $database->close(); // When done with the connection