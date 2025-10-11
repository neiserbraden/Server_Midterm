<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$listingsFile = 'listings.json';
$uploadDir = 'assests/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (!file_exists($listingsFile)) {
    file_put_contents($listingsFile, json_encode([]));
}

$listings = json_decode(file_get_contents($listingsFile), true) ?? [];

$imagePath = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $filename = uniqid() . '-' . basename($_FILES['image']['name']);
    $targetFile = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        $imagePath = $targetFile; // save path to JSON
    }
}

$newListing = [
    'title' => trim($_POST['title']),
    'description' => trim($_POST['description']),
    'price' => floatval($_POST['price']),
    'username' => $_SESSION['username'],
    'image' => $imagePath,
    'created_at' => date('Y-m-d H:i:s')
];

$listings[] = $newListing;

file_put_contents($listingsFile, json_encode($listings, JSON_PRETTY_PRINT));

header("Location: make_listing.php?success=1");
exit();
?>

