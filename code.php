<?php
session_start();
require_once 'controllers/StudentController.php';

$controller = new StudentController();

// Handle different operations based on POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_student'])) {
        $errors = $controller->create();
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            header("Location: index.php");
            exit();
        }
    }
    
    if (isset($_POST['update_student'])) {
        $id = $_POST['id'] ?? 0;
        $errors = $controller->update($id);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            header("Location: edit.php?id=" . $id);
            exit();
        }
    }
    
    if (isset($_POST['delete_student'])) {
        $id = $_POST['delete_student'] ?? 0;
        $controller->delete($id);
    }
}

// Redirect back to index if no operation was performed
header("Location: index.php");
exit(); 