<?php

use Daison\BusRouterSg\Match;
use Daison\BusRouterSg\Models;

class MatchTest extends Tests\TestCase
{
    public function testSampleRoute()
    {
        $match = new Match\Match(
            # my lat and lng
            1.37313809346006,
            103.89156818388481,

            # destination lat and lng
            1.38372439268243,
            103.76068878232401
        );

        $this->assertTrue(is_array($match->handle()));
    }
}
