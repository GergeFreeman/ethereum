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

class Eth extends AbstractMethods
{
    public function protocolVersion()
    {
        $response = $this->client->send(
            $this->client->request(67, 'eth_protocolVersion', [])
        );

        return hexdec($response->getRpcResult());
    }

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

    public function coinbase()
    {
        $response = $this->client->send(
            $this->client->request(64, 'eth_coinbase', [])
        );

        return ($response->getRpcResult()) ? new Address($response->getRpcResult()) : null;
    }

    public function mining()
    {
        $response = $this->client->send(
            $this->client->request(71, 'eth_mining', [])
        );

        return (bool)$response->getRpcResult();

    }

    public function hashRate()
    {
        $response = $this->client->send(
            $this->client->request(71, 'eth_hashrate', [])
        );

        return hexdec($response->getRpcResult());
    }

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

    public function blockNumber()
    {
        $response = $this->client->send(
            $this->client->request(83, 'eth_blockNumber', [])
        );

        return hexdec($response->getRpcResult());
    }

    public function getBalance($address, $blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getBalance', [(string) $address, (string) $blockNumber])
        );

        return new Wei(hexdec($response->getRpcResult()));

    }

    public function getStorageAt($address, $quantity, $blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getStorageAt', [(string) $address, $quantity, (string) $blockNumber])
        );

        return $response->getRpcResult();
    }

    public function getTransactionCount($address, $blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_blockNumber', [(string) $address, (string) $blockNumber])
        );

        return hexdec($response->getRpcResult());
    }

    public function getBlockTransactionCountByHash($hash)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getBlockTransactionCountByHash', [(string) $hash])
        );

        return hexdec($response->getRpcResult());

    }

    public function getBlockTransactionCountByNumber($blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getBlockTransactionCountByNumber', [(string) $blockNumber])
        );

        return hexdec($response->getRpcResult());

    }

    public function getUncleCountByBlockHash($hash)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getUncleCountByBlockHash', [(string) $hash])
        );

        return hexdec($response->getRpcResult());

    }

    public function getUncleCountByBlockNumber($blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getUncleCountByBlockNumber', [(string) $blockNumber])
        );

        return hexdec($response->getRpcResult());

    }

    public function getCode($address, $blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getCode', [(string) $address, (string) $blockNumber])
        );

        return $response->getRpcResult();
    }

    // the address to sign with must be unlocked
    public function sign($address, $msgToSign)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_sign', [(string) $address, $msgToSign])
        );

        return $response->getRpcResult();
    }

    public function sendTransaction($transaction)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_sendTransaction', [$transaction->toArray()])
        );

        return new TransactionHash($response->getRpcResult());

    }

    public function sendRawTransaction($data)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_sendRawTransaction', [$data])
        );

        return $response->getRpcResult();

    }

    public function call($transaction, $blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_call', [(array) $transaction, (string) $blockNumber])
        );

        return $response->getRpcResult();
    }

    public function estimateGas($transaction, $blockNumber)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_estimateGas', [(array) $transaction, (string) $blockNumber])
        );

        return hexdec($response->getRpcResult());

    }

    public function getBlockByHash($hash, $expandTransactions = false)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getBlockByHash', [(string) $hash, $expandTransactions])
        );

        return ($response->getRpcResult()) ? new Block($response->getRpcResult()) : null;

    }

    public function getBlockByNumber($blockNumber, $expandTransactions = false)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getBlockByNumber', [(string) $blockNumber, $expandTransactions])
        );

        return ($response->getRpcResult()) ? new Block($response->getRpcResult()) : null;

    }

    public function getTransactionByHash($hash)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getTransactionByHash', [(string) $hash])
        );

        return ($response->getRpcResult()) ? new TransactionInfo($response->getRpcResult()) : null;
    }

    public function getTransactionByBlockHashAndIndex($hash, $index)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getTransactionByBlockHashAndIndex', [(string) $hash, '0x'.dechex($index)])
        );

        return ($response->getRpcResult()) ? new TransactionInfo($response->getRpcResult()) : null;
    }

    public function getTransactionByBlockNumberAndIndex($blockNumber, $index)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getTransactionByBlockNumberAndIndex',
                [$blockNumber->toString(), '0x'.dechex($index)])
        );

        return ($response->getRpcResult()) ? new TransactionInfo($response->getRpcResult()) : null;

    }

    public function getTransactionReceipt($hash)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getTransactionReceipt', [(string) $hash])
        );

        return ($response->getRpcResult()) ? new TransactionReceipt($response->getRpcResult()) : null;

    }

    public function getUncleByBlockHashAndIndex($hash, $index)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getUncleByBlockHashAndIndex', [(string) $hash, $index])
        );

        return ($response->getRpcResult()) ? new Block($response->getRpcResult()) : null;

    }

    public function getUncleByBlockNumberAndIndex($blockNumber, $index)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getUncleByBlockNumberAndIndex', [(string) $blockNumber, $index])
        );

        return ($response->getRpcResult()) ? new Block($response->getRpcResult()) : null;

    }

    public function getCompilers()
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_getCompilers', [])
        );

        return ($response->getRpcResult()) ? $response->getRpcResult() : [];

    }

    public function compileSolidity($code)
    {
        $response = $this->client->send(
            $this->client->request(1, 'eth_compileSolidity', [$code])
        );

        return ($response->getRpcResult()) ? $response->getRpcResult() : [];
    }

    // TODO: missing filter methods
}
