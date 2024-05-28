<?php

namespace Rramacciani\Jwt\Verification;

use Rramacciani\Jwt\Claim;
use Rramacciani\Jwt\Exception\InvalidAudienceException;
use Rramacciani\Jwt\Token;

class AudienceVerifier implements VerifierInterface
{
    /**
     * @var string
     */
    private $audience;

    /**
     * @param string $audience
     */
    public function __construct($audience = null)
    {
        if (null !== $audience && !is_string($audience)) {
            throw new \InvalidArgumentException('Cannot verify invalid audience value.');
        }

        $this->audience = $audience;
    }

    /**
     * @param Token $token
     * @throws InvalidAudienceException
     */
    public function verify(Token $token)
    {
        /** @var Claim\Audience $audienceClaim */
        $audienceClaim = $token->getPayload()->findClaimByName(Claim\Audience::NAME);

        $audience = (null === $audienceClaim) ? null : $audienceClaim->getValue();

        if (!is_array($audience)) {
            $audience = [$audience];
        }

        if (!in_array($this->audience, $audience, true)) {
            throw new InvalidAudienceException;
        }
    }
}
