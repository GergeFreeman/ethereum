<?php

namespace Ethereum\Types;

/**
 * Class Ether
 * @package Ethereum\Types
 */
class Ether
{
    /**
     * @var double
     */
    private $amount;

    /**
     * Ether constructor.
     * @param $amount
     */
    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return double
     */
    public function amount()
    {
        return $this->amount;
    }

    /**
     * @return Wei
     */
    public function toWei()
    {
        return new Wei(bcmul($this->amount, 1000000000000000000));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->amount;
    }
}
