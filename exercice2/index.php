<?php

require_once("Character.php");
require_once("Warrior.php");
require_once("Mage.php");

$character = new Character();
$character->setName("Naruto Uzumaki");
$character->setLife(100);

$warrior = new Warrior(150, "Ichigo Kurosaki", 80);
$mage = new Mage(90, "Noelle Silva", 120);

echo $character->present();
echo "<br>";


echo $warrior->present();
echo "<br>";

echo $mage->present();

?>