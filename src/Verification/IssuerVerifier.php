<?php

namespace Rramacciani\Jwt\Verification;

use Rramacciani\Jwt\Claim;
use Rramacciani\Jwt\Exception\InvalidIssuerException;
use Rramacciani\Jwt\Token;

class IssuerVerifier implements VerifierInterface
{
    /**
     * @var string
     */
    private $issuer;

    /**
     * @param string $issuer
     */
    public function __construct($issuer = null)
    {
        if (null !== $issuer && !is_string($issuer)) {
            throw new \InvalidArgumentException('Cannot verify invalid issuer value.');
        }

        $this->issuer = $issuer;
    }

    /**
     * @param Token $token
     * @throws InvalidIssuerException
     */
    public function verify(Token $token)
    {
        /** @var Claim\Issuer $issuerClaim */
        $issuerClaim = $token->getPayload()->findClaimByName(Claim\Issuer::NAME);

        $issuer = (null === $issuerClaim) ? null : $issuerClaim->getValue();

        if ($this->issuer !== $issuer) {
            throw new InvalidIssuerException;
        }
    }
}
