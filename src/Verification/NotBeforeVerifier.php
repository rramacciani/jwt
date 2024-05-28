<?php

namespace Rramacciani\Jwt\Verification;

use Rramacciani\Jwt\Claim;
use Rramacciani\Jwt\Exception\TooEarlyException;
use Rramacciani\Jwt\Token;

class NotBeforeVerifier implements VerifierInterface
{
    public function verify(Token $token)
    {
        /** @var Claim\NotBefore $notBeforeClaim */
        $notBeforeClaim = $token->getPayload()->findClaimByName(Claim\NotBefore::NAME);

        if (null === $notBeforeClaim) {
            return null;
        }

        $now = new \DateTime('now', new \DateTimeZone('UTC'));

        if (!is_long($notBeforeClaim->getValue())) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid not before timestamp "%s"',
                $notBeforeClaim->getValue()
            ));
        }

        if ($now->getTimestamp() < $notBeforeClaim->getValue()) {
            $notBefore = new \DateTime();
            $notBefore->setTimestamp($notBeforeClaim->getValue());
            throw new TooEarlyException($notBefore);
        }
    }
}
