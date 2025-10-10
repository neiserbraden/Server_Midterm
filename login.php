<?php
session_start();

$usersFile = 'users.json';

// Redirect to home if already logged in
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

// Ensure users file exists
if (!file_exists($usersFile)) {
    file_put_contents($usersFile, json_encode([]));
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $errors[] = "Please enter both username and password.";
    } else {
        $users = json_decode(file_get_contents($usersFile), true) ?? [];

        $userFound = false;
        foreach ($users as $user) {
            if ($user['username'] === $username && $user['password'] === $password) {
                $userFound = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['address'] = $user['address'];
                $_SESSION['city'] = $user['city'];
                $_SESSION['zip'] = $user['zip'];
                header("Location: home.php");
                exit();
            }
        }

        if (!$userFound) {
            $errors[] = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4">Log In</h3>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                   value="<?= htmlspecialchars($username ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Log In</button>
                    </form>

                    <p class="text-center mt-3 mb-0">
                        Don't have an account? <a href="signup.php">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
