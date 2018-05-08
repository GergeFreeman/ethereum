<?php

namespace Ethereum\Types;

/**
 * Class Transaction
 * @package Ethereum\Types
 */
class Transaction
{
    /**
     * @var Address
     */
    private $from;

    /**
     * @var Address
     */
    private $to;

    /**
     * @var null|string
     */
    private $data;

    /**
     * @var int|null
     */
    private $gas;

    /**
     * @var int|null
     */
    private $gasPrice;

    /**
     * @var int|null
     */
    private $value;

    /**
     * @var int|null
     */
    private $nonce;

    /**
     * Transaction constructor.
     * @param string $from
     * @param string $to
     * @param string|null $data
     * @param integer|null $gas
     * @param integer|null $gasPrice
     * @param integer|null $value
     * @param integer|null $nonce
     */
    public function __construct($from, $to, $data = null, $gas = null, $gasPrice = null, $value = null, $nonce = null)
    {
        $this->from = new Address($from);
        $this->to = new Address($to);
        $this->data = $data;
        $this->gas = $gas;
        $this->gasPrice = $gasPrice;
        $this->value = $value;
        $this->nonce = $nonce;
    }

    /**
     * @return array
     */
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
