<?php

namespace App\Http\Controllers;

use App\Positions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rate_contents.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'state' => 'required',
            'max' => 'required',
        ]);

        if (request('max') <= 0) return back();

        $position = new Positions();

        $position->title = request('name');
        $position->description = request('description');
        $position->state = request('state');
        $position->lim = request('max');
        $position->save();

        return back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Positions  $positions
     * @return \Illuminate\Http\Response
     */
    public function show(Positions $positions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Positions  $positions
     * @return \Illuminate\Http\Response
     */
    public function edit(Positions $positions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Positions  $positions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Positions $positions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Positions  $positions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Positions $position)
    {
        if ($position->count() > 0) return json_encode([
            'error' => 'cannot delete non-empty position!',
        ]);


        $position->delete();
        return view('positions_contents/data');
    }
}
