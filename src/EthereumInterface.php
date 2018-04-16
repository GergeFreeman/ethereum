<?php

namespace Santran\Ethereum;

interface EthereumInterface
{

    /**
     * List of all wallet addresses.
     *
     * @return mixed
     */
    public function addresses();

    /**
     * Check a single address' balance.
     *
     * @param string $address
     * @param string $tag
     *
     * @return mixed
     */
    public function addressBalance($address, $tag = 'latest');

    /**
     * Generate a new address.
     *
     * @param string $passphrase
     *
     * @return mixed
     */
    public function newAddress($passphrase);

    /**
     * Lock address.
     *
     * @param string $address
     *
     * @return mixed
     */
    public function lockAddress($address);

    /**
     * Unlock address.
     *
     * @param string $address
     * @param string $passphrase
     * @param int    $duration
     *
     * @return mixed
     */
    public function unlockAddress($address, $passphrase, $duration = 300);

    /**
     * Send payment.
     *
     * @param string      $to_address
     * @param string|null $value
     * @param string      $from_address
     * @param string|null $gas
     * @param string|null $gasPrice
     * @param string|null $data
     *
     * @return mixed
     */
    public function send($to_address, $value, $from_address, $gas = null, $gasPrice = null, $data = null);
}
