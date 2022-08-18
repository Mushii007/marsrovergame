<?php

require_once dirname(__DIR__ . '/instapro') . "/vendor/autoload.php";

$plateauGridSize = [];
$roversInstructions = [];
try {

    $handle = fopen("instructions.txt", "r");
    if (!$handle) {
        throw new \Exception("Something went wrong with file or No such file in the directory.");
    }
    while (($line = fgets($handle)) !== false) {
        if (!$plateauGridSize) {
            list($plateauGridSize['x'], $plateauGridSize['y']) = explode(' ', trim($line));
        } else {
            $roverInstruction = [];
            list($roverInstruction['x'], $roverInstruction['y'], $roverInstruction['direction']) = explode(' ', trim($line));
            $line = fgets($handle);
            $roverInstruction['instructions'] = trim($line);
            $roversInstructions[] = $roverInstruction;
        }
    }
    foreach ($roversInstructions as $roverInstruction) {
        $rover = new \App\Rover(
            new \App\Plateau($plateauGridSize['x'], $plateauGridSize['y']),
            $roverInstruction['x'],
            $roverInstruction['y'],
            $roverInstruction['direction'],
            $roverInstruction['instructions']
        );
        try {
            $rover->executeInstructions();
            print $rover->getDestination() . "\n";
        } catch (\Exception $e) {
            print "Error occurred: " . $e->getMessage();
        }
    }

} catch (\Exception $e) {
    print "Error occurred: " . $e->getMessage();

}
