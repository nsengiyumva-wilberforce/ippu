<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($userId)
    {
        $events = Event::all();

        $eventsWithAttendance = [];

        foreach ($events as $event){
            $attendanceRequest = Attendence::where('event_id', $event->id)
            ->where('user_id', $userId)
            ->exists();

            $event->attendance_request = $attendanceRequest;

            array_push($eventsWithAttendance, $event);
        }

        return response()->json([
            'data' => $eventsWithAttendance,
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
        $resource = Event::find($id);

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

    public function upcoming($userId)
    {
        $events = Event::where('start_date', '>=', date('Y-m-d'))->get();

        $eventsWithAttendance = [];

        foreach ($events as $event){
            $attendanceRequest = Attendence::where('event_id', $event->id)
            ->where('user_id', $userId)
            ->exists();

            $event->attendance_request = $attendanceRequest;

            array_push($eventsWithAttendance, $event);
        }

        return response()->json([
            'data' => $events,
        ]);
    }

    public function attended(string $userId)
    {
        // Query events associated with the specified user and where 'type' is 'Event'
        $events = Event::whereHas('attendedEvents', function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('type', 'Event');
        })->get();

        return response()->json([
            'data' => $events,
        ]);
    }


    public function confirm_attendence(Request $request)
    {
        try {
            $attendence = new Attendence;
            $attendence->user_id = $request->user_id;
            $attendence->event_id = $request->event_id;
            $attendence->type = "Event";
            $attendence->status = "Pending";
            $attendence->save();

            return response()->json([
                'message' => 'Attendence Confirmed',
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function certificate($userId, $eventId)
    {
        $event = Event::find($eventId);
        
        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        // Get the user ID from the request (you might want to validate this)
        // $userId = $request->input('user_id');

        // Retrieve the user's name from the database based on the user ID
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Authenticate the retrieved user
        auth()->login($user);

        //get the name of the logged in user
        $name = auth()->user()->name;

        // Convert $event to an array
        $data = [
            'event' => $event,
            'name' => $name,
        ];

        // Generate the PDF
        $pdf = Pdf::loadView('members.events.certificate-template', $data);

        // Logout the authenticated user to revert to the original authentication
        auth()->logout();

        // Return the PDF as a download response
        return $pdf->download('certificate.pdf');
    }
}
