<?php
session_start();

$usersFile = 'users.json';

if (!file_exists($usersFile)) {
    file_put_contents($usersFile, json_encode([]));
}

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $zip = trim($_POST['zip'] ?? '');

    if ($username === '' || $email === '' || $password === '' || $address === '' || $city === '' || $zip === '') {
        $errors[] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    $users = json_decode(file_get_contents($usersFile), true) ?? [];

    foreach ($users as $user) {
        if ($user['username'] === $username) {
            $errors[] = "Username already exists.";
        }
        if ($user['email'] === $email) {
            $errors[] = "Email is already registered.";
        }
    }

    if (empty($errors)) {
        $newUser = [
            'username' => $username,
            'email' => $email,
            'password' => $password, 
            'address' => $address,
            'city' => $city,
            'zip' => $zip,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $users[] = $newUser;
        file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

        $success = "Registration successful! You can now <a href='login.php'>log in</a>.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4">Create an Account</h3>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                   value="<?= htmlspecialchars($username ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   value="<?= htmlspecialchars($email ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" id="address" class="form-control"
                                   value="<?= htmlspecialchars($address ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" id="city" class="form-control"
                                   value="<?= htmlspecialchars($city ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="zip" class="form-label">Zip Code</label>
                            <input type="text" name="zip" id="zip" class="form-control"
                                   value="<?= htmlspecialchars($zip ?? '') ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                    </form>

                    <p class="text-center mt-3 mb-0">
                        Already have an account? <a href="login.php">Log in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

