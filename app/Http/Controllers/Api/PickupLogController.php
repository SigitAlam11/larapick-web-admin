<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PickupResource;
use App\Models\PickupLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PickupLogController extends Controller
{
    // pickup
    public function pickup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'guardian_id' => 'required',
            'admin_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // create pickup log and time from server
        PickupLog::create([
            'student_id' => $request->student_id,
            'guardian_id' => $request->guardian_id,
            'admin_id' => $request->admin_id,
            'pickup_time' => now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully picked up student',
        ], 200);
    }

    // get pickup logs by user logged in and by month and year
    public function getPickupLogs(Request $request)
    {
        $pickupLogs = PickupLog::where('guardian_id', $request->user()->id)
            ->whereYear('pickup_time', $request->year)
            ->whereMonth('pickup_time', $request->month)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Successfully fetched pickup logs',
            'data' => PickupResource::collection($pickupLogs),
        ], 200);
    }
}
