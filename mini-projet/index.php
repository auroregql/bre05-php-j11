<?php

require_once 'models/User.php';
require_once 'models/Category.php';
require_once 'models/Post.php';
require_once 'managers/UserManager.php';
require_once 'managers/CategoryManager.php';
require_once 'managers/PostManager.php';


$user = new User("JeanDupont", "jean@example.com", "motdepasse123"); 
$category = new Category("Technologie", "Toutes les nouveautés tech");
$post = new Post(
    "Mon premier article",
    "Ceci est un résumé de l'article.",
    "Ceci est le contenu complet de mon article.",
    $user,
    new DateTime()
);


var_dump($user);
var_dump($category);
var_dump($post);


$post->addCategory($category);
$category->addPost($post);


var_dump($post->getCategories());
var_dump($category->getPosts());


$userManager = new UserManager();
$usersFromDb = $userManager->findAll();
var_dump($usersFromDb);


$categoryManager = new CategoryManager();
$categoriesFromDb = $categoryManager->findAll();
var_dump($categoriesFromDb);


$postManager = new PostManager();
$postsFromDb = $postManager->findAll();
var_dump($postsFromDb);
?>