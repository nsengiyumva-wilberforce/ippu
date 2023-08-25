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
}
