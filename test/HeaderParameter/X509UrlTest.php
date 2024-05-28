<?php

namespace Rramacciani\Jwt\HeaderParameter;

class X509UrlTest extends \PHPUnit_Framework_TestCase
{
    private static $name  = 'x5u';
    private static $value = 'foobar';

    /**
     * @var X509Url
     */
    private $parameter;

    public function setUp()
    {
        $this->parameter = new X509Url(self::$value);
    }

    public function testGetName()
    {
        $this->assertSame(self::$name, $this->parameter->getName());
    }

    public function testGetValue()
    {
        $this->assertSame(self::$value, $this->parameter->getValue());
    }

    public function testSetValue()
    {
        $newValue = 'NewValue';

        $this->parameter->setValue($newValue);
        $this->assertSame($newValue, $this->parameter->getValue());
    }
}
