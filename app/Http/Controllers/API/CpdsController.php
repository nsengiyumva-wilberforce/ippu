<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Cpd;
use Illuminate\Http\Request;

class CpdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cpds = Cpd::all();

        return response()->json([
            'data' => $cpds,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the resource by ID
        $resource = Cpd::find($id);

        // Check if the resource exists
        if (!$resource) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        // Return the resource as a JSON response
        return response()->json(['data' => $resource], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function upcoming()
    {
        $cpds = Cpd::where('start_date', '>=', date('Y-m-d'))->get();

        return response()->json([
            'data' => $cpds,
        ]);
    }

    public function attended(string $id)
    {
        $events = Attendence::where('user_id', $id)
        ->where('type', 'CPD')->get();

        return response()->json([
            'data' => $events,
        ]);
    }

    public function confirm_attendence(Request $request)
    {
        try {
            $attendence = new Attendence;
            $attendence->user_id = $request->user_id;
            $attendence->cpd_id = $request->cpd_id;
            $attendence->type = "CPD";
            $attendence->status = "Pending";
            $attendence->save();

            return response()->json([
                'success' => true,
                'message' => 'CPD has been recorded!',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
