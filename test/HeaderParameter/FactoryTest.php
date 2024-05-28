<?php

namespace Rramacciani\Jwt\HeaderParameter;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    private static $classMap = [
        Algorithm::NAME                       => 'Rramacciani\Jwt\HeaderParameter\Algorithm',
        ContentType::NAME                     => 'Rramacciani\Jwt\HeaderParameter\ContentType',
        Critical::NAME                        => 'Rramacciani\Jwt\HeaderParameter\Critical',
        JsonWebKey::NAME                      => 'Rramacciani\Jwt\HeaderParameter\JsonWebKey',
        JwkSetUrl::NAME                       => 'Rramacciani\Jwt\HeaderParameter\JwkSetUrl',
        KeyId::NAME                           => 'Rramacciani\Jwt\HeaderParameter\KeyId',
        Type::NAME                            => 'Rramacciani\Jwt\HeaderParameter\Type',
        X509CertificateChain::NAME            => 'Rramacciani\Jwt\HeaderParameter\X509CertificateChain',
        X509CertificateSha1Thumbprint::NAME   => 'Rramacciani\Jwt\HeaderParameter\X509CertificateSha1Thumbprint',
        X509CertificateSha256Thumbprint::NAME => 'Rramacciani\Jwt\HeaderParameter\X509CertificateSha256Thumbprint',
        X509Url::NAME                         => 'Rramacciani\Jwt\HeaderParameter\X509Url',
    ];

    /**
     * @var Factory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new Factory();
    }

    public function testGetAlgorithm()
    {
        $this->assertInstanceOf(self::$classMap[Algorithm::NAME], $this->factory->get(Algorithm::NAME));
    }

    public function testGetContentType()
    {
        $this->assertInstanceOf(self::$classMap[ContentType::NAME], $this->factory->get(ContentType::NAME));
    }

    public function testGetCritical()
    {
        $this->assertInstanceOf(self::$classMap[Critical::NAME], $this->factory->get(Critical::NAME));
    }

    public function testGetJsonWebKey()
    {
        $this->assertInstanceOf(self::$classMap[JsonWebKey::NAME], $this->factory->get(JsonWebKey::NAME));
    }

    public function testGetJwkSetUrl()
    {
        $this->assertInstanceOf(self::$classMap[JwkSetUrl::NAME], $this->factory->get(JwkSetUrl::NAME));
    }

    public function testGetKeyId()
    {
        $this->assertInstanceOf(self::$classMap[KeyId::NAME], $this->factory->get(KeyId::NAME));
    }

    public function testGetType()
    {
        $this->assertInstanceOf(self::$classMap[Type::NAME], $this->factory->get(Type::NAME));
    }

    public function testGetX509CertificateChain()
    {
        $this->assertInstanceOf(self::$classMap[X509CertificateChain::NAME], $this->factory->get(X509CertificateChain::NAME));
    }

    public function testGetX509CertificateSha1Thumbprint()
    {
        $this->assertInstanceOf(self::$classMap[X509CertificateSha1Thumbprint::NAME], $this->factory->get(X509CertificateSha1Thumbprint::NAME));
    }

    public function testGetX509CertificateSha256Thumbprint()
    {
        $this->assertInstanceOf(self::$classMap[X509CertificateSha256Thumbprint::NAME], $this->factory->get(X509CertificateSha256Thumbprint::NAME));
    }

    public function testGetX509Url()
    {
        $this->assertInstanceOf(self::$classMap[X509Url::NAME], $this->factory->get(X509Url::NAME));
    }

    public function testGetCustom()
    {
        $this->assertInstanceOf('Rramacciani\Jwt\HeaderParameter\Custom', $this->factory->get('foo'));
    }
}
