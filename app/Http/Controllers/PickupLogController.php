<?php

namespace App\Http\Controllers;

use App\Models\PickupLog;
use Illuminate\Http\Request;

class PickupLogController extends Controller
{
    public function index()
    {
        // get all pickup logs sorted by latest
        $pickupLogs = PickupLog::latest()->get();

        return view('pages.pickup-logs.index', compact('pickupLogs'));
    }
}
