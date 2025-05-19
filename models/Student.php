<?php
require_once __DIR__ . '/../config/database.php';

class Student {
    private $conn;
    private $table = 'students';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Create a new student
    public function create($name, $email, $phone, $course) {
        try {
            $query = "INSERT INTO " . $this->table . " (name, email, phone, course) 
                     VALUES (?, ?, ?, ?)";
            
            $stmt = $this->conn->prepare($query);
            if (!$stmt) {
                error_log("Prepare failed: " . $this->conn->error);
                return false;
            }

            $stmt->bind_param("ssss", $name, $email, $phone, $course);
            
            if (!$stmt->execute()) {
                error_log("Execute failed: " . $stmt->error);
                return false;
            }

            $insert_id = $this->conn->insert_id;
            $stmt->close();
            return $insert_id;
        } catch (Exception $e) {
            error_log("Error creating student: " . $e->getMessage());
            return false;
        }
    }

    // Read all students
    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
            $result = $this->conn->query($query);
            if (!$result) {
                error_log("Query failed: " . $this->conn->error);
                return [];
            }
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log("Error reading students: " . $e->getMessage());
            return [];
        }
    }

    // Read single student
    public function readOne($id) {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            if (!$stmt) {
                error_log("Prepare failed: " . $this->conn->error);
                return null;
            }

            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                error_log("Execute failed: " . $stmt->error);
                return null;
            }

            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
            return $data;
        } catch (Exception $e) {
            error_log("Error reading student: " . $e->getMessage());
            return null;
        }
    }

    // Update student
    public function update($id, $name, $email, $phone, $course) {
        try {
            $query = "UPDATE " . $this->table . " 
                     SET name = ?, email = ?, phone = ?, course = ? 
                     WHERE id = ?";
            
            $stmt = $this->conn->prepare($query);
            if (!$stmt) {
                error_log("Prepare failed: " . $this->conn->error);
                return false;
            }

            $stmt->bind_param("ssssi", $name, $email, $phone, $course, $id);
            
            if (!$stmt->execute()) {
                error_log("Execute failed: " . $stmt->error);
                return false;
            }

            $success = $stmt->affected_rows > 0;
            $stmt->close();
            return $success;
        } catch (Exception $e) {
            error_log("Error updating student: " . $e->getMessage());
            return false;
        }
    }

    // Delete student
    public function delete($id) {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            if (!$stmt) {
                error_log("Prepare failed: " . $this->conn->error);
                return false;
            }

            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                error_log("Execute failed: " . $stmt->error);
                return false;
            }

            $success = $stmt->affected_rows > 0;
            $stmt->close();
            return $success;
        } catch (Exception $e) {
            error_log("Error deleting student: " . $e->getMessage());
            return false;
        }
    }

    // Validate student data
    public function validate($name, $email, $phone, $course) {
        $errors = [];

        if (empty($name)) {
            $errors['name'] = "Name is required";
        }

        if (empty($email)) {
            $errors['email'] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }

        if (empty($phone)) {
            $errors['phone'] = "Phone number is required";
        }

        if (empty($course)) {
            $errors['course'] = "Course is required";
        }

        return $errors;
    }
} 