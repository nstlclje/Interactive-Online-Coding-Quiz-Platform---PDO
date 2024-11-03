<?php
require '../Core/models.php';

$student_id = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;
$quiz_id = isset($_GET['quiz_id']) ? intval($_GET['quiz_id']) : 0;

$quizzes_data = [
    1 => [
        'title' => 'Python Basics',
        'difficulty' => 'Easy',
        'questions' => [
            [
                'question' => 'What is the output of print(2 ** 3)?',
                'options' => ['2', '3', '4', '8'],
                'answer' => '8',
                'is_code' => false,
            ],
            [
                'question' => 'What keyword is used to define a function in Python?',
                'options' => ['function', 'def', 'fun', 'define'],
                'answer' => 'def',
                'is_code' => false,
            ],
            [
                'question' => 'Which of the following is a valid list in Python?',
                'options' => ['[1, 2, 3]', '(1, 2, 3)', '{1, 2, 3}', '<1, 2, 3>'],
                'answer' => '[1, 2, 3]',
                'is_code' => false,
            ],
            [
                'question' => 'Write a Python function to return the square of a number.',
                'options' => [],
                'answer' => 'def square(x): return x * x',
                'is_code' => true,
            ],
            [
                'question' => 'Write a Python code snippet to check if a number is even.',
                'options' => [],
                'answer' => 'def is_even(n): return n % 2 == 0',
                'is_code' => true,
            ],
        ],
    ],
    2 => [
        'title' => 'PHP Basics',
        'difficulty' => 'Easy',
        'questions' => [
            [
                'question' => 'What is the correct way to start a session in PHP?',
                'options' => ['session_start();', 'start_session();', 'Session::start();', 'session->start();'],
                'answer' => 'session_start();',
                'is_code' => false,
            ],
            [
                'question' => 'How do you declare a variable in PHP?',
                'options' => ['var $myVar;', '$myVar;', 'variable myVar;', 'myVar = variable;'],
                'answer' => '$myVar;',
                'is_code' => false,
            ],
            [
                'question' => 'How do you comment in PHP?',
                'options' => ['// This is a comment', '# This is a comment', '/* This is a comment */', 'All of the above'],
                'answer' => 'All of the above',
                'is_code' => false,
            ],
            [
                'question' => 'Write a code snippet to create an associative array in PHP.',
                'options' => [],
                'answer' => '$person = ["name" => "John", "age" => 30];',
                'is_code' => true,
            ],
            [
                'question' => 'Write a code snippet to echo a string in PHP.',
                'options' => [],
                'answer' => 'echo "Hello, World!";',
                'is_code' => true,
            ],
        ],
    ],
    3 => [
        'title' => 'SQL Basics',
        'difficulty' => 'Easy',
        'questions' => [
            [
                'question' => 'What command is used to retrieve data from a database?',
                'options' => ['GET', 'SELECT', 'RETRIEVE', 'PULL'],
                'answer' => 'SELECT',
                'is_code' => false,
            ],
            [
                'question' => 'Which statement is used to remove a table from a database?',
                'options' => ['DROP TABLE', 'DELETE TABLE', 'REMOVE TABLE', 'CLEAR TABLE'],
                'answer' => 'DROP TABLE',
                'is_code' => false,
            ],
            [
                'question' => 'What SQL statement is used to insert new data into a table?',
                'options' => ['INSERT INTO', 'ADD TO', 'PUT INTO', 'NEW DATA INTO'],
                'answer' => 'INSERT INTO',
                'is_code' => false,
            ],
            [
                'question' => 'Write a SQL query to select all columns from the "students" table.',
                'options' => [],
                'answer' => 'SELECT * FROM students;',
                'is_code' => true,
            ],
            [
                'question' => 'Write a SQL query to count the number of students.',
                'options' => [],
                'answer' => 'SELECT COUNT(*) FROM students;',
                'is_code' => true,
            ],
        ],
    ],
    4 => [
        'title' => 'JavaScript Basics',
        'difficulty' => 'Easy',
        'questions' => [
            [
                'question' => 'What is the correct way to define a function in JavaScript?',
                'options' => ['function myFunction() {}', 'myFunction() {}', 'def myFunction() {}', 'function: myFunction() {}'],
                'answer' => 'function myFunction() {}',
                'is_code' => false,
            ],
            [
                'question' => 'Which of the following is a valid array declaration in JavaScript?',
                'options' => ['var arr = []', 'var arr = {}', 'var arr = ()', 'var arr = <>'],
                'answer' => 'var arr = []',
                'is_code' => false,
            ],
            [
                'question' => 'What does console.log(typeof NaN) return?',
                'options' => ['"number"', '"NaN"', '"undefined"', '"object"'],
                'answer' => '"number"',
                'is_code' => false,
            ],
            [
                'question' => 'Write a JavaScript function to check if a number is odd.',
                'options' => [],
                'answer' => 'function isOdd(num) { return num % 2 !== 0; }',
                'is_code' => true,
            ],
            [
                'question' => 'Write a JavaScript code to create an object.',
                'options' => [],
                'answer' => 'var person = { name: "John", age: 30 };',
                'is_code' => true,
            ],
        ],
    ],
];

if (!isset($quizzes_data[$quiz_id])) {
    echo "Quiz not found.";
    exit;
}

$quiz = $quizzes_data[$quiz_id];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($quiz['title']); ?></title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function validateQuiz() {
            const questions = document.querySelectorAll('.question');
            let allAnswered = true;

            questions.forEach(function(question) {
                if (question.querySelector('input[type="radio"]')) {
                    const selected = question.querySelector('input[type="radio"]:checked');
                    if (!selected) {
                        allAnswered = false;
                    }
                } else {
                    const codeAnswer = question.querySelector('textarea');
                    if (!codeAnswer.value.trim()) {
                        allAnswered = false;
                    }
                }
            });

            if (!allAnswered) {
                alert('You must answer all questions before submitting the quiz.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1><?php echo htmlspecialchars($quiz['title']); ?></h1>
    <h3>Difficulty: <?php echo htmlspecialchars($quiz['difficulty']); ?></h3>
    <form action="./submitQuiz.php" method="POST" onsubmit="return validateQuiz();">
        <?php foreach ($quiz['questions'] as $index => $question): ?>
            <div class="question">
                <p><?php echo ($index + 1) . ". " . htmlspecialchars($question['question']); ?></p>
                <?php if (!$question['is_code']): ?>
                    <?php foreach ($question['options'] as $option): ?>
                        <label>
                            <input type="radio" name="answer[<?php echo $index; ?>]" value="<?php echo htmlspecialchars($option); ?>">
                            <?php echo htmlspecialchars($option); ?>
                        </label><br>
                    <?php endforeach; ?>
                <?php else: ?>
                    <textarea name="code_answer[<?php echo $index; ?>]" rows="4" cols="50" placeholder="Write your code here..."></textarea>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
        <button type="submit">Submit Quiz</button>
    </form>
</body>
</html>