<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';  // default XAMPP username
    private $password = '';      // default XAMPP password
    private $database = 'logindb';
    private $conn;

    public function connect() {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
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