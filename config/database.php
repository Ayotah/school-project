<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';  // default XAMPP username
    private $password = '';      // default XAMPP password
    private $database = 'logindb';
    private $conn;

    // Getters for connection properties
    public function getHost() { return $this->host; }
    public function getUsername() { return $this->username; }
    public function getPassword() { return $this->password; }
    public function getDatabase() { return $this->database; }

    public function connect() {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            
            if ($this->conn->connect_error) {
                error_log("Database Connection Error: " . $this->conn->connect_error);
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
            
            // Set charset to ensure proper encoding
            if (!$this->conn->set_charset("utf8mb4")) {
                error_log("Error setting charset: " . $this->conn->error);
            }
            
            return $this->conn;
        } catch (Exception $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            die("Connection failed. Please try again later.");
        }
    }

    public function close() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
} 