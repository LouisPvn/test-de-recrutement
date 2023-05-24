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
            if (
                $this->direction == "N"
                || $this->direction == "S"
            ) {
                // Moving up or down
                $this->y += ($this->direction == "S" || $command == "f")
                    ? -1
                    : 1
                ;
                continue;
            }
            
            // Moving left or right
            $this->x += ($this->direction == "E" || $command == "f")
                ? -1
                : 1
            ; 
        }
    }

    /**public function receive(string $commandsSequence): void
    {
        $commandsSequenceLenght = strlen($commandsSequence);
        for ($i = 0; $i < $commandsSequenceLenght; ++$i) {
            $command = substr($commandsSequence, $i, 1);
            if ($command === "l" || $command === "r") {
                // Rotate Rover
                if ($this->direction === "N") {
                    if ($command === "r") {
                        $this->direction = "E";
                    } else {
                        $this->direction = "W";
                    }
                } else if ($this->direction === "S") {
                    if ($command === "r") {
                        $this->direction = "W";
                    } else {
                        $this->direction = "E";
                    }
                } else if ($this->direction === "W") {
                    if ($command === "r") {
                        $this->direction = "N";
                    } else {
                        $this->direction = "S";
                    }
                } else {
                    if ($command === "r") {
                        $this->direction = "S";
                    } else {
                        $this->direction = "N";
                    }
                }
            } else {
                // Displace Rover
                $displacement1 = -1;

                if ($command === "f") {
                    $displacement1 = 1;
                }
                $displacement = $displacement1;

                if ($this->direction === "N") {
                    $this->y += $displacement;
                } else if ($this->direction === "S") {
                    $this->y -= $displacement;
                } else if ($this->direction === "W") {
                    $this->x -= $displacement;
                } else {
                    $this->x += $displacement;
                }
            }
        }
    }*/
}