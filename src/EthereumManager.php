<?php

namespace Santran\Ethereum;

class EthereumManager
{

    /**
     * @var Client
     */
    public $client;

    /**
     * LivecoinManager constructor.
     */
    public function __construct()
    {
        
    }

    /**
     * Package version.
     *
     * @return string
     */
    public function version()
    {
        return '1.0';
    }

    /**
     * Load the custom Client interface.
     *
     * @param ClientContract $client
     * @return $this
     */
    public function withCustomClient(EthereumInterface $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Create new client instance with given credentials.
     *
     * @param array $auth
     * @param array $urls
     * @return $this
     */
    public function with(array $uri = null, $port = null)
    {
        $uri = $uri ? : config('ethereum.uri');
        $port = $port ? : config('ethereum.port');
        $this->client = new EthereumClient($uri, $port);
        return $this;
    }

    /**
     * Dynamically call methods on the client.
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (!method_exists($this->client, $method)) {
            abort(500, "Method $method does not exist");
        }
        return call_user_func_array([$this->client, $method], $parameters);
    }

}
