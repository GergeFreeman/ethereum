<?php

namespace Ethereum\Types;

/**
 * Class Block
 * @package Ethereum\Types
 */
class Block
{
    private $difficulty;
    private $extraData;
    private $gasLimit;
    private $gasUsed;
    private $hash;
    private $logsBloom;
    private $miner;
    private $mixHash;
    private $nonce;
    private $number;
    private $parentHash;
    private $receiptsRoot;
    private $sha3Uncles;
    private $size;
    private $stateRoot;
    private $timestamp;
    private $totalDifficulty;
    private $transactionsRoot;
    private $transactions;
    private $uncles;

    /**
     * Block constructor.
     * @param $response array
     */
    public function __construct($response)
    {
        $this->difficulty = hexdec($response['difficulty']);
        $this->extraData = $response['extraData'];
        $this->gasLimit = hexdec($response['gasLimit']);
        $this->gasUsed = new Wei(hexdec($response['gasUsed']));
        $this->hash = new BlockHash($response['hash']);
        $this->logsBloom = $response['logsBloom'];
        $this->miner = new Address($response['miner']);
        $this->mixHash = new Hash($response['mixHash']);
        $this->nonce = $response['nonce'];
        $this->number = hexdec($response['number']);
        $this->parentHash = new BlockHash($response['parentHash']);
        $this->receiptsRoot = new Hash($response['receiptsRoot']);
        $this->sha3Uncles = new Hash($response['sha3Uncles']);
        $this->size = hexdec($response['size']);
        $this->stateRoot = new Hash($response['stateRoot']);
        $this->timestamp = hexdec($response['timestamp']);
        $this->totalDifficulty = hexdec($response['totalDifficulty']);
        $this->transactionsRoot = new TransactionHash($response['transactionsRoot']);
        $this->transactions = [];
        foreach ($response['transactions'] as $transaction) {
            $this->transactions[] = new TransactionHash($transaction);
        }
        $this->uncles = [];
        foreach ($response['uncles'] as $uncle) {
            $this->uncles[] = new BlockHash($uncle);
        }
    }

    public function difficulty()
    {
        return $this->difficulty;
    }

    public function extraData()
    {
        return $this->extraData;
    }

    public function gasLimit()
    {
        return $this->gasLimit;
    }

    public function gasUsed()
    {
        return $this->gasUsed;
    }

    public function hash()
    {
        return $this->hash;
    }

    public function logsBloom()
    {
        return $this->logsBloom;
    }

    public function miner()
    {
        return $this->miner;
    }

    public function mixHash()
    {
        return $this->mixHash;
    }

    public function nonce()
    {
        return $this->nonce;
    }

    public function number()
    {
        return $this->number;
    }

    public function parentHash()
    {
        return $this->parentHash;
    }

    public function receiptsRoot()
    {
        return $this->receiptsRoot;
    }

    public function sha3Uncles()
    {
        return $this->sha3Uncles;
    }

    public function size()
    {
        return $this->size;
    }

    public function stateRoot()
    {
        return $this->stateRoot;
    }

    public function timestamp()
    {
        return $this->timestamp;
    }

    public function totalDifficulty()
    {
        return $this->totalDifficulty;
    }

    public function transactionsRoot()
    {
        return $this->transactionsRoot;
    }

    public function transactions()
    {
        return $this->transactions;
    }

    public function uncles()
    {
        return $this->uncles;
    }
}
