<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Check if the user has a latest membership
        $latestMembership = $user->latestMembership;

        // Set the subscription status based on the presence of a latest membership
        $subscriptionStatus = $latestMembership ? $latestMembership->status : false;

        // Update the user's subscription_status field
        $user->subscription_status = $subscriptionStatus;

        return response()->json([
            'message' => 'User retrieved successfully',
            'data' => $user
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
        $resource = User::find($id);

        // Check if the resource exists
        if (!$resource) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        // Check if the user has a latest membership
        if ($resource->latestMembership) {
            // If a latest membership is found, set the subscription_status field
            $resource->subscription_status = $resource->latestMembership->status;
        } else {
            // If the user has no subscription, set the subscription_status field to false
            $resource->subscription_status = false;
        }

        // Return the resource as a JSON response with the added subscription_status field
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

    //subscribe to the app
    public function subscribe(Request $request)
    {

        try {
            // get the logged in user
            $user = Auth::user();
            $membership = new \App\Models\Membership;
            $membership->status = "Pending";
            $membership->user_id = $user->id;
            $membership->save();

            

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            \Mail::to(Auth::user())->send(new \App\Mail\ApplicationReview($membership));

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully'
            ]);

        } catch (\Throwable $e) {
            print_r($e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Application failed'
            ]);
        }


    }

    public function delete_my_account($userId)
    {
        $user = User::find($userId);
        //return user not found error
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }

    public function updateProfilePhoto()
    {
        //get the authenticated user
        $user = Auth::user();
        // Validate the request
        request()->validate([
            'profile_photo_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get the image
        $image = request()->file('profile_photo_path');

        // Save the image
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        // Update avatar field in the database with the full URL
        $user->profile_pic = url('images/' . $imageName);

        $user->save();
        return response()->json([
            'message' => 'Profile photo updated successfully',
            'profile_photo_path' => $user->profile_pic
        ], 200);
    }

}
