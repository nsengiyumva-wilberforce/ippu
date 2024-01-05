<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\AccountType;
use App\Models\User;
use App\Models\Cpd;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type == "Admin") {
            $account_types = AccountType::withCount('users')->get();

            $users_chart_series = "[";
            $users_chart_labels = "[";

            foreach ($account_types as $account_type) {
                $users_chart_series .= $account_type->users_count.',';
                $users_chart_labels .= '"'.$account_type->name.'",';
            }

            $invoices = \App\Models\Invoice::take(5)->orderBy('id','desc')->get();

            $invoices_count = \App\Models\Invoice::count();
            $members_count = \App\Models\User::where('user_type','Member')->count();
            $cpds_count = \App\Models\Cpd::count();
            $events_count = \App\Models\Event::count();

            $users_chart_series .= "]";
            $users_chart_labels .= "]";
            return view('admin.dashboard',compact('users_chart_series','users_chart_labels','invoices','invoices_count','members_count','cpds_count','events_count'));
        }else{
            $user = Auth::user();

            if (is_null($user->gender) || is_null($user->dob) || is_null($user->address)) {
                return redirect('profile')->with('warning','Please complete the your profile!');
            }
            return view('members.dashboard');
        }
    }

    public function subscribe()
    {

        try{
            $membership = new \App\Models\Membership;
            $membership->user_id = \Auth::user()->id;
            $membership->status = "Pending";
            $membership->save();

            \Mail::to(Auth::user())->send(new \App\Mail\ApplicationReview($membership));
            return redirect()->back()->with('warning','Membership application has been submitted for approval!');
        }catch(\Throwable $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
        
        
    }

    public function approve($id)
    {
        $member = \App\Models\User::find($id);

        $subscription = $member->latestMembership;
        $subscription->status = "Approved";
        $subscription->expiry_date = date('Y-m-d', strtotime('+1 year'));
        $subscription->approved_by = \Auth::user()->id;
        $subscription->save();

        return redirect()->back()->with('success','Member subscription has been activated!');
    }

    public function deny($id)
    {
        $member = \App\Models\User::find($id);

        $subscription = $member->latestMembership;
        $subscription->status = "Denied";
        $subscription->denied_by = \Auth::user()->id;
        $subscription->save();

        return redirect()->back()->with('success','Member subscription has been denied!');
    }

    public function review($id)
    {
        $member = \App\Models\User::find($id);
        $payment = $member->account_type->rate;

        $last_subcription = \App\Models\Payment::where('user_id',$id)
                            ->where('type','Subscription')
                            ->orderBy('id','desc')
                            ->first();

        if ($last_subcription) {
            if($last_subcription->balance > 0){
                $payment = $last_subcription->balance;
            }
        }
        return view('admin.members.review',compact('member','payment'));
    }

    public function post_review(Request $request)
    {
        // try{
            if ($request->status == "Denied") {
                $request->validate([
                    'comment' => 'required'
                ]);
            }

            \DB::beginTransaction();

            $member = User::find($request->member);
            $membership = $member->latestMembership;

            if ($request->status == "Approved") {
                $last_subcription = \App\Models\Payment::where('user_id',$member->id)
                        ->where('type','Subscription')
                        ->orderBy('id','desc')
                        ->first();

                $balance = $member->account_type->rate;

                if ($last_subcription) {
                        if($last_subcription->balance > 0){
                            $balance = $last_subcription->balance ;
                        }
                    }

                $request->payment = str_replace(',', '', $request->payment);

                $payment = new \App\Models\Payment;
                $payment->type = "Subscription";
                $payment->amount = $request->payment;
                $payment->balance = $balance - $request->payment;
                $payment->user_id = $member->id;
                $payment->received_by = \Auth::user()->id;
                $payment->membership_id = $membership->id;
                $payment->save();

                if ($payment->balance <= 0) {
                    $membership->status = $request->status;

                    $member->subscribed = 1;
                    $member->save();
                }

            }else{
                $membership->status = $request->status;
            }
            
            $membership->comment = $request->comment;
            $membership->processed_by = Auth::user()->id;
            $membership->processed_date = date('Y-m-d');
            $membership->save();

            \DB::commit();

            \Mail::to($member)->send(new \App\Mail\ApplicationReview($membership));
            return redirect('admin/members')->with('success','Member application has been procced successfully');
        // }catch(\Throwable $e){
        //     return redirect()->back()->with('error',$e->getMessage());
        // }
    }

    public function create_reminder($type)
    {
        $cpds = [];
        $events = [];
        if ($type == 'cpd') {
            $cpds = Cpd::all();
        }else{
            $events = Event::all();
        }
        return view('admin.reminders.create',compact('type','cpds','events'));
    }

    public function send_reminder(Request $request)
    {
        $users = [];
        if ($request->type == "cpd") {
            $users = User::whereHas('cpd_attendences',function($query) use($request){
                            $query->where('status',$request->status);
                        })->get();
        }else{
            $users = User::whereHas('event_attendences',function($query) use($request){
                            $query->where('status',$request->status);
                        })->get();
        }

        foreach ($users as $user) {
            \Mail::to($user)->send(new \App\Mail\RemainderEmail($request,$user));
        }

        return redirect()->back()->with('success','Reminder has been sent!');
    }

    public function upload(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        } else {
            return response()->json(['uploaded' => 0, 'error' => ['message' => 'Upload file not found.']]);
        }
    }
}
