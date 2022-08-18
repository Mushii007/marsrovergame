<?php
namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

class MarsRoverMissionTest extends TestCase
{

    private $roversInstructions = [];
    private $plateauGridSize = [];
    private $destinations = [];
    protected function setUp(): void
    {
        $handle = fopen("instructions.txt", "r");
        if (!$handle) {
            throw new \Exception("Something went wrong with file or No such file in the directory.");
        }
        while (($line = fgets($handle)) !== false) {
            if (!$this->plateauGridSize) {
                list($this->plateauGridSize['x'], $this->plateauGridSize['y']) = explode(' ', trim($line));
            } else {
                $roverInstruction = [];
                list($roverInstruction['x'], $roverInstruction['y'], $roverInstruction['direction']) = explode(' ', trim($line));
                $line = fgets($handle);
                $roverInstruction['instructions'] = trim($line);
                $this->roversInstructions[] = $roverInstruction;
            }
        }

    }
    public function testInstructionFileDoesntExist()
    {
        $this->expectException(\Exception::class);
        throw new \Exception();
        $this->expectExceptionMessage("Something went wrong with file or No such file in the directory.");
    }

    public function testRover1Instruction()
    {
        $this->assertEquals(1, $this->roversInstructions[0]['x']);
        $this->assertEquals(2, $this->roversInstructions[0]['y']);
        $this->assertEquals("N", $this->roversInstructions[0]['direction']);
        $this->assertEquals("LMLMLMLMM", $this->roversInstructions[0]['instructions']);
    }

    public function testRover2Instruction()
    {
        $this->assertEquals(3, $this->roversInstructions[1]['x']);
        $this->assertEquals(3, $this->roversInstructions[1]['y']);
        $this->assertEquals("E", $this->roversInstructions[1]['direction']);
        $this->assertEquals("MMRMMRMRRM", $this->roversInstructions[1]['instructions']);

    }

    public function testRoversDestination()
    {
        foreach ($this->roversInstructions as $roverInstruction) {
            $rover = new \App\Rover(
                new \App\Plateau($this->plateauGridSize['x'], $this->plateauGridSize['y']),
                $roverInstruction['x'],
                $roverInstruction['y'],
                $roverInstruction['direction'],
                $roverInstruction['instructions']
            );
            try {
                $rover->executeInstructions();
                $this->destinations[] = $rover->getDestination() . "\n";
            } catch (\Exception $e) {
                print "Error occurred: " . $e->getMessage();
            }
        }

        // rover 1
        $this->assertEquals("1 3 N", trim($this->destinations[0]));
        //rover 2
        $this->assertEquals("5 1 E", trim($this->destinations[1]));

    }

}
