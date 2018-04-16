<?php

namespace Ethereum\Methods;

class Net extends AbstractMethods
{
    public function version()
    {
        $response = $this->client->send(
            $this->client->request(67, 'net_version', [])
        );

        return $response->getRpcResult();
    }

    public function listening()
    {
        $response = $this->client->send(
            $this->client->request(67, 'net_listening', [])
        );

        return (bool)$response->getRpcResult();
    }

    public function peerCount()
    {
        $response = $this->client->send(
            $this->client->request(67, 'net_peerCount', [])
        );

        return hexdec($response->getRpcResult());
    }
}
