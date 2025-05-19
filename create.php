<?php
require_once 'controllers/StudentController.php';
require_once 'includes/header.php';

$errors = $_SESSION['errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['errors'], $_SESSION['form_data']);
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Student
                    <a href="index.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="code.php" method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">Student Name</label>
                        <input type="text" name="name" id="name" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>"
                               value="<?php echo htmlspecialchars($form_data['name'] ?? ''); ?>" required>
                        <?php if (isset($errors['name'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['name']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Student Email</label>
                        <input type="email" name="email" id="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                               value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>" required>
                        <?php if (isset($errors['email'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Student Phone</label>
                        <input type="tel" name="phone" id="phone" class="form-control <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>"
                               value="<?php echo htmlspecialchars($form_data['phone'] ?? ''); ?>" required>
                        <?php if (isset($errors['phone'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['phone']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="course" class="form-label">Student Course</label>
                        <input type="text" name="course" id="course" class="form-control <?php echo isset($errors['course']) ? 'is-invalid' : ''; ?>"
                               value="<?php echo htmlspecialchars($form_data['course'] ?? ''); ?>" required>
                        <?php if (isset($errors['course'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['course']; ?></div>
                        <?php endif; ?>
                    </div>

                    <?php if (isset($errors['general'])): ?>
                        <div class="alert alert-danger"><?php echo $errors['general']; ?></div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <button type="submit" name="save_student" class="btn btn-primary">Save Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Client-side validation
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>

<?php require_once 'includes/footer.php'; ?> 