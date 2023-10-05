<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Communication;
use App\Models\User;
use App\Models\UserCommunicationStatus;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        auth()->login($user);

        //fetch all communications with their statuses for a user and create a column 'status' in the response, true if the status is 'read', false otherwise
        $communications = Communication::with(['communicationStatus' => function ($query) {
            $query->where('user_id', auth()->user()->id);
        }])->get()->map(function ($communication) {
            $communication->status = $communication->communicationStatus->first()->status === 'read' ? true : false;
            return $communication;
        });

        //logout the user
        auth()->logout();

        // Return the resource as a JSON response
        return response()->json(['data' => $communications], 200);
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
        $resource = Communication::find($id);

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

    public function markAsRead($userId, $messageId)
    {

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        auth()->login($user);

        // Find the corresponding record in user_communication_status and update its status to 'read'
        $status = UserCommunicationStatus::where('user_id', auth()->user()->id)
            ->where('communication_id', $messageId)
            ->first();

        if ($status) {
            $status->status = 'read';
            $status->save();
        } else {
            return response()->json(['message' => 'Message not found'], 404);
        }

        auth()->logout();

        return response()->json(['message' => 'Message marked as read'], 200);
    }

}
