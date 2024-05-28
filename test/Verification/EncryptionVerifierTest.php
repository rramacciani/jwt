<?php

namespace Rramacciani\Jwt\Verification;

use Rramacciani\Jwt\HeaderParameter;

class EncryptionVerifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|\Rramacciani\Jwt\Token\Header
     */
    private $header;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|\Rramacciani\Jwt\Token
     */
    private $token;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|\Rramacciani\Jwt\Algorithm\AlgorithmInterface
     */
    private $algorithm;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|\Rramacciani\Jwt\Encryption\EncryptionInterface
     */
    private $encryption;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|\Rramacciani\Jwt\Encoding\EncoderInterface
     */
    private $encoder;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|\Rramacciani\Jwt\Signature\SignerInterface
     */
    private $signer;

    public function setUp()
    {
        $this->header = $this->getMockBuilder('Rramacciani\Jwt\Token\Header')->getMock();

        $this->token = $this->getMockBuilder('Rramacciani\Jwt\Token')->getMock();

        $this->token->expects($this->any())
            ->method('getHeader')
            ->will($this->returnValue($this->header));

        $this->algorithm = $this->getMockBuilder('Rramacciani\Jwt\Algorithm\None')->getMock();

        $this->encryption = $this->getMockBuilder('Rramacciani\Jwt\Encryption\Symmetric')
            ->setConstructorArgs([$this->algorithm])
            ->getMock();

        $this->encoder = $this->getMockBuilder('Rramacciani\Jwt\Encoding\Base64')->getMock();

        $this->signer = $this->getMockBuilder('Rramacciani\Jwt\Signature\Jws')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Algorithm parameter not found in token header.
     */
    public function testMissingAlgorithm()
    {
        $this->header->expects($this->once())
            ->method('findParameterByName')
            ->with(HeaderParameter\Algorithm::NAME)
            ->will($this->returnValue(null));

        $verifier = new EncryptionVerifier($this->encryption, $this->encoder);
        $verifier->verify($this->token);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Cannot use "bar" algorithm to decrypt token encrypted with algorithm "foo".
     */
    public function testAlgorithmMismatch()
    {
        $algorithmParameter = $this->getMockBuilder('Rramacciani\Jwt\HeaderParameter\Algorithm')->getMock();

        $algorithmParameter->expects($this->exactly(2))
            ->method('getValue')
            ->will($this->returnValue('foo'));

        $this->header->expects($this->once())
            ->method('findParameterByName')
            ->with(HeaderParameter\Algorithm::NAME)
            ->will($this->returnValue($algorithmParameter));

        $this->encryption->expects($this->exactly(2))
            ->method('getAlgorithmName')
            ->will($this->returnValue('bar'));

        $verifier = new EncryptionVerifier($this->encryption, $this->encoder);
        $verifier->verify($this->token);
    }

    /**
     * @expectedException \Rramacciani\Jwt\Exception\InvalidSignatureException
     * @expectedExceptionMessage Signature is invalid.
     */
    public function testInvalidSignature()
    {
        $algorithmParameter = $this->getMockBuilder('Rramacciani\Jwt\HeaderParameter\Algorithm')->getMock();

        $algorithmParameter->expects($this->once())
                           ->method('getValue')
                           ->will($this->returnValue('foo'));

        $this->header->expects($this->once())
                     ->method('findParameterByName')
                     ->with(HeaderParameter\Algorithm::NAME)
                     ->will($this->returnValue($algorithmParameter));

        $this->encryption->expects($this->once())
                         ->method('getAlgorithmName')
                         ->will($this->returnValue('foo'));

        $this->encryption->expects($this->once())
                         ->method('verify')
                         ->will($this->returnValue(false));

        $this->signer->expects($this->once())
                     ->method('getUnsignedValue')
                     ->will($this->returnValue('foo'));

        $this->token->expects($this->once())
                    ->method('getSignature')
                    ->will($this->returnValue('bar'));

        $verifier = new EncryptionVerifierStub($this->encryption, $this->encoder, $this->signer);
        $verifier->verify($this->token);
    }

    public function testValidSignature()
    {
        $algorithmParameter = $this->getMockBuilder('Rramacciani\Jwt\HeaderParameter\Algorithm')->getMock();

        $algorithmParameter->expects($this->once())
            ->method('getValue')
            ->will($this->returnValue('foo'));

        $this->header->expects($this->once())
            ->method('findParameterByName')
            ->with(HeaderParameter\Algorithm::NAME)
            ->will($this->returnValue($algorithmParameter));

        $this->encryption->expects($this->once())
            ->method('getAlgorithmName')
            ->will($this->returnValue('foo'));

        $this->encryption->expects($this->once())
            ->method('verify')
            ->will($this->returnValue(true));

        $this->signer->expects($this->once())
            ->method('getUnsignedValue')
            ->will($this->returnValue('bar'));

        $this->token->expects($this->once())
            ->method('getSignature')
            ->will($this->returnValue('bar'));

        $verifier = new EncryptionVerifierStub($this->encryption, $this->encoder, $this->signer);
        $verifier->verify($this->token);
    }
}
