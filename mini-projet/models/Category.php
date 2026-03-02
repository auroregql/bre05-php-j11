<?php
class Category {
    private ?int $id;
    private string $title;
    private string $description;
    private array $posts = [];

    public function __construct(string $title, string $description, ?int $id = null) {
        $this->title = $title;
        $this->description = $description;
        $this->id = $id;
    }

    public function getId(): ?int { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function getDescription(): string { return $this->description; }
    public function getPosts(): array { return $this->posts; }

    public function setId(int $id): void { $this->id = $id; }
    public function setTitle(string $title): void { $this->title = $title; }
    public function setDescription(string $description): void { $this->description = $description; }
    public function setPosts(array $posts): void { $this->posts = $posts; }


    public function addPost($post): void {
        if (!in_array($post, $this->posts, true)) {
            $this->posts[] = $post;
        }
    }

    public function removePost($post): void {
        $this->posts = array_filter($this->posts, fn($p) => $p !== $post);
    }
}
?>