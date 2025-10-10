<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$usersFile = 'users.json';
$users = json_decode(file_get_contents($usersFile), true) ?? [];

$index = $_POST['user_index'];
$action = $_POST['action'];

if ($action === 'update') {
    $users[$index]['username'] = trim($_POST['username']);
    $users[$index]['email'] = trim($_POST['email']);
    $users[$index]['address'] = trim($_POST['address']);
    $users[$index]['city'] = trim($_POST['city']);
    $users[$index]['zip'] = trim($_POST['zip']);
} elseif ($action === 'delete') {
    array_splice($users, $index, 1);
}

file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
header("Location: admin_portal.php");
exit();
?>

