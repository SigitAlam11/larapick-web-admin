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
            'admin_id' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // upload the image when it is available
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/pickups', $imageName);
        }

        // if image is not available or null
        if (!isset($imageName)) {
            $imageName = null;
        }

        // create pickup log and time from server
        PickupLog::create([
            'student_id' => $request->student_id,
            'guardian_id' => $request->guardian_id,
            'admin_id' => $request->admin_id,
            'pickup_time' => now(),
            'status' => $request->status,
            'note' => $request->note,
            'image' => $imageName,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully picked up student',
        ], 200);
    }

    // update pickup log status
    public function updatePickupStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pickup_id' => 'required',
            'guardian_id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $pickupLog = PickupLog::find($request->pickup_id);
        $pickupLog->guardian_id = $request->guardian_id;
        $pickupLog->status = $request->status;
        $pickupLog->save();

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated pickup status',
        ], 200);
    }

    // get pickup logs by student and by month and year
    public function getPickupLogsByStudent(Request $request)
    {
        $pickupLogs = PickupLog::where('student_id', $request->student_id)
            ->whereYear('pickup_time', $request->year)
            ->whereMonth('pickup_time', $request->month)
            ->where('status', $request->status)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Successfully fetched pickup logs',
            'data' => PickupResource::collection($pickupLogs),
        ], 200);
    }
}
