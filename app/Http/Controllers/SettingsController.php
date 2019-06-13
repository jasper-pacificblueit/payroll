<?php

namespace App\Http\Controllers;

use Artisan;
use App\Settings;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{

    private function set_env($key, $value)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . env($key),
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       DB::raw("use " . env("DB_DATABASE"));
       return view('settings_contents.index')->with([

            'tables' => (function () {
                $tmp = DB::select("show tables");
                $tbl = [];

                foreach ($tmp as $v)  array_push($tbl, $v->Tables_in_payroll);
                return $tbl;
            })(),

       ]);
    }

    public function reset() {
        Artisan::call("db:seed", [
            "--force" => true,
            "--class" => 'ApplicationReinitializer',
        ]);

        return json_encode([]);
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $settings = Settings::where("user_id", "=", $id)->first();
        $settings->settings = json_encode([
            'skin' => request('skin'),
        ]); 


        if (password_verify(request('current'), auth()->user()->password)) {

            if (request('new') == request('renew')) {

                $user->password = bcrypt(request('new'));

            } else
                return back()->withErrors(json_encode([

                    'type' => 'error',
                    'title' => 'Mismatch password',
                    'body' => 'The retyped password doesn\'t match with the new password!',

                ]));



        } else if (request('current') != '') {
            return back()->withErrors(json_encode([

                'type' => 'error',
                'title' => 'Invalid password',
                'body' => 'The current password inputted is invalid!',

            ]));
        }

        $user->save();
        $settings->save();

        return back()->withErrors(json_encode([

            'type' => 'success',
            'title' => 'Updated settings',
            'body' => 'Some settings we\'re modified please take note of this!',


        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
