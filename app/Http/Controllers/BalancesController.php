<?php

namespace App\Http\Controllers;

use App\Services\AccountService;

class BalancesController extends Controller
{

    protected $accountService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function list() {

        return $this->accountService->allBalances();
    }

    public function get($symbol) {

    }

    public function ping() {
        return $this->accountService->ping();
    }

    //
}
