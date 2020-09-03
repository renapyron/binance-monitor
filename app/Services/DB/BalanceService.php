<?php

namespace App\Services\DB;


use Illuminate\Support\Facades\DB;

class BalanceService
{
    private $table;
    public function __construct() {
        $this->table = 'balances';
    }

    public function all() {
        return DB::table($this->table)
            ->select(['asset', 'balance'])
            ->get();
    }

    public function get($asset) {
        return (array) DB::table($this->table)
            ->select(['asset', 'balance'])
            ->where('asset', '=', $asset)
            ->first();
    }


    public function updateAll($balances) {
        // recreate everything
        DB::table($this->table)
            ->delete();

        DB::table($this->table)
            ->insert($balances);

        return $balances;
    }

}