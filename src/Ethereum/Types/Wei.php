<?php

namespace Ethereum\Types;

/**
 * Class Wei
 * @package Ethereum\Types
 */
class Wei
{
    /**
     * @var integer
     */
    private $amount;

    /**
     * Wei constructor.
     * @param $amount integer
     */
    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function amount()
    {
        return $this->amount;
    }

    /**
     * @return double|int
     */
    public function toEther()
    {
        return $this->amount / 1000000000000000000;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->amount;
    }
}
