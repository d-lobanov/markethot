<?php

namespace Market\Http\Controllers\Api;

use Market\Http\Controllers\Controller;
use Market\Models\SyncHistory;

class SyncHistoryController extends Controller
{
    /**
     * @return mixed
     */
    public function all()
    {
        return SyncHistory::query()->orderBy('created_at', 'desc')->get();
    }
}
