<?php

namespace App\Http\Controllers;
use App\Models\Endpoint;
use App\Services\DB\BalanceService;
use App\Services\DB\EndpointService;
use Laravel\Lumen\Routing\Controller;
use App\Services\Binance\AccountService;

class BalancesController extends Controller
{

    private $accountService;
    private $endpointService;
    private $balanceService;
    private $accountEndpoint;

    public function __construct(
        AccountService $accountService,
        EndpointService $endpointService,
        BalanceService $balanceService
    ) {
        $this->accountService = $accountService;
        $this->endpointService = $endpointService;
        $this->balanceService = $balanceService;

        $this->accountEndpoint = new Endpoint('/api/v3/account', 'GET');

    }

    public function list() {
        // if db data not yet stale, fetch from the db
        if (!$this->endpointService->isStale($this->accountEndpoint)) {
            return $this->balanceService->all();
        }

        // otherwise call Binance API and update balances table
        $balances = $this->updateAccountBalancesData();

        return $balances;
    }

    public function get($asset) {
        // if db data not yet stale, fetch from the db
        if (!$this->endpointService->isStale($this->accountEndpoint)) {
            return $this->balanceService->get($asset);
        }

        // otherwise call Binance API and update balances table
        $this->updateAccountBalancesData();

        return $this->balanceService->get($asset);
    }

    private function updateAccountBalancesData() {
        // otherwise call Binance API and update balances table
        $balances = $this->accountService->allBalances();
        $this->balanceService->updateAll($balances);
        $this->endpointService->upsertLastCall($this->accountEndpoint);
        return $balances;
    }

}
