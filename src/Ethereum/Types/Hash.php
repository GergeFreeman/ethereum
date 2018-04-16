<?php

namespace Ethereum\Types;

class Hash
{
    private $hash;

    public function __construct($hash)
    {
        if (strlen($hash) !== 66) {
            throw new \LengthException($hash.' is not valid hash.');
        }
        $this->hash = $hash;
    }

    public function __toString()
    {
        return $this->hash;
    }

    public function toString()
    {
        return $this->hash;
    }
}
