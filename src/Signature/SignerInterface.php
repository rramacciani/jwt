<?php

namespace Rramacciani\Jwt\Signature;

use Rramacciani\Jwt\Token;

interface SignerInterface
{
    /**
     * @param Token $token
     */
    public function sign(Token $token);

    /**
     * @param Token $token
     * @return string
     */
    public function getUnsignedValue(Token $token);
}
