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
            'state' => 'required',
            'max' => 'required',
        ], [
            'name.required' => json_encode([
                'type' => 'error',
                'title' => 'Position name error',
                'body' => 'A position should have a name.',
            ]),

            'state.required' => json_encode([
                'type' => 'error',
                'title' => 'Status error',
                'body' => 'A position should have a valid status.',
            ]),

            'max.required' => json_encode([
                'type' => 'error',
                'title' => 'Maximum error',
                'body' => 'A position should have a maximum employee.',
            ]),


        ]);

        if (request('max') <= 0) return back()->withErrors(json_encode([

            'type' => 'error',
            'title' => 'Invalid input!',
            'body' => 'A position should have a maximum employees greater than 0.',

        ]));

        $position = new Positions();

        $position->title = request('name');
        $position->description = request('description') ? request('description') : '';
        $position->lim = request('max');
        $position->state = request('state');

        $position->save();

        return back()->withErrors(json_encode([
            'type' => 'success',
            'title' => 'Operation successful!',
            'body' => 'You created a new position named "' . $position->title . '"!',
        ]));
        
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
    public function update(Request $request, Positions $position)
    {
        $position->title = request('edit-title') ? request('edit-title') : $position->title;
        $position->description = request('edit-description');
        $position->state = in_array(request('edit-state'), [0,1,2,3]) ? request('edit-state') : $position->state;
        $position->lim = request('edit-lim') <= 0 ? $position->lim : request('edit-lim');

        if ($position->lim <= $position->count()) $position->state = '1';

        $position->save();

        return back()->withErrors(json_encode([
            'type' => 'success',
            'title' => 'Operation successful!',
            'body' => 'You modify a positions detail. beware of this.',
        ]));
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
            'type' => 'error',
            'title' => 'Invalid request!', 
            'body' => 'A position assigned to some employees cannot be deleted.',
        ]);


        $position->delete();
        return view('positions_contents/data');
    }
}
