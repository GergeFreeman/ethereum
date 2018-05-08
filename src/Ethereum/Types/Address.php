<?php

namespace Ethereum\Types;

/**
 * Class Address
 * @package Ethereum\Types
 */
class Address
{
    /**
     * @var string
     */
    private $address;

    /**
     * Address constructor.
     * @param $address
     */
    public function __construct($address)
    {
        if (!is_string($address) || strlen($address) !== 42) {
            throw new \LengthException($address . ' is not valid address.');
        }
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->address;
    }
}
