<?php
session_start();

$listingsFile = 'listings.json';
if (!file_exists($listingsFile)) {
    file_put_contents($listingsFile, json_encode([]));
}

$listings = json_decode(file_get_contents($listingsFile), true) ?? [];

$query = trim($_GET['query'] ?? '');
if ($query !== '') {
    $listings = array_filter($listings, function($listing) use ($query) {
        return stripos($listing['title'], $query) !== false
            || stripos($listing['description'], $query) !== false;
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Listings</title>

    <!-- Bootstrap 5 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <style>
        .card img {
            object-fit: cover;
            height: 200px;
        }
    </style>
</head>

<body>
    <header class="bg-primary text-white text-center py-4">
        <h1>Browse Listings</h1>
    </header>

    <main class="container my-5">
        <form class="d-flex justify-content-center mb-4" method="get">
            <input class="form-control me-2" type="search" name="query" placeholder="Search for listings..." style="max-width: 400px;" value="<?= htmlspecialchars($query) ?>">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>

        <?php if (empty($listings)): ?>
            <p class="text-center text-muted">No listings found.</p>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($listings as $listing): ?>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <?php if (!empty($listing['image']) && file_exists($listing['image'])): ?>
                                <img src="<?= htmlspecialchars($listing['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($listing['title']) ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($listing['title']) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($listing['description']) ?></p>
                                <p class="fw-bold">$<?= number_format($listing['price'], 2) ?></p>
                                <p class="text-secondary">Posted by: <?= htmlspecialchars($listing['username']) ?></p>
                                <p class="text-muted"><small><?= htmlspecialchars($listing['created_at']) ?></small></p>
                                
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="text-center text-muted py-4 border-top">
        <small> <?= date('Y') ?> My Project</small>
    </footer>
</body>
</html>

