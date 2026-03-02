<?php
require_once 'AbstractManager.php';
require_once __DIR__ . '/../models/User.php';

class UserManager extends AbstractManager {

    public function __construct() {
        parent::__construct();
    }

    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM users");
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User(
                $row['username'],
                $row['email'],
                $row['password'],
                (string)$row['role'],
                new DateTime($row['created_at']),
                (int)$row['id']
            );
        }
        return $users;
    }

    public function findOne(int $id): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User(
                $row['username'],
                $row['email'],
                $row['password'],
                (string)$row['role'],
                new DateTime($row['created_at']),
                (int)$row['id']
            );
        }
        return null;
    }

    public function create(User $user): void {
        $stmt = $this->db->prepare(
            "INSERT INTO users (username, email, password, role, created_at) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getRole(),
            $user->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
    }

    public function update(User $user): void {
        $stmt = $this->db->prepare(
            "UPDATE users SET username = ?, email = ?, password = ?, role = ?, created_at = ? WHERE id = ?"
        );
        $stmt->execute([
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getRole(),
            $user->getCreatedAt()->format('Y-m-d H:i:s'),
            $user->getId()
        ]);
    }

    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>