<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/2/20
 * Time: 10:14 PM
 */

namespace App\Services\Binance;


class PublicService extends BinanceService
{
    public function ping() {
        return $this->httpClient->request(
            'GET',
            '/api/v3/ping'
        );
    }

    public function serverTime() {
        return $this->httpClient->request(
            'GET',
            '/api/v3/time'
        );
    }

}