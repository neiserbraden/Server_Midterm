<?php
// File to store submitted questions
$questionsFile = 'questions.json';

// Ensure the file exists
if (!file_exists($questionsFile)) {
    file_put_contents($questionsFile, json_encode([]));
}

// Get existing questions
$questions = json_decode(file_get_contents($questionsFile), true) ?? [];

// Get new question data from the form
$newQuestion = [
    'name' => trim($_POST['name']),
    'email' => trim($_POST['email']),
    'question' => trim($_POST['question']),
    'submitted_at' => date('Y-m-d H:i:s')
];

// Add the new question to the array
$questions[] = $newQuestion;

// Save back to JSON
file_put_contents($questionsFile, json_encode($questions, JSON_PRETTY_PRINT));

// Redirect back to the questions page with a success message
header("Location: questions.php?success=1");
exit();
?>
