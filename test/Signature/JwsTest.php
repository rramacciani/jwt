<?php

namespace Rramacciani\Jwt\Signature;

use Rramacciani\Jwt\HeaderParameter\Algorithm;

class JwsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $algorithm;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $encryption;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $encoder;

    /**
     * @var Jws
     */
    private $signer;

    public function setUp()
    {
        $this->algorithm = $this->getMockBuilder('Rramacciani\Jwt\Algorithm\None')->getMock();

        $this->encryption = $this->getMockBuilder('Rramacciani\Jwt\Encryption\Symmetric')
            ->setConstructorArgs([$this->algorithm])
            ->getMock();

        $this->encoder = $this->getMockBuilder('Rramacciani\Jwt\Encoding\Base64')->getMock();

        $this->signer = new Jws($this->encryption, $this->encoder);
    }

    public function testSign()
    {
        $expectedSignature = 'foobar';

        // Configure payload

        $headerParameters = $this->getMockBuilder('Rramacciani\Jwt\Token\PropertyList')->getMock();

        $headerParameters->expects($this->once())
            ->method('jsonSerialize');

        $this->encoder->expects($this->at(0))
            ->method('encode');

        $header = $this->getMockBuilder('Rramacciani\Jwt\Token\Header')->getMock();

        $header->expects($this->once())
            ->method('getParameters')
            ->will($this->returnValue($headerParameters));

        // Configure payload

        $claims = $this->getMockBuilder('Rramacciani\Jwt\Token\PropertyList')->getMock();

        $claims->expects($this->once())
            ->method('jsonSerialize');

        $payload = $this->getMockBuilder('Rramacciani\Jwt\Token\Payload')->getMock();

        $payload->expects($this->once())
            ->method('getClaims')
            ->will($this->returnValue($claims));

        $this->encoder->expects($this->at(1))
            ->method('encode');

        // Configure token

        $token = $this->getMockBuilder('Rramacciani\Jwt\Token')->getMock();

        $token->expects($this->once())
              ->method('getHeader')
              ->will($this->returnValue($header));

        $token->expects($this->once())
              ->method('getPayload')
              ->will($this->returnValue($payload));

        $this->encryption->expects($this->once())
            ->method('getAlgorithmName')
            ->will($this->returnValue('alg'));

        $this->encryption->expects($this->once())
            ->method('encrypt')
            ->will($this->returnValue($expectedSignature));

        $token->expects($this->once())
            ->method('addHeader')
            ->with(new Algorithm('alg'));

        $token->expects($this->once())
            ->method('setSignature')
            ->with($expectedSignature);

        $this->signer->sign($token);
    }
}
