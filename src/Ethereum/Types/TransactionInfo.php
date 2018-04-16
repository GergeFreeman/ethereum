<?php

namespace Ethereum\Types;

class TransactionInfo
{
    private $blockHash;
    private $blockNumber;
    private $from;
    private $to;
    private $gas;
    private $gasPrice;
    private $hash;
    private $input;
    private $nonce;
    private $transactionIndex;
    private $value;
    private $v;
    private $r;
    private $s;

    public function __construct($response)
    {
        $this->blockHash = new BlockHash($response['blockHash']);
        $this->blockNumber = hexdec($response['blockNumber']);
        $this->from = new Address($response['from']);
        if ($response['to']) {
            $this->to = new Address($response['to']);
        }
        $this->gas = hexdec($response['gas']);
        $this->gasPrice = new Wei(hexdec($response['gasPrice']));
        $this->hash = new TransactionHash($response['hash']);
        $this->input = $response['input'];
        $this->nonce = hexdec($response['nonce']);
        $this->transactionIndex = hexdec($response['transactionIndex']);
        $this->value = new Wei(hexdec($response['value']));
        $this->v = $response['v'];
        $this->r = $response['r'];
        $this->s = $response['s'];
    }

    public function blockHash()
    {
        return $this->blockHash;
    }

    public function blockNumber()
    {
        return $this->blockNumber;
    }

    public function from()
    {
        return $this->from;
    }

    public function to()
    {
        return $this->to;
    }

    public function gas()
    {
        return $this->gas;
    }

    public function gasPrice()
    {
        return $this->gasPrice;
    }

    public function hash()
    {
        return $this->hash;
    }

    public function input()
    {
        return $this->input;
    }

    public function nonce()
    {
        return $this->nonce;
    }

    public function transactionIndex()
    {
        return $this->transactionIndex;
    }

    public function value()
    {
        return $this->value;
    }

    public function v()
    {
        return $this->v;
    }

    public function r()
    {
        return $this->r;
    }

    public function s()
    {
        return $this->s;
    }
}
