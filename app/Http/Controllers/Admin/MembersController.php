<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class MembersController extends Controller
{
    public function index()
    {
        $members = User::where('user_type','Member')->get();

        return view('admin.members.index',compact('members'));
    }

    public function show($id)
    {
        $member = User::find($id);
        return view('admin.members.show',compact('member'));
    }

    public function change_member_status($member)
    {
        $member = User::find($member);
        return view('admin.members.status',compact('member'));
        
    }

    public function update_member_status(Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);
        try{
            $member = User::find($request->member);
            $member->status = $request->status;
            $member->comment = $request->comment;
            $member->save();

            activity()->performedOn($lead_stage)->log($member->status.' '.$member->name);

            \Mail::to($member)->send(new \App\Mail\AccountStatus($member));

            return redirect()->back()->with('success','Member status has been changed!');
        }catch(\Throwable $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
