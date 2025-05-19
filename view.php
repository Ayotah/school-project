<?php
require_once 'controllers/StudentController.php';
require_once 'includes/header.php';

$id = $_GET['id'] ?? 0;
$controller = new StudentController();
$student = $controller->getStudent($id);

if (!$student) {
    $_SESSION['error'] = "Student not found!";
    header("Location: index.php");
    exit();
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Student Details
                    <a href="index.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <td><?php echo htmlspecialchars($student['id']); ?></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td><?php echo htmlspecialchars($student['name']); ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo htmlspecialchars($student['email']); ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?php echo htmlspecialchars($student['phone']); ?></td>
                            </tr>
                            <tr>
                                <th>Course</th>
                                <td><?php echo htmlspecialchars($student['course']); ?></td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td><?php echo htmlspecialchars($student['created_at']); ?></td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td><?php echo htmlspecialchars($student['updated_at']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="edit.php?id=<?php echo $student['id']; ?>" class="btn btn-primary">Edit Student</a>
                    <form action="code.php" method="POST" class="d-inline">
                        <button type="submit" name="delete_student" value="<?php echo $student['id']; ?>" 
                                class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this student?')">Delete Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?> 