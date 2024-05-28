<?php

namespace Rramacciani\Jwt\HeaderParameter;

use Rramacciani\Jwt\FactoryTrait;

/**
 * @method ParameterInterface get(string $name)
 */
class Factory
{
    use FactoryTrait;

    /**
     * @var string
     */
    private static $customParameterClass = 'Rramacciani\Jwt\HeaderParameter\Custom';

    /**
     * @var array
     */
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
     * @return array
     */
    protected function getClassMap()
    {
        return self::$classMap;
    }

    /**
     * @return string
     */
    protected function getDefaultClass()
    {
        return self::$customParameterClass;
    }
}
