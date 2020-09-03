<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/3/20
 * Time: 3:48 PM
 */

namespace App\Services\DB;


use Illuminate\Support\Facades\DB;

class AssetStatsService
{
    private $table;

    public function __construct() {
        $this->table = 'asset_pair_stats';
    }

    public function update($asset, $assetSold, $stats) {
        return DB::table($this->table)
            ->updateOrInsert(
              ['asset_bought' => $asset, 'asset_sold' => $assetSold],
              ['average_buy' => $stats['average_buy'], 'average_sell' => $stats['average_sell']]
            );
    }

    public function get($asset, $assetSold) {

        return (array) DB::table($this->table)
            ->select(['average_buy', 'average_sell'])
            ->where('asset_bought', '=', $asset)
            ->where('asset_sold', '=', $assetSold)
            ->first();
    }


}