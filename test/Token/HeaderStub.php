<?php

namespace Rramacciani\Jwt\Token;

class HeaderStub extends Header
{
    /**
     * @param PropertyList $propertyList
     */
    public function __construct(PropertyList $propertyList)
    {
        $this->propertyList = $propertyList;
    }
}
