<?php

class User
{
    protected string $email;
    protected string $password;

    public function __construct(){}

    public function login(): array {
        return [
            "login" => $this->email,
            "password" => $this->password
        ];
    }
}

class Reader extends User
{
    private array $favoriteBooks = [];

    public function __construct(string $email, string $password){
        $this->email = $email;
        $this->password = $password;
    }

    public function addBookToFavorites(string $book): array {
        $this->favoriteBooks[] = $book;
        return $this->favoriteBooks;
    }

    public function removeBookFromFavorites(string $book): array {
        foreach($this->favoriteBooks as $key => $favoriteBook){
            if($favoriteBook === $book){
                unset($this->favoriteBooks[$key]);
            }
        }
        return $this->favoriteBooks;
    }
}



$reader = new Reader("reader@mail.com", "1234");

$reader->addBookToFavorites("One Piece");
$favorites = $reader->addBookToFavorites("Naruto");

echo "Liste des favoris : <br>";
print_r($favorites);

$favorites = $reader->removeBookFromFavorites("One Piece");

echo "<br>Après suppression : <br>";
print_r($favorites);

$user = $reader->login();

echo "<br>Email : " . $user["login"];
echo "<br>Mot de passe : " . $user["password"];

?>