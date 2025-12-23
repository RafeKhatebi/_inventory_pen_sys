<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ActivityLogController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = ActivityLog::with('user')->orderBy('created_at', 'desc');

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('action')) {
            $query->where('action', 'like', '%' . $request->action . '%');
        }

        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->paginate($request->get('per_page', 15));

        return response()->json($logs);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'action' => 'required|string',
            'model_type' => 'nullable|string',
            'model_id' => 'nullable|integer',
            'description' => 'nullable|string'
        ]);

        $log = ActivityLog::log(
            $request->action,
            $request->model_type,
            $request->model_id,
            $request->description
        );

        return response()->json(['log' => $log], 201);
    }
}