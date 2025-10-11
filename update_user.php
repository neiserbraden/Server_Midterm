<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$password = $_SESSION['password'] ?? ''; 
$address = $_SESSION['address'];
$city = $_SESSION['city'];
$zip = $_SESSION['zip'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Information</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
</head>

<body>
    <header class="bg-primary text-white text-center py-4">
        <h1>Update Your Account Information</h1>
    </header>

    <main class="container my-5">
        <p class="lead text-center mb-4">Modify your details below and click Save Changes.</p>

        <form action="update_user_action.php" method="post" class="mx-auto" style="max-width: 600px;">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="username" 
                    name="username" 
                    value="<?= htmlspecialchars($username) ?>" 
                    required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    name="email" 
                    value="<?= htmlspecialchars($email) ?>" 
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="password" 
                    name="password" 
                    value="<?= htmlspecialchars($password) ?>" 
                    required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="address" 
                    name="address" 
                    value="<?= htmlspecialchars($address) ?>" 
                    required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="city" 
                    name="city" 
                    value="<?= htmlspecialchars($city) ?>" 
                    required>
            </div>

            <div class="mb-3">
                <label for="zip" class="form-label">Zip Code</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="zip" 
                    name="zip" 
                    value="<?= htmlspecialchars($zip) ?>" 
                    required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
        </form>

        <div class="text-center mt-3">
            <a href="home.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </main>

    <footer class="text-center text-muted py-4 border-top">
        <small><?php echo date('Y'); ?> BoardSell</small>
    </footer>
</body>
</html>

