<?php
class Post {
    public static function getPublishedPosts($limit, $offset) {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT id, title, content, publish_date
            FROM blog_posts
            WHERE publish_date <= NOW()
            ORDER BY publish_date DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTotalPublishedPosts() {
        global $pdo;
        $stmt = $pdo->query("
            SELECT COUNT(*) AS total
            FROM blog_posts
            WHERE publish_date <= NOW()
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
?>
