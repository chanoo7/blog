<?php
require_once __DIR__ . '/../Models/Post.php';
require_once __DIR__ . '/../config/db_connection.php';
// Get the current page number from the query string (default to 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Number of posts per page
$offset = ($page - 1) * $limit;

// Fetch published blog posts with pagination
$posts = Post::getPublishedPosts($limit, $offset);

// Get total number of published posts to calculate total pages
$totalPosts = Post::getTotalPublishedPosts();
$totalPages = ceil($totalPosts / $limit);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Homepage</title>
</head>
<body>
    <h1>Welcome to the Blog</h1>

    <!-- Display posts -->
    <div>
        
    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
    <?php foreach ($posts as $post): ?>
        <div style="border: 1px solid #ddd; border-radius: 8px; padding: 16px; width: calc(15% - 20px); box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h2 style="font-size: 1.2em; margin-bottom: 10px;"><?= htmlspecialchars($post['title']) ?></h2>
            <p style="color: #555; font-size: 0.9em;"><?= htmlspecialchars(substr($post['content'], 0, 150)) ?>...</p>
            <p style="color: #999; font-size: 0.8em;"><small>Published on <?= $post['publish_date'] ?></small></p>
            <a href="?page=post&id=<?= $post['id'] ?>" style="display: inline-block; margin-top: 10px; padding: 8px 12px; background: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Read More</a>
        </div>
    <?php endforeach; ?>
</div>

       
    </div>

    <!-- Pagination -->
    <nav>
        <ul style="list-style: none; display: flex; gap: 10px;">
            <?php if ($page > 1): ?>
                <li><a href="?page=<?= $page - 1 ?>">Previous</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li><a href="?page=<?= $i ?>" style="<?= $i == $page ? 'font-weight: bold;' : '' ?>"><?= $i ?></a></li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li><a href="?page=<?= $page + 1 ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</body>
</html>
