<?php
require_once __DIR__ . '/../Models/Post.php';
require_once __DIR__ . '/../config/db_connection.php';

// Get the current page number from the query string (default to 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Number of posts per page
$offset = ($page - 1) * $limit;

// Fetch published blog posts with pagination
$posts = Post::getPublishedPosts($limit, $offset);
//print_r($posts);
// Get total number of published posts to calculate total pages
$totalPosts = Post::getTotalPublishedPosts();
$totalPages = ceil($totalPosts / $limit);

// Pass data to the view
require_once __DIR__ . '/../Views/blogHomepage.html';
