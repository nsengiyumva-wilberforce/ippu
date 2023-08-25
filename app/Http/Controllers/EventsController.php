<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendence;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('members.events.index',compact('events'));
    }

    public function upcoming()
    {
        $events = Event::where('start_date','>=',date('Y-m-d'))->get();

        return view('members.events.index',compact('events'));
    }

    public function attend($id='')
    {
       
        $event = Event::find($id);
        return view('members.events.confirmation',compact('event'));
    }

    public function confirm_attendence(Request $request)
    {
         try{
            $attendence = new Attendence;
            $attendence->user_id = \Auth::user()->id;
            $attendence->event_id = $request->event_id;
            $attendence->type = "Event";
            $attendence->status = "Pending";
            $attendence->save();

            return redirect()->back()->with('success','Attendence has been recorded!');
        }catch(\Throwable $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function attended()
    {
        $events = Event::whereHas('attended')->get();

        return view('members.events.index',compact('events'));
    }

    public function details($id)
    {
        $event = Event::find($id);

        return view('members.events.details',compact('event'));
    }

    public function certificate($event)
    {
        $event = Event::find($event);

        return view('members.events.certificate',compact('event'));
    }
}
