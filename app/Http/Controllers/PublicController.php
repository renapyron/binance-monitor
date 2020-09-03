<?php

namespace App\Http\Controllers;
use App\Services\Binance\PublicService;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller;

class PublicController extends Controller
{

    protected $publicService;

    public function __construct(PublicService $publicService)
    {
        $this->publicService = $publicService;
    }

    public function ping() {
        $response = $this->publicService->ping();
        $success = $response->getStatusCode() == 200 ? true : false;
        return response()->json(['success' => $success ]);
    }

    public function time() {
        return $this->publicService->serverTime();
    }

}