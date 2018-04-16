<?php

namespace Ethereum\Methods;

use Ethereum\Types\Address;
use Ethereum\Types\Transaction;
use Ethereum\Types\TransactionHash;

class Personal extends AbstractMethods
{
    /**
     * @return Address[]
     */
    public function listAccounts()
    {
        $addresses = [];
        $response = $this->client->send(
            $this->client->request(67, 'personal_listAccounts', [])
        );
        if (!$response->getRpcResult()) {
            return $addresses;
        }
        foreach ($response->getRpcResult() as $address) {
            $addresses[] = new Address($address);
        }

        return $addresses;
    }

    public function newAccount($password)
    {
        $response = $this->client->send(
            $this->client->request(67, 'personal_newAccount', [$password])
        );

        return new Address($response->getRpcResult());
    }

    public function unlockAccount($address, $password, $duration)
    {
        $response = $this->client->send(
            $this->client->request(67, 'personal_unlockAccount', [(string) $address, $password, $duration])
        );
        $result = $response->getRpcResult();
        return empty($result) ? false : true;
    }

    public function sendTransaction($transaction, $password)
    {
        $response = $this->client->send(
            $this->client->request(1, 'personal_sendTransaction', [(array) $transaction, $password])
        );

        return new TransactionHash($response->getRpcResult());

    }
}
