<?php
namespace App;

class Direction
{
    const NORTH = 'N';
    const EAST = 'E';
    const SOUTH = 'S';
    const WEST = 'W';
    const COORDINATE_Y = 'y';
    const COORDINATE_X = 'x';
    const RIGHT = 'R';
    const LEFT = 'L';
    const MOVE = 'M';

    /**
     * @var Direction
     */
    private static $instance;

    final public static function getInstance()
    {
        if (!isset($instance)) {
            self::$instance = new Direction();
        }
        return self::$instance;
    }

    private function __construct()
    {
        //
    }

}
