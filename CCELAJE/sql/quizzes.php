<?php
require '../Core/models.php';

$quizzes = [
    ['quiz_id' => 1, 'title' => 'Python Basics', 'difficulty' => 'Easy', 'questions' => 5, 'completion_time' => 15],
    ['quiz_id' => 2, 'title' => 'PHP Basics', 'difficulty' => 'Easy', 'questions' => 5, 'completion_time' => 15],
    ['quiz_id' => 3, 'title' => 'SQL Basics', 'difficulty' => 'Easy', 'questions' => 5, 'completion_time' => 15],
    ['quiz_id' => 4, 'title' => 'JavaScript Basics', 'difficulty' => 'Easy', 'questions' => 5, 'completion_time' => 15],
];

$student_id = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Quizzes</title>
</head>
<body>

<h2>Available Quizzes</h2>

<table border="1">
    <thead>
        <tr>
            <th>Quiz ID</th>
            <th>Title</th>
            <th>Difficulty Level</th>
            <th>Number of Questions</th>
            <th>Completion Time (min)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($quizzes as $quiz): ?>
            <tr>
                <td><?= htmlspecialchars($quiz['quiz_id']) ?></td>
                <td><?= htmlspecialchars($quiz['title']) ?></td>
                <td><?= htmlspecialchars($quiz['difficulty']) ?></td>
                <td><?= htmlspecialchars($quiz['questions']) ?></td>
                <td><?= htmlspecialchars($quiz['completion_time']) ?></td>
                <td>
                    <a href="quizTakingPage.php?student_id=<?= $student_id ?>&quiz_id=<?= $quiz['quiz_id'] ?>">Take Quiz</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?student_id=<?= $student_id ?>">Back to Students</a>

</body>
</html>
