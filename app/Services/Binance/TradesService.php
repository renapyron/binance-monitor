<?php
namespace App\Services\Binance;

use Illuminate\Support\Facades\Log;

class TradesService extends BinanceService {

    public function assetTrades($assetBought, $assetUsed) {
        $symbol = $assetBought . $assetUsed;
        $response = $this->httpClient->request(
            'GET',
            '/api/v3/myTrades',
            ['query' => $this->signedQuery(['symbol' => $symbol]) ]
        );

        $result = json_decode($response->getBody(), true);

        Log::info('/myTrades' . var_export($result, true));

        return $result;
    }

    public function averageTradeValues($assetBought, $assetSold) {

        $tradeData = $this->assetTrades($assetBought, $assetSold);

        $buyQuotQtyTotal = 0;
        $buyQuantityTotal = 0;
        $sellQuotQtyTotal = 0;
        $sellQuantityTotal = 0;
        foreach($tradeData AS $dat) {

            if ($dat['isBuyer']) {
                $buyQuotQtyTotal += (float)$dat['quoteQty'];
                $buyQuantityTotal += (float)$dat['qty'];
            } else {
                $sellQuotQtyTotal += (float)$dat['quoteQty'];
                $sellQuantityTotal += (float)$dat['qty'];
            }
        }


        return [
            'average_buy' => ($buyQuantityTotal > 0) ? round($buyQuotQtyTotal / $buyQuantityTotal, 6) : 0,
            'average_sell' => ($sellQuantityTotal > 0) ? round($sellQuotQtyTotal / $sellQuantityTotal, 6) : 0
        ];
    }

}
