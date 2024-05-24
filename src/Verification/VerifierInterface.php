<?php

namespace Rramacciani\Jwt\Verification;

use Emarref\Jwt\Token;

interface VerifierInterface
{
    /**
     * @param Token $token
     * @return void
     */
    public function verify(Token $token);
}
