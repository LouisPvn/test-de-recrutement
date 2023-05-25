<?php

declare(strict_types=1);

namespace App;

class Rover
{
    private string $direction;
    private int $y;
    private int $x;

    /**
     * If PHP constraint > version 8 :
     * public function __construct(
     *      private int $x,
     *      private int $y,
     *      private string $direction
     * ) {}
     * 
     * And remove property defined earlier
     */
    public function __construct(int $x, int $y, string $direction)
    {
        $this->direction = $direction;
        $this->y = $y;
        $this->x = $x;
    }

    public function receive(string $commandsSequence): void
    {
        // Cardinal points are sequence so we can use them as it
        $directions = "NESW";
        $currentDirectionIndex = strpos($directions, $this->direction);
        $commands = explode('', $commandsSequence);
        foreach ($commands as $command) {
            
            // Rotate clockwise
            if ($command == "r") {
                $currentDirectionIndex++;
                $this->direction = $directions[$currentDirectionIndex];
                continue;
            }
            // Rotate anticlockwise
            if ($command == "l") {
                $currentDirectionIndex--;
                $this->direction = $directions[$currentDirectionIndex];
                continue;
            }
            
            // Displace rover
            // Moving up or down
            $this->y += ($this->direction == "S" || $this->direction == "N" && $command == "f")
                ? -1
                : 1
            ;
            
            // Moving left or right
            $this->x += ($this->direction == "E" || $this->direction == "W" && $command == "f")
                ? -1
                : 1
            ; 
        }
    }
}