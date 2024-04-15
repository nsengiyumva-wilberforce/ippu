<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cpd;
use App\Models\Attendence;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CpdsController extends Controller
{
    public function index()
    {
        $cpds = Cpd::all();

        return view('members.cpds.index',compact('cpds'));
    }

    public function upcoming()
    {
        $cpds = Cpd::where('start_date','>=',date('Y-m-d'))->get();

        return view('members.cpds.index',compact('cpds'));
    }

    public function attend($id='')
    {

        $event = Cpd::find($id);
        return view('members.cpds.confirmation',compact('event'));

        // try{
        //     \DB::beginTransaction();
        //     $attendence = new Attendence;
        //     $attendence->user_id = \Auth::user()->id;
        //     $attendence->cpd_id = $id;
        //     $attendence->type = "CPD";
        //     $attendence->status = "Pending";
        //     $attendence->save();

        //     \DB::commit();

        //     return redirect()->back()->with('success','CPD has been recorded!');
        // }catch(\Throwable $e){
        //     return redirect()->back()->with('error',$e->getMessage());
        // }
    }

    public function confirm_attendence(Request $request)
    {
         try{
            $attendence = new Attendence;
            $attendence->user_id = \Auth::user()->id;
            $attendence->cpd_id = $request->cpd_id;
            $attendence->type = "CPD";
            $attendence->status = "Pending";

            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $extension = $file->getClientOriginalExtension();

                $filename = time().rand(100,1000).'.'.$extension;

                $storage = \Storage::disk('public')->putFileAs(
                            'images/',
                            $file,
                            $filename);

                if (!$storage) {
                    return response()->json(['message' => 'Unable to upload payment proof!']);
                }else{  
                    $attendence->payment_proof = $filename;
                }
            }

            $attendence->save();

            return redirect()->back()->with('success','CPD has been recorded!');
        }catch(\Throwable $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function attended()
    {
        $cpds = Cpd::whereHas('attended')->get();

        return view('members.cpds.index',compact('cpds'));
    }

    public function details($id)
    {
        $event = Cpd::find($id);

        return view('members.cpds.details',compact('event'));
    }

    public function certificate($event)
    {
        $event = Cpd::find($event);

        return view('members.cpds.certificate',compact('event'));
    }

    public function generate_certificate($event){
        $manager = new ImageManager(new Driver());
        //read the image from the public folder
        $image = $manager->read(public_path('images/cpd-certificate-template.jpg'));

        $user = auth()->user();

        $event = Cpd::find($event);

        $image->text($event->code, 173, 27, function ($font) {
            $font->filename(public_path('fonts/Roboto-Bold.ttf'));
            $font->color('#000000');
            $font->size(20);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text($user->name, 780, 550, function ($font) {
            $font->filename(public_path('fonts/GreatVibes-Regular.ttf'));
            $font->color('#1F45FC');
            $font->size(45);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text('Attended a Continuing Professional Development(CPD) activity', 760, 620, function ($font) {
            $font->filename(public_path('fonts/Roboto-Regular.ttf'));
            $font->color('#000000');
            $font->size(20);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

       //add event name
        $image->text('"'.$event->topic.'"', 730, 690, function ($font) {
            $font->filename(public_path('fonts/Roboto-Bold.ttf'));
            $font->color('#000000');
            $font->size(20);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });


        $startDate = Carbon::parse($event->start_date);
        $endDate = Carbon::parse($event->end_date);

        if ($startDate->month === $endDate->month) {
            $x=720;
            // Dates are in the same month
            $formattedRange = $startDate->format('jS') . ' - ' . $endDate->format('jS F Y');
        } else {
            $x=780;
            // Dates are in different months
            $formattedRange = $startDate->format('jS F Y') . ' - ' . $endDate->format('jS F Y');
        }


        $image->text('on ', 600, 760, function ($font) {
            $font->filename(public_path('fonts/Roboto-Regular.ttf'));
            $font->color('#000000');
            $font->size(20);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text($formattedRange, $x, 760, function ($font) {
            $font->filename(public_path('fonts/Roboto-Bold.ttf'));
            $font->color('#000000');
            $font->size(20);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
        });

        $image->text($event->hours."CPD HOURS", 1400, 945, function ($font) {
            $font->filename(public_path('fonts/Roboto-Bold.ttf'));
            $font->color('#000000');
            $font->size(17);
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
}
