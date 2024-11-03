<?php
session_start();

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

$quiz_id = isset($_POST['quiz_id']) ? intval($_POST['quiz_id']) : 0;

if (!isset($quizzes_data[$quiz_id])) {
    echo "Quiz not found.";
    exit;
}

$quiz = $quizzes_data[$quiz_id];

$results = [];
$correct_count = 0;

foreach ($quiz['questions'] as $index => $question) {
    $submitted_answer = isset($_POST['answer'][$index]) ? $_POST['answer'][$index] : '';
    $submitted_code_answer = isset($_POST['code_answer'][$index]) ? trim($_POST['code_answer'][$index]) : '';
    $correct_answer = $question['answer'];

    
    if (!empty($question['options'])) { 
        if ($submitted_answer === $correct_answer) {
            $results[$index] = ['status' => 'correct', 'user_answer' => $submitted_answer];
            $correct_count++;
        } else {
            $results[$index] = ['status' => 'incorrect', 'user_answer' => $submitted_answer, 'correct_answer' => $correct_answer];
        }
    } else { 
        $results[$index] = ['status' => 'typed', 'user_answer' => $submitted_code_answer];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $quiz['title']; ?> - Results</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .correct { color: green; }
        .incorrect { color: red; text-decoration: line-through; }
        .correct-answer { font-weight: bold; }
    </style>
</head>
<body>
    <h1><?php echo $quiz['title']; ?> - Results</h1>
    <p>You answered <?php echo $correct_count; ?> out of <?php echo count($quiz['questions']); ?> questions correctly.</p>

    <?php foreach ($quiz['questions'] as $index => $question): ?>
        <div class="question">
            <p><?php echo ($index + 1) . ". " . $question['question']; ?></p>
            <?php if (!empty($question['options'])): ?>
                <p>Your answer: 
                    <?php 
                    if ($results[$index]['status'] === 'correct') {
                        echo "<span class='correct'>" . htmlspecialchars($results[$index]['user_answer']) . "</span>";
                    } elseif ($results[$index]['status'] === 'incorrect') {
                        echo "<span class='incorrect'>" . htmlspecialchars($results[$index]['user_answer']) . "</span> ";
                        echo "<span class='correct-answer'>(Correct: " . htmlspecialchars($results[$index]['correct_answer']) . ")</span>";
                    }
                    ?>
                </p>
            <?php else: ?>
                <p>Your code answer: 
                    <?php 
                    echo htmlspecialchars($results[$index]['user_answer']);
                    ?>
                </p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <a href="index.php">Return to Available Quizzes</a>
</body>
</html>