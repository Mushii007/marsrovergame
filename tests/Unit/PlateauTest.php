<?php
namespace Tests\Unit;

use App\Plateau;
use App\Rules\RuleFactory;
use PHPUnit\Framework\TestCase;

class PlateauTest extends TestCase
{

    private $plateau;

    protected function setUp(): void
    {
        $this->plateau = new Plateau(5, 5);
        $this->ruleFactory = new RuleFactory();
        $this->plateau->setPosition(1, 2, "N");
    }

    public function testSpiningLeft()
    {
        $this->plateau->spinLeft();
        $this->assertEquals($this->plateau->posX, 1);
        $this->assertEquals($this->plateau->posY, 2);
        $this->assertEquals($this->plateau->cardinalPoint, "W");
    }

    public function testSpiningLeftWithoutPositionSetup()
    {
        $this->plateau->spinLeft();
        $this->expectException(\Exception::class);
        throw new \Exception();
        $this->expectExceptionMessage("Invalid postion. Please set the positions.");

    }

    public function testSpiningRight()
    {
        $this->plateau->spinRight();
        $this->assertEquals($this->plateau->posX, 1);
        $this->assertEquals($this->plateau->posY, 2);
        $this->assertEquals($this->plateau->cardinalPoint, "E");

    }

    public function testSpiningRightWithoutPositionSetup()
    {
        $this->plateau->spinRight();
        $this->expectException(\Exception::class);
        throw new \Exception();
        $this->expectExceptionMessage("Invalid postion. Please set the positions.");

    }

    public function testStepForward()
    {
        $this->plateau->stepForward();
        $this->assertEquals(1, $this->plateau->posX);
        $this->assertEquals(3, $this->plateau->posY);
        $this->assertEquals($this->plateau->cardinalPoint, "N");

    }

    public function testStepForwardWithoutPositonSetup()
    {

        $this->plateau->setPosition(0, 0, "");
        $this->expectException(\Exception::class);
        throw new \Exception();
        $this->expectExceptionMessage("Invalid postion. Please set the positions.");

    }

    public function testMoveWithoutInstruction()
    {
        $this->expectException(\Exception::class);
        throw new \Exception();
        $this->expectExceptionMessage("Unable to parse instruction.");
    }

    public function testMove()
    {
        $this->plateau->move("LMLMLMLMM");
        $this->assertEquals(1, $this->plateau->posX);
        $this->assertEquals(3, $this->plateau->posY);
        $this->assertEquals("N", $this->plateau->cardinalPoint);
    }

    public function testPossibleMove()
    {
        $this->plateau->checkPossibleMove(4, 5, "N");
        $this->assertEquals(true, $this->plateau->checkPossibleMove(4, 5, "N"));
        $this->assertEquals(false, $this->plateau->checkPossibleMove(8, 8, "N"));
    }
}
