<?php

namespace Rramacciani\Jwt\Exception;

class InvalidSignatureException extends VerificationException
{
    public function __construct($message = 'Signature is invalid.', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
