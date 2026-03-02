<?php
require_once 'AbstractManager.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/User.php';
require_once 'UserManager.php';

class PostManager extends AbstractManager {

    public function __construct() {
        parent::__construct();
    }

    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM posts");
        $posts = [];
        $userManager = new UserManager();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $author = $userManager->findOne((int)$row['author']); // récupérer l'objet User
            if ($author) {
                $posts[] = new Post(
                    $row['title'],
                    $row['excerpt'],
                    $row['content'],
                    $author,
                    new DateTime($row['created_at']),
                    (int)$row['id']
                );
            }
        }

        return $posts;
    }

    public function findOne(int $id): ?Post {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $author = (new UserManager())->findOne((int)$row['author']);
            if ($author) {
                return new Post(
                    $row['title'],
                    $row['excerpt'],
                    $row['content'],
                    $author,
                    new DateTime($row['created_at']),
                    (int)$row['id']
                );
            }
        }
        return null;
    }

    public function create(Post $post): void {
        $stmt = $this->db->prepare(
            "INSERT INTO posts (title, excerpt, content, author, created_at) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $post->getTitle(),
            $post->getExcerpt(),
            $post->getContent(),
            $post->getAuthor()->getId(),
            $post->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
    }

    public function update(Post $post): void {
        $stmt = $this->db->prepare(
            "UPDATE posts SET title = ?, excerpt = ?, content = ?, author = ?, created_at = ? WHERE id = ?"
        );
        $stmt->execute([
            $post->getTitle(),
            $post->getExcerpt(),
            $post->getContent(),
            $post->getAuthor()->getId(),
            $post->getCreatedAt()->format('Y-m-d H:i:s'),
            $post->getId()
        ]);
    }

    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>