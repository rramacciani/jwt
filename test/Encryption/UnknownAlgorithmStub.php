<?php

namespace Rramacciani\Jwt\Encryption;

use Emarref\Jwt\Algorithm\AlgorithmInterface;

class UnknownAlgorithmStub implements AlgorithmInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        // Noop
    }
}
