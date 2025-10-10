<?php
session_start();

$usersFile = 'users.json';

// Restrict access if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ensure file exists
if (!file_exists($usersFile)) {
    file_put_contents($usersFile, json_encode([]));
}

$users = json_decode(file_get_contents($usersFile), true) ?? [];

$oldUsername = $_SESSION['username'];

// Get updated form data
$newData = [
    'username' => trim($_POST['username']),
    'email' => trim($_POST['email']),
    'password' => trim($_POST['password']),
    'address' => trim($_POST['address']),
    'city' => trim($_POST['city']),
    'zip' => trim($_POST['zip']),
    'created_at' => $_SESSION['created_at'] ?? date('Y-m-d H:i:s')
];

// Update user in JSON
foreach ($users as &$user) {
    if ($user['username'] === $oldUsername) {
        $user = array_merge($user, $newData);
        break;
    }
}

// Save back to JSON
file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

// Update session data
$_SESSION['username'] = $newData['username'];
$_SESSION['email'] = $newData['email'];
$_SESSION['password'] = $newData['password'];
$_SESSION['address'] = $newData['address'];
$_SESSION['city'] = $newData['city'];
$_SESSION['zip'] = $newData['zip'];

// Redirect back to home with a success message
header("Location: home.php");
exit();
?>
