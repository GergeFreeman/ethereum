<?php

namespace Ethereum;

use Ethereum\Methods\Eth;
use Ethereum\Methods\Net;
use Ethereum\Methods\Personal;
use Ethereum\Methods\Shh;
use Ethereum\Methods\Web3;
use Graze\GuzzleHttp\JsonRpc\Client;

/**
 * Class EthereumClient
 * @package Ethereum
 */
class EthereumClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $methods = [];

    /**
     * EthereumClient constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->client = Client::factory($url);
        $this->methods = [
            'net' => new Net($this->client),
            'eth' => new Eth($this->client),
            'shh' => new Shh($this->client),
            'web3' => new Web3($this->client),
            'personal' => new Personal($this->client),
        ];
    }

    /**
     * @return Net
     */
    public function net()
    {
        return $this->methods['net'];
    }

    /**
     * @return Web3
     */
    public function web3()
    {
        return $this->methods['web3'];
    }

    /**
     * @return Shh
     */
    public function shh()
    {
        return $this->methods['shh'];
    }

    /**
     * @return Eth
     */
    public function eth()
    {
        return $this->methods['eth'];
    }

    /**
     * @return Personal
     */
    public function personal()
    {
        return $this->methods['personal'];
    }
}
