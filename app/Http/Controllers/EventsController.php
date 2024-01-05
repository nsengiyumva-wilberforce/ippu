<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendence;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Dompdf\Options;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
        
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $view = View::make('members.events.certificate', compact('event'))->render();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('auto');

        // Render the HTML as PDF
        $dompdf->render();
        $dompdf->stream($event->name.'.pdf');
    }

    public function generate_certificate($event){
        $manager = new ImageManager(new Driver());
        //read the image from the public folder
        $image = $manager->read(public_path('images/certificate-template.jpeg'));

        $event = Event::find($event);
        $user = auth()->user();


        $image->text('PRESENTED TO', 420, 250, function ($font) {
            $font->filename(public_path('fonts/Roboto-Bold.ttf'));
            $font->color('#405189');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
        });

        $image->text($user->name, 420, 300, function ($font) {
            $font->filename(public_path('fonts/Roboto-Bold.ttf'));
            $font->color('#b01735');
            $font->size(20);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text('FOR ATTENDING THE', 420, 340, function ($font) {
            $font->filename(public_path('fonts/Roboto-Bold.ttf'));
            $font->color('#405189');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

       //add event name
        $image->text($event->name, 420, 370, function ($font) {
            $font->filename(public_path('fonts/Roboto-Regular.ttf'));
            $font->color('#008000');
            $font->size(22);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });



        $image->text('Organized by the Institute of Procurement Professionals of Uganda on 12th - 14th October 2023 at', 420, 400, function ($font) {
            $font->filename(public_path('fonts/Roboto-Regular.ttf'));
            $font->color('#405189');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        //add event date
        $image->text('Africana Hotel, Kampala', 420, 430, function ($font) {
            $font->filename(public_path('fonts/Roboto-Bold.ttf'));
            $font->color('#405189');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);                                                                          
        });

        //add membership number
        $image->text('MembershipNumber: '.$user->membership_number??"None", 450, 483, function ($font) {
            $font->filename(public_path('fonts/Roboto-Bold.ttf'));
            $font->color('#405189');
            $font->size(12);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->toPng();

        //save the image to the public folder
        $image->save(public_path('images/certificate-generated.png'));

        //download the image
        return response()->download(public_path('images/certificate-generated.png'))->deleteFileAfterSend(true);
    }


    public function direct_attendence($type,$id)
    {
        $data = new \stdClass;
        $data->type = $type;
        $data->id = $id;

        if ($type == "cpd") {
            $cpd = \App\Models\Cpd::find($id);
            $data->name = $cpd->topic;
            $data->points = $cpd->points;
            $data->end_date = $cpd->end_date;
            $data->banner = $cpd->banner;
        }

        if ($type == "event") {
            $event = Event::find($id);
            $data->name = $event->name;
            $data->points = $event->points;
            $data->end_date = $event->end_date;
            $data->banner = $event->banner_name;
        }

        if (\Carbon\Carbon::parse($data->end_date)->isPast()) {
            $data->end_date = "Past";
        }else{
            $data->end_date = "Future";
        }

        return view('members.attendence.direct',compact('data'));
    }

    public function record_direct_attendence(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);


        $user = \App\Models\User::where('email',$request->email)->first();

        if (!$user) {
            $password = \Str::random(9);

            $user = new \App\Models\User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($password);
            $user->account_type_id = \App\Models\AccountType::first()->id;
            $user->save();
        }

        \Auth::login($user);

        $attendence = new Attendence;
        $attendence->user_id = \Auth::user()->id;
        if($request->type == "event"){
            $attendence->event_id = $request->id;
            $attendence->type = "Event";
        }else{   
            $attendence->cpd_id = $request->id;
            $attendence->type = "CPD";
        }
        $attendence->status = "Attended";
        $attendence->save();

        if ($request->type == "event") {
            $event = \App\Models\Event::find($request->id);

            return view('members.events.certificate',compact('event'));
        }else{
            $event = \App\Models\Cpd::find($request->id);

            return view('members.cpds.certificate',compact('event'));
        }

        return redirect()->back()->withInput();
    }
}
