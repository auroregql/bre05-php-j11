<?php

require_once("Character.php");

class Warrior extends Character
{
    private int $energy;

    public function __construct(int $life, string $name, int $energy)
    {
        $this->life = $life;
        $this->name = $name;
        $this->energy = $energy;
    }
    
    public function getEnergy(): int {
        return $this->energy;
    }

    public function setEnergy(int $energy): void {
        $this->energy = $energy;
    }

    public function present(): string {
        return $this->introduce()
            . " | Vie : $this->life | Énergie : $this->energy";
    }
}

?>