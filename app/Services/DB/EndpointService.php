<?php

namespace App\Services\DB;


use App\Models\Endpoint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EndpointService
{
    private $table;
    public function __construct() {

        $this->table = 'endpoint_timestamps';
    }

    public function isStale(Endpoint $endpoint) {
        $result = DB::table($this->table)
            ->selectRaw('UNIX_TIMESTAMP(last_call) AS last_call')
            ->where('endpoint', '=', $endpoint->endpoint)
            ->where('method', '=', $endpoint->method)
            ->get();

        if (count($result) > 0) {
            return $result[0]->last_call + (int)(env('BINANCE_CACHE_LIFETIME')) <= time();
        }

        return true;
    }

    public function upsertLastCall(Endpoint $endpoint) {
        return DB::table($this->table)
            ->updateOrInsert(
                ['endpoint' => $endpoint->endpoint, 'method' => $endpoint->method],
                ['last_call' => DB::raw('CURRENT_TIMESTAMP()')]
            );
    }


}