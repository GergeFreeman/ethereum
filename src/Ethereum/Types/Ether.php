<?php

namespace Ethereum\Types;

class Ether
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

    public function toWei()
    {
        return new Wei($this->amount * 1000000000000000000);
    }

    public function __toString()
    {
        return (string)$this->amount;
    }
}
