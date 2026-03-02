<?php
require_once 'AbstractManager.php';
require_once __DIR__ . '/../models/Category.php';

class CategoryManager extends AbstractManager {

    public function __construct() {
        parent::__construct();
    }

    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM categories");
        $categories = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category(
                $row['title'],
                $row['description'],
                (int)$row['id']
            );
        }
        return $categories;
    }

    public function findOne(int $id): ?Category {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Category(
                $row['title'],
                $row['description'],
                (int)$row['id']
            );
        }
        return null;
    }

    public function create(Category $category): void {
        $stmt = $this->db->prepare(
            "INSERT INTO categories (title, description) VALUES (?, ?)"
        );
        $stmt->execute([
            $category->getTitle(),
            $category->getDescription()
        ]);
    }

    public function update(Category $category): void {
        $stmt = $this->db->prepare(
            "UPDATE categories SET title = ?, description = ? WHERE id = ?"
        );
        $stmt->execute([
            $category->getTitle(),
            $category->getDescription(),
            $category->getId()
        ]);
    }

    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>