<?php
require_once 'database.php';

function setupDatabase() {
    try {
        // Create a connection without database name first
        $database = new Database();
        $conn = new mysqli(
            $database->getHost(),
            $database->getUsername(),
            $database->getPassword()
        );
        
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        // Read and execute the SQL file
        $sql = file_get_contents(__DIR__ . '/schema.sql');
        
        // Split the SQL file into individual statements
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        
        // Execute each statement
        foreach ($statements as $statement) {
            if (!empty($statement)) {
                if (!$conn->query($statement)) {
                    throw new Exception("Error executing statement: " . $conn->error);
                }
            }
        }

        echo "Database setup completed successfully!\n";
        
    } catch (Exception $e) {
        die("Database setup failed: " . $e->getMessage() . "\n");
    } finally {
        if (isset($conn)) {
            $conn->close();
        }
    }
}

// Run the setup
setupDatabase(); 