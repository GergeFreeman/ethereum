# Ethereum RPC API
A php interface for interacting with the Ethereum blockchain and ecosystem.

### Installation

`composer require santran/ethereum:dev-master`.

Add the service provider to your `config/app.php`:
 
```php  
 'providers' => [
    Santran\Ethereum\EthereumServiceProvider::class,
 ],
```
 
...run `php artisan vendor:publish` to copy the config file.

Edit the `config/ethereum.php`

```
'uri' => env('ETHEREUM_URI', 'http://localhost'),
'port' => env('ETHEREUM_PORT', 8545),

```

Add the alias to your `config/app.php`:

```php 
'aliases' => [
    'Ethereum' => Santran\Ethereum\EthereumFacade::class,
],
```

### Example

```php

use Santran\Ethereum\EthereumClient;

$addresses = EthereumClient::addresses();
    
dd($addresses);
```


Donate:

BTC : 1BkEUyWCd1TKbYvzFqiuQbQLmxtGs9jYas
ETH : 0xDc5699adFbF7932020D02fF6BddA03b28C4bD3EF
