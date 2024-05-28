<?php

namespace Rramacciani\Jwt\Token;

class PropertyListStub extends PropertyList
{
    /**
     * @param \ArrayObject $properties
     */
    public function __construct(\ArrayObject $properties)
    {
        $this->properties = $properties;
    }
}
