<?php

namespace Santran\Ethereum;

use Graze\GuzzleHttp\JsonRpc\Client as RpcClient;

class EthereumRPC
{

    /**
     * @var string
     */
    private $uri;

    /**
     *
     * @var Client 
     */
    private $client;

    public function __construct($uri)
    {
        $this->uri = $uri;
        $this->client = RpcClient::factory($this->uri, [
                    'debug' => false,
        ]);
    }

    public function getJson($method, $params)
    {
        return $this->client->send($this->client->request(0, $method, $params))->getRpcResult();
    }

}
