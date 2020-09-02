<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;

class AccountService {

    private $httpClient;

    public function __construct() {
        $this->httpClient = app('HttpClient');
    }


    /**
     * For secure endpoints Binance require's SHA256 signature using the binance API secret key and
     * query string OR request body parameters as data
     * @param array $queryFilters
     * @return array
     */
    private function signedQuery($queryFilters = []) {
        $timestampMs = round(microtime(true) * 1000);
        // always required parameters: recvWindow & timestamp
        $query = $queryFilters + ['recvWindow' => '5000', 'timestamp' => $timestampMs];
        $signature = hash_hmac('sha256', http_build_query($query), env('BINANCE_SECRET'));

        $query['signature'] = $signature;
        Log::info('query[]: ' . var_export($query, true));
        return $query;
    }



    public function allBalances() {
        return $this->httpClient->request(
            'GET',
            '/api/v3/account',
            ['query' => $this->signedQuery() ]
        );
    }

    public function ping() {
        return $this->httpClient->request(
            'GET',
            '/api/v3/time'
        );
    }





}
