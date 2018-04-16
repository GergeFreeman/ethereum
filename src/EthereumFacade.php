<?php

namespace Santran\Ethereum;

use Illuminate\Support\Facades\Facade;

class EthereumFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'ethereum';
    }

}
