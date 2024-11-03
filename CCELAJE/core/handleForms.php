<?php
require 'models.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_student'])) {
        $model->insertStudent($_POST['name'], $_POST['email']);
        header("Location: ../Sql/index.php");
        exit();
    }

    if (isset($_POST['update_student'])) {
        $model->updateStudent($_POST['id'], $_POST['name'], $_POST['email']);
        header("Location: ../Sql/index.php");
        exit();
    }

    if (isset($_POST['delete_student'])) {
        $model->deleteStudent($_POST['id']);
        header("Location: ../Sql/index.php");
        exit();
    }
}
?>
