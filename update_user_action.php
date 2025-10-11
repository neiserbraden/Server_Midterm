<?php
session_start();

$usersFile = 'users.json';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (!file_exists($usersFile)) {
    file_put_contents($usersFile, json_encode([]));
}

$users = json_decode(file_get_contents($usersFile), true) ?? [];

$oldUsername = $_SESSION['username'];

$newData = [
    'username' => trim($_POST['username']),
    'email' => trim($_POST['email']),
    'password' => trim($_POST['password']),
    'address' => trim($_POST['address']),
    'city' => trim($_POST['city']),
    'zip' => trim($_POST['zip']),
    'created_at' => $_SESSION['created_at'] ?? date('Y-m-d H:i:s')
];

foreach ($users as &$user) {
    if ($user['username'] === $oldUsername) {
        $user = array_merge($user, $newData);
        break;
    }
}

file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

$_SESSION['username'] = $newData['username'];
$_SESSION['email'] = $newData['email'];
$_SESSION['password'] = $newData['password'];
$_SESSION['address'] = $newData['address'];
$_SESSION['city'] = $newData['city'];
$_SESSION['zip'] = $newData['zip'];

header("Location: home.php");
exit();
?>

