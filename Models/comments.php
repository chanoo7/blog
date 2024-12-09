<?php
class Comment {
    public static function getAllComments() {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT c.*, p.title AS post_title 
            FROM comments c 
            JOIN blog_posts p ON c.blog_post_id = p.id
            ORDER BY c.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function approveComment($id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE comments SET approved = TRUE WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function deleteComment($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
