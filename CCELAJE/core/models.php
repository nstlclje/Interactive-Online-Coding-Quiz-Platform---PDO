<?php
require 'dbConfig.php';

class QuizModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insertStudent($name, $email) {
        $stmt = $this->pdo->prepare("INSERT INTO Students (student_name, email, date_of_registration) VALUES (:name, :email, NOW())");
        $stmt->execute(['name' => $name, 'email' => $email]);
    }

    public function getAllStudents() {
        $stmt = $this->pdo->query("SELECT * FROM Students");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStudent($id, $name, $email) {
        $stmt = $this->pdo->prepare("UPDATE Students SET student_name = :name, email = :email WHERE student_id = :id");
        $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email]);
    }

    public function deleteStudent($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Students WHERE student_id = :id");
        $stmt->execute(['id' => $id]);
    }
}

$model = new QuizModel($pdo);
?>
