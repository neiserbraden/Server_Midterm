<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions</title>
    
    <!-- Bootstrap 5 CSS -->
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
    />
</head>

<body>
    <header class="bg-primary text-white text-center py-4">
        <h1>Questions & Support</h1>
    </header>

    <main class="container my-5">
        <p class="lead text-center mb-4">Have a question? Submit it below or contact support.</p>

        <form action="submit_question.php" method="post" class="mx-auto" style="max-width: 600px;">
            <div class="mb-3">
                <label for="name" class="form-label">Your Username</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="question" class="form-label">Your Question</label>
                <textarea class="form-control" id="question" name="question" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit Question</button>
        </form>
        <div class="text-center mt-3">
            <a href="home.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </main>

    <footer class="text-center text-muted py-4 border-top">
        <small> <?php echo date('Y'); ?> My Project</small>
    </footer>
</body>
</html>