<?php

namespace Ethereum\Methods;

class Shh extends AbstractMethods
{
    public function version()
    {
        $response = $this->client->send(
            $this->client->request(67, 'shh_version', [])
        );

        return $response->getRpcResult();
    }

    // TODO: missing methods
}
