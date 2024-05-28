<?php

namespace Rramacciani\Jwt\Claim;

use Rramacciani\Jwt\FactoryTrait;

/**
 * @method ClaimInterface get(string $name)
 */
class Factory
{
    use FactoryTrait;

    /**
     * @var string
     */
    private static $privateClaimClass = 'Rramacciani\Jwt\Claim\PrivateClaim';

    /**
     * @var array
     */
    private static $classMap = [
        Audience::NAME   => 'Rramacciani\Jwt\Claim\Audience',
        Expiration::NAME => 'Rramacciani\Jwt\Claim\Expiration',
        IssuedAt::NAME   => 'Rramacciani\Jwt\Claim\IssuedAt',
        Issuer::NAME     => 'Rramacciani\Jwt\Claim\Issuer',
        JwtId::NAME      => 'Rramacciani\Jwt\Claim\JwtId',
        NotBefore::NAME  => 'Rramacciani\Jwt\Claim\NotBefore',
        Subject::NAME    => 'Rramacciani\Jwt\Claim\Subject',
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
        return self::$privateClaimClass;
    }
}
