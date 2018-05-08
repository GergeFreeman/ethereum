<?php

namespace Ethereum\Methods;

use Ethereum\Types\Address;
use Ethereum\Types\Block;
use Ethereum\Types\BlockHash;
use Ethereum\Types\BlockNumber;
use Ethereum\Types\Transaction;
use Ethereum\Types\TransactionHash;
use Ethereum\Types\TransactionInfo;
use Ethereum\Types\TransactionReceipt;
use Ethereum\Types\Wei;

/**
 * Class Eth
 * @package Ethereum\Methods
 */
class Eth extends AbstractMethods
{
    /**
     * @return number
     */
    public function protocolVersion()
    {
        $response = $this->client->send(
            $this->client->request(67, 'eth_protocolVersion', [])
        );

        return hexdec($response->getRpcResult());
    }

    /**
     * @return mixed
     */
    public function syncing()
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_syncing', [])
        );

        $result = $response->getRpcResult();
        if ($result === false) {
            return $result;
        }

        return $result; // TODO: test this
    }

    /**
     * @return Address|null
     */
    public function coinbase()
    {
        $response = $this->client->send(
            $this->client->request(64, 'eth_coinbase', [])
        );

        return ($response->getRpcResult()) ? new Address($response->getRpcResult()) : null;
    }

    /**
     * @return bool
     */
    public function mining()
    {
        $response = $this->client->send(
            $this->client->request(71, 'eth_mining', [])
        );

        return (bool)$response->getRpcResult();

    }

    /**
     * @return number
     */
    public function hashRate()
    {
        $response = $this->client->send(
            $this->client->request(71, 'eth_hashrate', [])
        );

        return hexdec($response->getRpcResult());
    }

    /**
     * @return Wei
     */
    public function gasPrice()
    {
        $response = $this->client->send(
            $this->client->request(73, 'eth_gasPrice', [])
        );

        return new Wei(hexdec($response->getRpcResult()));
    }

    /**
     * @return Address[]
     */
    public function accounts()
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_accounts', [])
        );
        $addresses = [];
        foreach ($response->getRpcResult() as $address) {
            $addresses[] = new Address($address);
        }

        return $addresses;

    }

    /**
     * @return number
     */
    public function blockNumber()
    {
        $response = $this->client->send(
            $this->client->request(83, 'eth_blockNumber', [])
        );

        return hexdec($response->getRpcResult());
    }

    /**
     * @param string $address
     * @param $blockNumber
     * @return Wei
     */
    public function getBalance($address, $blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getBalance', [(string)$address, (string)$blockNumber])
        );

        return new Wei(hexdec($response->getRpcResult()));
    }

    /**
     * @param string $address
     * @param $quantity
     * @param $blockNumber
     * @return mixed
     */
    public function getStorageAt($address, $quantity, $blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getStorageAt', [(string)$address, $quantity, (string)$blockNumber])
        );

        return $response->getRpcResult();
    }

    /**
     * @param string $address
     * @param int|string $blockNumber
     * @return number
     */
    public function getTransactionCount($address, $blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getTransactionCount', [(string)$address, (string)$blockNumber])
        );

        return hexdec($response->getRpcResult());
    }

    /**
     * @param $hash
     * @return number
     */
    public function getBlockTransactionCountByHash($hash)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getBlockTransactionCountByHash', [(string)$hash])
        );

        return hexdec($response->getRpcResult());

    }

    /**
     * @param $blockNumber
     * @return number
     */
    public function getBlockTransactionCountByNumber($blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getBlockTransactionCountByNumber', [(string)$blockNumber])
        );

        return hexdec($response->getRpcResult());

    }

    /**
     * @param $hash
     * @return number
     */
    public function getUncleCountByBlockHash($hash)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getUncleCountByBlockHash', [(string)$hash])
        );

        return hexdec($response->getRpcResult());

    }

    /**
     * @param $blockNumber
     * @return number
     */
    public function getUncleCountByBlockNumber($blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getUncleCountByBlockNumber', [(string)$blockNumber])
        );

        return hexdec($response->getRpcResult());

    }

    /**
     * @param $address
     * @param $blockNumber
     * @return mixed
     */
    public function getCode($address, $blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getCode', [(string)$address, (string)$blockNumber])
        );

        return $response->getRpcResult();
    }

    /**
     * The address to sign with must be unlocked
     * @param $address
     * @param $msgToSign
     * @return mixed
     */
    public function sign($address, $msgToSign)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_sign', [(string)$address, $msgToSign])
        );

        return $response->getRpcResult();
    }

    /**
     * @param $transaction
     * @return TransactionHash
     */
    public function sendTransaction($transaction)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_sendTransaction', [$transaction->toArray()])
        );

        return new TransactionHash($response->getRpcResult());
    }

    /**
     * @param $data
     * @return mixed
     */
    public function sendRawTransaction($data)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_sendRawTransaction', [$data])
        );

        return $response->getRpcResult();

    }

    /**
     * @param $transaction
     * @param $blockNumber
     * @return mixed
     */
    public function call($transaction, $blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_call', [(array)$transaction, (string)$blockNumber])
        );

        return $response->getRpcResult();
    }

    /**
     * @param $transaction
     * @param $blockNumber
     * @return number
     */
    public function estimateGas($transaction, $blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_estimateGas', [(array)$transaction, (string)$blockNumber])
        );

        return hexdec($response->getRpcResult());
    }

    /**
     * @param $hash
     * @param bool $expandTransactions
     * @return Block|null
     */
    public function getBlockByHash($hash, $expandTransactions = false)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getBlockByHash', [(string)$hash, $expandTransactions])
        );

        return ($response->getRpcResult()) ? new Block($response->getRpcResult()) : null;
    }

    /**
     * @param $blockNumber
     * @param bool $expandTransactions
     * @return Block|null
     */
    public function getBlockByNumber($blockNumber, $expandTransactions = false)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getBlockByNumber', [(string)$blockNumber, $expandTransactions])
        );

        return ($response->getRpcResult()) ? new Block($response->getRpcResult()) : null;
    }

    /**
     * @param $hash
     * @return TransactionInfo|null
     */
    public function getTransactionByHash($hash)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getTransactionByHash', [(string)$hash])
        );

        return ($response->getRpcResult()) ? new TransactionInfo($response->getRpcResult()) : null;
    }

    /**
     * @param $hash
     * @param $index
     * @return TransactionInfo|null
     */
    public function getTransactionByBlockHashAndIndex($hash, $index)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getTransactionByBlockHashAndIndex', [(string)$hash, '0x' . dechex($index)])
        );

        return ($response->getRpcResult()) ? new TransactionInfo($response->getRpcResult()) : null;
    }

    /**
     * @param $blockNumber
     * @param $index
     * @return TransactionInfo|null
     */
    public function getTransactionByBlockNumberAndIndex($blockNumber, $index)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getTransactionByBlockNumberAndIndex',
                [$blockNumber->toString(), '0x' . dechex($index)])
        );

        return ($response->getRpcResult()) ? new TransactionInfo($response->getRpcResult()) : null;

    }

    /**
     * @param $hash
     * @return TransactionReceipt|null
     */
    public function getTransactionReceipt($hash)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getTransactionReceipt', [(string)$hash])
        );

        return ($response->getRpcResult()) ? new TransactionReceipt($response->getRpcResult()) : null;
    }

    /**
     * @param $hash
     * @param $index
     * @return Block|null
     */
    public function getUncleByBlockHashAndIndex($hash, $index)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getUncleByBlockHashAndIndex', [(string)$hash, $index])
        );

        return ($response->getRpcResult()) ? new Block($response->getRpcResult()) : null;
    }

    /**
     * @param $blockNumber
     * @param $index
     * @return Block|null
     */
    public function getUncleByBlockNumberAndIndex($blockNumber, $index)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getUncleByBlockNumberAndIndex', [(string)$blockNumber, $index])
        );

        return ($response->getRpcResult()) ? new Block($response->getRpcResult()) : null;
    }

    /**
     * @return array|mixed
     */
    public function getCompilers()
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getCompilers', [])
        );

        return ($response->getRpcResult()) ? $response->getRpcResult() : [];
    }

    /**
     * @param $code
     * @return array|mixed
     */
    public function compileSolidity($code)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_compileSolidity', [$code])
        );

        return ($response->getRpcResult()) ? $response->getRpcResult() : [];
    }

    // TODO: missing filter methods
}
