<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Employee;
use Illuminate\Http\Request;

class ScheduleController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schedule = new Schedule;

        $schedule->department_id = $request->department_id;
        $schedule->type = $request->type;
        $schedule->in_am = $request->in_am;
        $schedule->out_am = $request->out_am;
        $schedule->in_pm = $request->in_pm;
        $schedule->out_pm = $request->out_pm;
        $schedule->save();

        return redirect('schedules');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $json = json_decode($request->getContent());
        $schedule = Schedule::find($id);

        if ($json->in_am >= $json->out_am || $json->in_am >= $json->in_pm || $json->in_am >= $json->out_pm ||
            $json->out_am >= $json->in_pm || $json->out_am >= $json->out_pm || $json->in_pm >= $json->out_pm)
            return json_encode([
                'type' => 'error',
                'title' => 'Operation unsuccessful!',
                'body' => 'A valid schedule should be input, to avoid any ambiguity in the payroll process.',

                'schedule' => $schedule,
            ]);

        

        $schedule->in_am = $json->in_am;
        $schedule->out_am = $json->out_am;
        $schedule->in_pm = $json->in_pm;
        $schedule->out_pm = $json->out_pm;
        $schedule->state = (string)$json->state;
        $schedule->save();

        return json_encode([
            'type' => 'success',
            'title' => 'Operation successful!',
            'body' => 'You updated the schedule for \'' . $schedule->department->name . "\' beware of this!",

            'schedule' => Schedule::find($id),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Employee::where("schedule_id", "=", $id)->count() > 0)
            return json_encode([

                'type' => 'error',
                'title' => 'Operation unsuccessful!',
                'body' => 'A schedule cannot be deleted when someone is assigned to it.',

            ]);

        Schedule::destroy($id);

        return json_encode([

            'type' => 'success',
            'title' => 'Operation successful!',
            'body' => 'You just deleted a schedule! take a note of this!',

        ]);
    }
}
