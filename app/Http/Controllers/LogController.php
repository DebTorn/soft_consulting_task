<?php

namespace App\Http\Controllers;

use App\Services\LogService;

class LogController extends Controller
{

    public function __construct(
        private LogService $logService
    )
    {}

    public function index()
    {
        $logs = $this->logService->getAll();

        return view('logs/index', [
            'logs' => $logs
        ]);
    }

    public function getOne($id)
    {
        $log = $this->logService->getById($id);

        return response()->json($log);
    }

}
