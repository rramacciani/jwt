<?php

namespace Rramacciani\Jwt\Claim;

class Subject extends AbstractClaim
{
    const NAME = 'sub';

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
} 
