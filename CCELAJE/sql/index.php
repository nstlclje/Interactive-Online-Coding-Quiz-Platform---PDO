<?php
require '../Core/models.php';
$students = $model->getAllStudents();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Interactive Online Coding Quiz Platform</title>
</head>
<body>

<h2>Add New Student</h2>
<form method="POST" action="../Core/handleForms.php">
    <input type="text" name="name" placeholder="Student Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit" name="add_student">Add Student</button>
</form>

<h2>Students List</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
        <th>Quizzes</th>
    </tr>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= htmlspecialchars($student['student_id']) ?></td>
            <td><?= htmlspecialchars($student['student_name']) ?></td>
            <td><?= htmlspecialchars($student['email']) ?></td>
            <td>
                <form method="POST" action="../Core/handleForms.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($student['student_id']) ?>">
                    <input type="text" name="name" value="<?= htmlspecialchars($student['student_name']) ?>" required>
                    <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>
                    <button type="submit" name="update_student">Update</button>
                </form>
                <form method="POST" action="../Core/handleForms.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($student['student_id']) ?>">
                    <button type="submit" name="delete_student">Delete</button>
                </form>
            </td>
            <td>
                <a href="quizzes.php?student_id=<?= htmlspecialchars($student['student_id']) ?>">Quiz</a> 
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
