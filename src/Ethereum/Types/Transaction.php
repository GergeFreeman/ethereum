<?php

namespace Ethereum\Types;

class Transaction
{

    private $from;
    private $to;
    private $data;
    private $gas;
    private $gasPrice;
    private $value;
    private $nonce;

    public function __construct(
    $from, $to, $data = null, $gas = null, $gasPrice = null, $value = null, $nonce = null
    )
    {
        $this->from = new Address($from);
        $this->to = new Address($to);
        $this->data = $data;
        $this->gas = $gas;
        $this->gasPrice = $gasPrice;
        $this->value = $value;
        $this->nonce = $nonce;
    }

    public function toArray()
    {
        $transaction = [
            'from' => $this->from->toString(),
            'to' => $this->to->toString(),
        ];

        if (!is_null($this->data)) {
            $transaction['data'] = '0x' . dechex($this->data);
        }

        if (!is_null($this->gas)) {
            $transaction['gas'] = '0x' . dechex($this->gas);
        }

        if (!is_null($this->gasPrice)) {
            $transaction['gasPrice'] = '0x' . dechex((new Wei($this->gasPrice))->amount());
        }

        if (!is_null($this->value)) {
            $transaction['value'] = '0x' . dechex($this->value);
        }

        if (!is_null($this->nonce)) {
            $transaction['nonce'] = '0x' . dechex($this->nonce);
        }

        return $transaction;
    }

}
