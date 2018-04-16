<?php

namespace Santran\Ethereum;

use GuzzleHttp\Client;

class EthereumRPC
{

    private function getJson($method, $params)
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
