<?php
class Post {
    public static function getAllPosts() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM blog_posts ORDER BY publish_date DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createPost($title, $content, $author_id, $category) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO blog_posts (title, content, author_id, category) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $content, $author_id, $category]);
    }
}
?>



<?php
class Post {
    public static function getPostById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updatePost($id, $title, $content, $category) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE blog_posts SET title = ?, content = ?, category = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $category, $id]);
    }

    public static function deletePost($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
