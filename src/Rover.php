<?php

namespace App;

use App\Plateau;

class Rover
{

    /**
     * @var Plateau
     */
    private $plateau;

    /**
     * @var int
     */
    private $posX;

    /**
     * @var int
     */
    private $posY;

    /**
     * @var string
     */
    private $direction;

    /**
     * @var string
     */
    private $instruction;

    /**
     * @param Plateau $plateau
     * @param int $posX
     * @param int $posY
     * @param int $direction
     * @param string $instruction
     */

    public function __construct(Plateau $plateau, int $posX, int $posY, string $direction, string $instruction)
    {
        $this->plateau = $plateau;
        $this->posX = $posX;
        $this->posY = $posY;
        $this->direction = $direction;
        $this->instruction = $instruction;
    }

    /**
     * Execute instructions by rover
     * @return void
     */

    public function executeInstructions(): void
    {
        $this->plateau->setPosition($this->posX, $this->posY, $this->direction);
        if (!$this->plateau->checkPossibleMove($this->posX, $this->posY, $this->direction)) {
            throw new \Exception("Move impossible due to points are out of range.");
        }

        $this->plateau->move($this->instruction);
        $this->posX = $this->plateau->posX;
        $this->posY = $this->plateau->posY;
        $this->direction = $this->plateau->cardinalPoint;
    }

    /**
     * Get rover final destination after executing instructions
     * @return string
     */
    public function getDestination(): string
    {
        return sprintf("%d %d %s", $this->posX, $this->posY, $this->direction);
    }
}
