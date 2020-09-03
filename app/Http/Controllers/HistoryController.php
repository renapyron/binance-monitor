<?php

namespace App\Http\Controllers;
use App\Models\Endpoint;
use App\Services\Binance\TradesService;
use App\Services\DB\AssetStatsService;
use App\Services\DB\EndpointService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use App\Services\Binance\AccountService;

class HistoryController extends Controller
{

    private $accountService;
    private $endpointService;
    private $tradesService;
    private $assetStatsService;
    private $myTradesEndpoint;

    public function __construct(
        AccountService $accountService,
        EndpointService $endpointService,
        TradesService $tradeService,
        AssetStatsService $assetStatsService
    ) {
        $this->accountService = $accountService;
        $this->endpointService = $endpointService;
        $this->tradesService = $tradeService;
        $this->assetStatsService = $assetStatsService;

        $this->myTradesEndpoint = new Endpoint('/api/v3/myTrades', 'GET');
    }

    public function assetStats(Request $req) {
        // if db data not yet stale, fetch from the db
        if (!$this->endpointService->isStale($this->myTradesEndpoint)) {
           return $this->assetStatsService->get($req->query('asset'), $req->query('assetSold'));
        }

        $stats = $this->updateAssetPairStats($req->query('asset'), $req->query('assetSold'));

        return $stats;
    }

    private function updateAssetPairStats($asset, $assetSold) {

        $averages = $this->tradesService->averageTradeValues($asset, $assetSold);
        $this->assetStatsService->update($asset, $assetSold, $averages);
        $this->endpointService->upsertLastCall($this->myTradesEndpoint);

        return $averages;
    }



}