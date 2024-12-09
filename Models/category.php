<?php
class Category {
    public static function addCategory($name) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    public static function getAllCategories() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
