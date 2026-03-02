<?php

require_once("Character.php");

class Mage extends Character
{
    private int $mana;

    public function __construct(int $life, string $name, int $mana)
    {
        $this->life = $life;
        $this->name = $name;
        $this->mana = $mana;
    }
    
    public function getMana(): int {
        return $this->mana;
    }

    public function setMana(int $mana): void {
        $this->mana = $mana;

    }
    
    public function present(): string {
        return $this->introduce()
            . " | Vie : $this->life | Mana : $this->mana";
    }
}

?>