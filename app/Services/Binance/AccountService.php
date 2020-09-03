<?php
namespace App\Services\Binance;

class AccountService extends BinanceService {

    public function allBalances() {
        $response = $this->httpClient->request(
            'GET',
            '/api/v3/account',
            ['query' => $this->signedQuery() ]
        );

        $result = json_decode($response->getBody(), true);

        // find all assets with free + locked amounts > 0
        $filtered = array_filter(
            $result['balances'],
            function($balance) {
                return (float)$balance['free'] > 0 || (float)$balance['locked'] > 0;
            }
        );


        $final = [];
        foreach($filtered AS $asset) {
            $final[] = [
                'asset' => $asset['asset'],
                'balance' => (float)$asset['free'] + (float)$asset['locked']
            ];
        }

        return $final;
    }
}
