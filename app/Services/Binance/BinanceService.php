<?php
namespace App\Services\Binance;


abstract class BinanceService
{
    protected $httpClient;

    public function __construct() {
        $this->httpClient = app('HttpClient');
    }


    /**
     * For secure endpoints Binance require's SHA256 signature using the binance API secret key and
     * query string OR request body parameters as data
     * @param array $queryFilters
     * @return array
     */
    protected function signedQuery($queryFilters = []) {
        $timestampMs = round(microtime(true) * 1000);
        // always required parameters: recvWindow & timestamp
        $query = $queryFilters + ['recvWindow' => '5000', 'timestamp' => $timestampMs];
        $signature = hash_hmac('sha256', http_build_query($query), env('BINANCE_SECRET'));

        $query['signature'] = $signature;
        return $query;
    }


}