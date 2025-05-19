<?php
require_once 'config/database.php';

try {
    $database = new Database();
    $conn = $database->connect();
    
    echo "Database connection successful!\n";
    
    // Test table structure
    $result = $conn->query("DESCRIBE students");
    if ($result) {
        echo "\nTable structure:\n";
        while ($row = $result->fetch_assoc()) {
            echo "Field: " . $row['Field'] . ", Type: " . $row['Type'] . "\n";
        }
    } else {
        echo "Error describing table: " . $conn->error . "\n";
    }
    
    // Test insert
    $stmt = $conn->prepare("INSERT INTO students (name, email, phone, course) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $name = "Test Student";
        $email = "test@example.com";
        $phone = "1234567890";
        $course = "Test Course";
        
        $stmt->bind_param("ssss", $name, $email, $phone, $course);
        if ($stmt->execute()) {
            echo "\nTest insert successful! ID: " . $conn->insert_id . "\n";
        } else {
            echo "\nTest insert failed: " . $stmt->error . "\n";
        }
        $stmt->close();
    } else {
        echo "\nPrepare statement failed: " . $conn->error . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
} 