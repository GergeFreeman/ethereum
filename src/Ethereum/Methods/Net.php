<?php

namespace Ethereum\Methods;

/**
 * Class Net
 * @package Ethereum\Methods
 */
class Net extends AbstractMethods
{
    /**
     * @return mixed
     */
    public function version()
    {
        $response = $this->client->send(
            $this->client->request(67, 'net_version', [])
        );

        return $response->getRpcResult();
    }

    /**
     * @return bool
     */
    public function listening()
    {
        $response = $this->client->send(
            $this->client->request(67, 'net_listening', [])
        );

        return (bool)$response->getRpcResult();
    }

    /**
     * @return number
     */
    public function peerCount()
    {
        $response = $this->client->send(
            $this->client->request(67, 'net_peerCount', [])
        );

        return hexdec($response->getRpcResult());
    }
}
