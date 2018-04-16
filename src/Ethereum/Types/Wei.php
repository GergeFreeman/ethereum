<?php

namespace Ethereum\Types;

class Wei
{
    private $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function amount()
    {
        return $this->amount;
    }

    public function toEther()
    {
        return $this->amount / 1000000000000000000;
    }

    public function __toString()
    {
        return (string)$this->amount;
    }
}
