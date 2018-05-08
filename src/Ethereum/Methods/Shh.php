<?php

namespace Ethereum\Methods;

/**
 * Class Shh
 * @package Ethereum\Methods
 */
class Shh extends AbstractMethods
{
    /**
     * @return mixed
     */
    public function version()
    {
        $response = $this->client->send(
            $this->client->request(67, 'shh_version', [])
        );

        return $response->getRpcResult();
    }

    // TODO: missing methods
}
