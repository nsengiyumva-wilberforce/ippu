<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cpd;
use Illuminate\Http\Request;

class CpdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cpds = Cpd::all();

        return response()->json([
            'data' => $cpds,
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
        //
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
    public function upcoming()
    {
        $cpds = Cpd::where('start_date','>=',date('Y-m-d'))->get();

        return response()->json([
            'data' => $cpds,
        ]);
    }

    public function attended()
    {
        $cpds = Cpd::whereHas('attended')->get();

        return response()->json([
            'data' => $cpds,
        ]);
    }
}
