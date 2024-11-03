<?php
require 'models.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['take_quiz'])) {
    $student_id = $_POST['student_id'];
    $quiz_id = $_POST['quiz_id'];

    header("Location: quizTakingPage.php?student_id=$student_id&quiz_id=$quiz_id");
    exit();
}
?>
