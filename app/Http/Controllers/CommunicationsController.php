<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Communication;

class CommunicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (\Auth::user()->user_type == "Admin") {
            $communications = Communication::all();
        }else{
            $communications = Communication::where('target','*')
                                ->orWhere('target',\Auth::user()->account_type_id)
                                ->get();
        }
        
        return view('communications.index',compact('communications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accountTypes = \App\Models\AccountType::all();
        return view('communications.create',compact('accountTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'target' => 'required'
        ]);

        $communication = new Communication;
        $communication->title = $request->title;
        $communication->target = $request->target;
        $communication->message = $request->message;
        $communication->user_id = \Auth::user()->id;
        $communication->save();

        return redirect('communications')->with('success','Communication has been successfully published!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $communication = Communication::find($id);

        return view('communications.details',compact('communication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $communication = Communication::find($id);

        $accountTypes = \App\Models\AccountType::all();

        return view('communications.edit',compact('communication','accountTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'target' => 'required'
        ]);

        $communication = Communication::find($id);
        $communication->title = $request->title;
        $communication->target = $request->target;
        $communication->message = $request->message;
        $communication->user_id = \Auth::user()->id;
        $communication->save();

        return redirect('communications')->with('success','Communication has been successfully published!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        try{
            $communication = Communication::find($id);
            $communication->delete();

            return redirect()->back()->with('success','Communication has been deleted!');
        }catch(\Throwable $e){
            return redirect()->back()->with('error',$e->getMessage()); 
        }
    }
}
