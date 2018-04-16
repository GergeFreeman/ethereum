<?php

namespace Santran\Ethereum;

use Graze\GuzzleHttp\JsonRpc\Client as RpcClient;

class EthereumRPC
{

    /**
     * @var string
     */
    private $uri;

    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    public function getJson($method, $params)
    {
        $client = new Client([
            'base_uri' => $this->uri,
        ]);

        $data = $client->post(
                '', [
            'jsonrpc' => 2.0,
            'method' => $method,
            'params' => $params
                ]
        );

        return \GuzzleHttp\json_decode(
                $data->getBody()
                        ->getContents()
        );
    }

}
