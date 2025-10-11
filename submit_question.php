<?php
$questionsFile = 'questions.json';

if (!file_exists($questionsFile)) {
    file_put_contents($questionsFile, json_encode([]));
}

$questions = json_decode(file_get_contents($questionsFile), true) ?? [];

$newQuestion = [
    'name' => trim($_POST['name']),
    'email' => trim($_POST['email']),
    'question' => trim($_POST['question']),
    'submitted_at' => date('Y-m-d H:i:s')
];

$questions[] = $newQuestion;

file_put_contents($questionsFile, json_encode($questions, JSON_PRETTY_PRINT));

header("Location: questions.php?success=1");
exit();
?>

