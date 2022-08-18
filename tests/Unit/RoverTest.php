<?php
namespace Tests\Unit;

use App\Direction;
use App\Plateau;
use App\Rover;
use PHPUnit\Framework\TestCase;

final class RoverTest extends TestCase
{
    private $plateau;
    private $rover;
    private $direction;

    protected function setUp(): void
    {
        $this->plateau = new Plateau(5, 5);
        $this->direction = Direction::getInstance();
    }

    public function testExecuteInstruction()
    {
        $this->rover = new Rover($this->plateau, 1, 2, "N", "LMLMLMLMM");
        $this->rover->executeInstructions();
        $this->assertEquals($this->plateau->posX, 1);
        $this->assertEquals($this->plateau->posY, 3);
        $this->assertEquals($this->plateau->cardinalPoint, "N");
    }

    public function testExecuteInstructionWithDiffInputs()
    {

        $rover = new Rover($this->plateau, 1, 2, $this->direction::NORTH, 'LMLMLMLMM');
        $rover->executeInstructions();
        $this->assertEquals('1 3 N', $rover->getDestination());

        $rover = new Rover($this->plateau, 3, 3, $this->direction::EAST, 'MMRMMRMRRM');
        $rover->executeInstructions();
        $this->assertEquals('5 1 E', $rover->getDestination());

        $rover = new Rover($this->plateau, 5, 5, $this->direction::SOUTH, 'MMMMMRMMMMM');
        $rover->executeInstructions();
        $this->assertEquals('0 0 W', $rover->getDestination());

        $rover = new Rover($this->plateau, 0, 0, $this->direction::EAST, 'MMMMMLMMMMM');
        $rover->executeInstructions();
        $this->assertEquals('5 5 N', $rover->getDestination());

    }

    public function testExecuteInstructionException()
    {
        $rover = new Rover($this->plateau, 8, 10, $this->direction::SOUTH, 'MMMMMLMMMMM');
        $this->expectException(\Exception::class);
        throw new \Exception();
        $this->expectExceptionMessage("Move impossible due to points are out of range.");
    }

}
