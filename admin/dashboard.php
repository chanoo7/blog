<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../Models/post.php';

// Fetch all blog posts
$posts = Post::getAllPosts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }
        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            width: 300px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card h3 {
            margin: 0;
            font-size: 20px;
        }
        .card p {
            margin: 10px 0;
            color: #555;
        }
        .card a {
            text-decoration: none;
            color: #007BFF;
            margin-right: 10px;
        }
        .card a:hover {
            text-decoration: underline;
        }
        .create-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            width: fit-content;
        }
        .create-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Welcome to Admin Dashboard</h1>
    <a href="create_post.php" class="create-btn">Create New Post</a>
    <div class="card-container">
        <?php foreach ($posts as $post): ?>
            <div class="card">
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <p>Published on: <?= $post['publish_date'] ?></p>
                <a href="edit_post.php?id=<?= $post['id'] ?>">Edit</a>
                <a href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
