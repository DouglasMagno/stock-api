<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryRequest;
use App\Models\History;
use App\Services\HistoryServices;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    private $historyService;
    public function __construct(HistoryServices $historyService)
    {
        $this->historyService = $historyService;
    }
    public function getAll()
    {
        return $this->historyService->getAll();
    }

    public function createHistories(HistoryRequest $request)
    {
        return $this->historyService->createHistories($request->all());
    }
}
