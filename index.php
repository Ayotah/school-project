<?php
require_once 'controllers/StudentController.php';
require_once 'includes/header.php';

$controller = new StudentController();
$students = $controller->getAllStudents();
?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                <h4>Student List
                    <a href="create.php" class="btn btn-primary float-end">Add Student</a>
                        </h4>
                    </div>
                    <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($students)): ?>
                                <?php foreach ($students as $student): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($student['id']); ?></td>
                                        <td><?php echo htmlspecialchars($student['name']); ?></td>
                                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                                        <td><?php echo htmlspecialchars($student['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($student['course']); ?></td>
                                        <td>
                                            <a href="view.php?id=<?php echo $student['id']; ?>" class="btn btn-info btn-sm">View</a>
                                            <a href="edit.php?id=<?php echo $student['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="code.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_student" value="<?php echo $student['id']; ?>" 
                                                        class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                        </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No students found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once 'includes/footer.php'; ?>


