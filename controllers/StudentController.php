<?php
require_once __DIR__ . '/../models/Student.php';

class StudentController {
    private $student;

    public function __construct() {
        $this->student = new Student();
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $course = trim($_POST['course'] ?? '');

            // Validate input
            $errors = $this->student->validate($name, $email, $phone, $course);
            
            if (empty($errors)) {
                $result = $this->student->create($name, $email, $phone, $course);
                if ($result) {
                    $_SESSION['success'] = "Student added successfully!";
                    header("Location: index.php");
                    exit();
                } else {
                    error_log("Failed to create student. Data: " . json_encode($_POST));
                    $errors['general'] = "Failed to add student. Please try again.";
                }
            }
            
            return $errors;
        }
        return [];
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $course = trim($_POST['course'] ?? '');

            // Validate input
            $errors = $this->student->validate($name, $email, $phone, $course);
            
            if (empty($errors)) {
                if ($this->student->update($id, $name, $email, $phone, $course)) {
                    $_SESSION['success'] = "Student updated successfully!";
                    header("Location: index.php");
                    exit();
                } else {
                    error_log("Failed to update student. ID: $id, Data: " . json_encode($_POST));
                    $errors['general'] = "Failed to update student. Please try again.";
                }
            }
            
            return $errors;
        }
        return [];
    }

    public function delete($id) {
        if ($this->student->delete($id)) {
            $_SESSION['success'] = "Student deleted successfully!";
        } else {
            error_log("Failed to delete student. ID: $id");
            $_SESSION['error'] = "Failed to delete student. Please try again.";
        }
        header("Location: index.php");
        exit();
    }

    public function getAllStudents() {
        return $this->student->read();
    }

    public function getStudent($id) {
        return $this->student->readOne($id);
    }
} 