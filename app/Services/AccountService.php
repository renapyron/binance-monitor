<?php
namespace App\Services;

class AccountService {

    private $httpClient;

    public function __construct() {
        $this->httpClient = app('HttpClient');
    }


    private function hmacSignature($queryString) {

        $data = 'recvWindow=5000&timestamp=' . time();
        if($queryString) {
           $data .= '&' . $queryString;
        }

        return hash_hmac('sha256', $data, env('BINANCE_SECRET'));
    }

    public function allBalances() {
        return $this->httpClient->request(
            'GET',
            '/api/v3/account',
            ['query' => ['signature' => $this->hmacSignature('')] ]
        );

    }





}
