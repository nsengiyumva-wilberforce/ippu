<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $resource = User::find($id);

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
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'phone_no' => 'required',
            'nok_name' => 'required',
            'nok_phone_no' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->membership_number = $request->membership_number;
        $user->address = $request->address;
        $user->phone_no = $request->phone_no;
        $user->alt_phone_no = $request->alt_phone_no;
        $user->nok_name = $request->nok_name;
        $user->nok_address = $request->nok_email;
        $user->nok_phone_no = $request->nok_phone_no;
        $user->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
