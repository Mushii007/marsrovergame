<?php
namespace App;

use App\Direction;
use App\Rules\RuleFactory;

class Plateau
{

    /**
     * @var int
     */
    private $xAxis;
    /**
     * @var int
     */
    private $yAxis;

    /**
     * @var int
     */
    public $posX;

    /**
     * @var int
     */
    public $posY;

    /**
     * N, S, E , W
     * @var string
     */
    public $cardinalPoint;

    /**
     * A class which contains all the information regarding orientation and position coordinate
     * @var Direction
     */
    public $direction;

    /**
     * A class which contains the moving and spinning rule
     * @var rule
     */
    private $rule;

    /**
     * @param int $xAxis
     * @param int $yAxis
     */
    public function __construct(int $xAxis, int $yAxis)
    {
        $this->xAxis = $xAxis;
        $this->yAxis = $yAxis;
        $this->direction = Direction::getInstance();
        $this->rule = new RuleFactory();
    }

    /**
     * @param int $x
     * @param int $y
     * @param string $direction (N, E, S, W)
     * @return void
     */
    public function setPosition(int $x, int $y, string $direction): void
    {
        $this->posX = $x;
        $this->posY = $y;
        $this->cardinalPoint = $direction;
    }

    /**
     * This functions will spin rover to left and set the direction
     * @return void
     */
    public function spinLeft(): void
    {
        $spinningRule = $this->rule->createRule('spinning');
        $spinningMap = $spinningRule->getSpinningMap()[$this->direction::LEFT];
        switch ($this->cardinalPoint) {

            case $this->direction::NORTH:
                $this->cardinalPoint = $spinningMap[$this->direction::NORTH];
                break;
            case $this->direction::EAST:
                $this->cardinalPoint = $spinningMap[$this->direction::EAST];
                break;
            case $this->direction::SOUTH:
                $this->cardinalPoint = $spinningMap[$this->direction::SOUTH];
                break;
            case $this->direction::WEST:
                $this->cardinalPoint = $spinningMap[$this->direction::WEST];
                break;
            default;
                throw new \Exception("Invalid postion. Please set the positions.");
                break;

        }

    }

    /**
     * This functions will spin rover to right and set the direction
     * @return void
     */
    public function spinRight(): void
    {
        $spinningRule = $this->rule->createRule('spinning');
        $spinningMap = $spinningRule->getSpinningMap()[$this->direction::RIGHT];
        switch ($this->cardinalPoint) {

            case $this->direction::NORTH:
                $this->cardinalPoint = $spinningMap[$this->direction::NORTH];
                break;
            case $this->direction::EAST:
                $this->cardinalPoint = $spinningMap[$this->direction::EAST];
                break;
            case $this->direction::SOUTH:
                $this->cardinalPoint = $spinningMap[$this->direction::SOUTH];
                break;
            case $this->direction::WEST:
                $this->cardinalPoint = $spinningMap[$this->direction::WEST];
                break;
            default;
                throw new \Exception("Invalid postion. Please set the positions.");
                break;

        }

    }

    /**
     * This functions will move rover to forward and set the x & y
     * @return void
     */
    public function stepForward(): void
    {
        $movingRule = $this->rule->createRule();
        $movingMap = $movingRule->getMovingMap();
        switch ($this->cardinalPoint) {
            case $this->direction::NORTH: //  N
                $this->posY += $movingMap[$this->direction::NORTH]['alteration'];
                break;
            case $this->direction::EAST: //  E
                $this->posX += $movingMap[$this->direction::EAST]['alteration'];
                break;
            case $this->direction::SOUTH: //  S
                $this->posY += $movingMap[$this->direction::SOUTH]['alteration'];
                break;
            case $this->direction::WEST: //  W
                $this->posX += $movingMap[$this->direction::WEST]['alteration'];
                break;
            default:
                throw new \Exception("Invalid postion. Please set the positions.");
                break;
        }
    }

    /**
     * Check rover can move on the basis of args
     * @param int $x
     * @param int $x
     * @param string $direction
     * @return bool
     */
    public function checkPossibleMove(int $x, int $y, $direction): bool
    {
        $this->setPosition($x, $y, $direction);
        return ($x > $this->xAxis || $x < 0) || ($x > $this->xAxis || $y < 0) ? false : true;
    }

    /**
     * This function make the rover to move on the palteau
     * @return void
     */
    public function move(string $instruction): void
    {
        if (!$instruction) {
            throw new \Exception("Unable to parse instruction.");
        }
        for ($i = 0; $i < strlen($instruction); $i++) {
            switch ($instruction[$i]) {
                case $this->direction::LEFT:
                    $this->spinLeft();
                    break;

                case $this->direction::RIGHT:
                    $this->spinRight();
                    break;

                case $this->direction::MOVE:
                    $this->stepForward();
                    break;

                default:
                    break;

            }

        }

    }
}
