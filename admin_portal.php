<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$usersFile = 'users.json';
$listingsFile = 'listings.json';

$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];
$listings = file_exists($listingsFile) ? json_decode(file_get_contents($listingsFile), true) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Portal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Admin Portal</h1>
    <a href="admin_logout.php" class="btn btn-danger mb-4">Logout</a>

    <!-- Users Section -->
    <h2>Users</h2>
    <table class="table table-bordered table-striped mb-5">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Address</th>
                <th>City</th>
                <th>Zip</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $index => $user): ?>
                <tr>
                    <form action="admin_user_action.php" method="post">
                        <td><input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required></td>
                        <td><input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required></td>
                        <td><input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" required></td>
                        <td><input type="text" name="city" value="<?= htmlspecialchars($user['city']) ?>" required></td>
                        <td><input type="text" name="zip" value="<?= htmlspecialchars($user['zip']) ?>" required></td>
                        <td>
                            <input type="hidden" name="user_index" value="<?= $index ?>">
                            <button type="submit" name="action" value="update" class="btn btn-sm btn-primary mb-1">Update</button>
                            <button type="submit" name="action" value="delete" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Listings Section -->
    <h2>Listings</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>User</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listings as $index => $listing): ?>
                <tr>
                    <td><?= htmlspecialchars($listing['title']) ?></td>
                    <td><?= htmlspecialchars($listing['description']) ?></td>
                    <td>$<?= number_format($listing['price'], 2) ?></td>
                    <td><?= htmlspecialchars($listing['username']) ?></td>
                    <td><?= htmlspecialchars($listing['created_at']) ?></td>
                    <td>
                        <form action="admin_listing_action.php" method="post">
                            <input type="hidden" name="listing_index" value="<?= $index ?>">
                            <button type="submit" name="action" value="delete" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>

