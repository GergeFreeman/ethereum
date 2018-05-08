<?php

namespace Ethereum\Types;

/**
 * Class Hash
 * @package Ethereum\Types
 */
class Hash
{
    /**
     * @var string
     */
    private $hash;

    /**
     * Hash constructor.
     * @param $hash
     */
    public function __construct($hash)
    {
        if (!is_string($hash) || strlen($hash) !== 66) {
            throw new \LengthException($hash . ' is not valid hash.');
        }
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->hash;
    }
}
