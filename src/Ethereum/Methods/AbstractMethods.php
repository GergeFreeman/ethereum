<?php

namespace Ethereum\Methods;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;

/**
 * Class AbstractMethods
 * @package Ethereum\Methods
 */
abstract class AbstractMethods
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * AbstractMethods constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
