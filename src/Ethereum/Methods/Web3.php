<?php

namespace Ethereum\Methods;

class Web3 extends AbstractMethods
{
    public function clientVersion()
    {
        $response = $this->client->send(
            $this->client->request(67, 'web3_clientVersion', [])
        );

        return $response->getRpcResult();
    }

    public function sha3($stringToConvert)
    {
        $response = $this->client->send(
            $this->client->request(64, 'web3_sha3', [$stringToConvert])
        );

        return $response->getRpcResult();
    }
}
