<?php

namespace Santran\Ethereum;

class EthereumManager
{

    /**
     * @var EthereumClient
     */
    public $ethereum;

    /**
     * EthereumManager constructor.
     */
    public function __construct()
    {
        $this->with();
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
     * @param EthereumInterface $ethereum
     * @return $this
     */
    public function withCustomClient(EthereumInterface $ethereum)
    {
        $this->ethereum = $ethereum;
        return $this;
    }

    /**
     * Create new client instance with given credentials.
     *
     * @param string $uri
     * @param string $port
     * @return $this
     */
    public function with(array $uri = null, $port = null)
    {
        $uri = $uri ? : config('ethereum.uri');
        $port = $port ? : config('ethereum.port');
        $this->ethereum = new EthereumClient($uri, $port);
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
        if (!method_exists($this->ethereum, $method)) {
            abort(500, "Method $method does not exist");
        }
        return call_user_func_array([$this->ethereum, $method], $parameters);
    }

}
