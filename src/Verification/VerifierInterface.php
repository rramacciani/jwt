<?php

namespace Rramacciani\Jwt\Verification;

use Rramacciani\Jwt\Token;

interface VerifierInterface
{
    /**
     * @param Token $token
     * @return void
     */
    public function verify(Token $token);
}
