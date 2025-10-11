<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$listingsFile = 'listings.json';
$listings = json_decode(file_get_contents($listingsFile), true) ?? [];

$index = $_POST['listing_index'];
$action = $_POST['action'];

if ($action === 'delete') {
    
    if (!empty($listings[$index]['image']) && file_exists($listings[$index]['image'])) {
        unlink($listings[$index]['image']);
    }
    array_splice($listings, $index, 1);
}

file_put_contents($listingsFile, json_encode($listings, JSON_PRETTY_PRINT));
header("Location: admin_portal.php");
exit();
?>

