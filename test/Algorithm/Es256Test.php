<?php

namespace Rramacciani\Jwt\Algorithm;

class Es256Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \RuntimeException
     */
    public function testNotImplemented()
    {
        $algorithm = new Es256();
    }
}
