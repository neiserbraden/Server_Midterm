<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Listing</title>
    
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
        <h1>Make a Listing</h1>
    </header>

    <main class="container my-5">
        <p class="lead text-center mb-4">Create a listing for a board game you wish to sell.</p>

        <form action="submit_listing.php" method="post" class="mx-auto" style="max-width: 600px;" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Name of Game</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter listing title" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe your listing" required></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" min="0" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Photo</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Submit Listing</button>
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
