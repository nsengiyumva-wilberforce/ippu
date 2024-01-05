<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cpd;
use App\Models\Attendence;

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
        $image = $manager->read(public_path('images/certificate-template.jpeg'));

        $event = Cpd::find($event);
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
}
